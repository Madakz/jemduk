<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Landlord\LandlordContract;
use Sentinel;

class LandlordController extends Controller
{
    protected $repo;

	public function __construct(LandlordContract $landlordContract) {
		$this->repo = $landlordContract;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	if (Sentinel::guest())
        {
            return redirect()->route('login');
        }elseif (Sentinel::getUser()->roles->first()->slug == 'superadmin') {
	    	$landlords = $this->repo->findAll();	        
	    }elseif (Sentinel::getUser()->roles->first()->slug == 'agent') {
	    	$landlords = $this->repo->agentFindAllByMe();
	    }
	    return view('landlord.index')->with('landlords', $landlords);
    }

    public function create(Request $request) {
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
            // return view('authentication.register');
            return view('landlord.create');
        }
    
	}

	public function store(Request $request)
    {
    	if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
	        $this->validate($request, [
	        	'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	            'surname' => 'required',
	            'othername' => 'required',
	            'email' => 'required|email|unique:landlords',
	            'gender' => 'required',
	            'state' => 'required',
	            'local_govt' => 'required',
	            'phone_number' => 'required',
	            'address' => 'required',
	            'bank_account' => 'required',
	            'bank_name' => 'required',
	            // required|min:3|confirmed
	        ]);
	        
	       
	       // dd($request);
	        $landlord = $this->repo->create($request);
	        // dd($landlord);
	        if ($landlord) {
	            return redirect(route('landlord_index'))->withInput()->with('success', 'Landlord Succesfully added');
	        } else {
	            return back()
	                ->withInput()
	                ->with('error', 'Could not add Landlord. Try again.');
	        }
	    }
    }

	    
	    /**
	     * Display the specified resource.
	     *
	     * @param  int  $id
	     * @return \Illuminate\Http\Response
	     */
    public function show($id)
    {
    	if (Sentinel::guest())
        {
            return redirect()->route('login');
        }elseif (Sentinel::getUser()->roles->first()->slug == 'superadmin') {
	        $landlords = $this->repo->findById($id);
        }elseif (Sentinel::getUser()->roles->first()->slug == 'agent') {
        	$landlords = $this->repo->agentViewLandlord($id);
        }
        if (!$landlords) {
    		return view('landlord.create');
    	}
    
    	return view('landlord.show', ['landlords' => $landlords]);
    }

    public function show_all_property($id){
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else {
            $landlords = $this->repo->findById($id);
            $landlord_properties = $this->repo->get_my_properties($id);
            $properties [] = $landlords;
            $properties [] = $landlord_properties;

        }       
    
        return view('landlord.show_properties', ['properties' => $properties]);
    }

	    /**
	     * Show the form for editing the specified resource.
	     *
	     * @param  int  $id
	     * @return \Illuminate\Http\Response
	     */
    public function edit($id)
    {
    	if (Sentinel::guest())
        {
            return redirect()->route('login');
        }elseif (Sentinel::getUser()->roles->first()->slug == 'superadmin') {
	        $landlords = $this->repo->findById($id);
	        
	    }elseif (Sentinel::getUser()->roles->first()->slug == 'agent') {
	    	$landlords = $this->repo->agentViewLandlord($id);
	    }
	    if (!$landlords) {
        	return view('landlord.create');
        }        
        return view('landlord.edit', ['landlords' => $landlords]);
    }

	    /**
	     * Update the specified resource in storage.
	     *
	     * @param  \Illuminate\Http\Request  $request
	     * @param  int  $id
	     * @return \Illuminate\Http\Response
	     */
    public function update(Request $request, $id)
    {
    	$this->validate($request, [
            'surname' => 'required',
            'othername' => 'required',
            'email' => 'required|email|unique:users',
            'gender' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'bank_account' => 'required',
            'bank_name' => 'required',
        ]);
    	if (Sentinel::guest())
        {
            return redirect()->route('login');
        }elseif (Sentinel::getUser()->roles->first()->slug == 'superadmin') {
	        $landlords = $this->repo->edit($id, $request);	        
	    }elseif (Sentinel::getUser()->roles->first()->slug == 'agent') {
	    	$landlords = $this->repo->agentEditLandlord($id, $request);
	    }
	    if ($landlords->id) {
        	return redirect()->route("landlord_index")
        		->with('success', 'Landlord successfully updated');
        } else {
        	return back()
        		->withInput()
        		->with('error', 'Issues encountered, Try again!');
        }
    }

	    /**
	     * Remove the specified resource from storage.
	     *
	     * @param  int  $id
	     * @return \Illuminate\Http\Response
	     */
    public function destroy($id)
    {
    	if (Sentinel::guest())
        {
            return redirect()->route('login');
        }elseif (Sentinel::getUser()->roles->first()->slug == 'superadmin') {
	        $landlord = $this->repo->remove($id);
        }elseif (Sentinel::getUser()->roles->first()->slug == 'agent') {
        	$landlord = $this->repo->agentDeleteLandlord($id);
        }        
        return redirect()->route('landlord_index')
    		->with('success', 'Landlord deleted successfully');
    }

}
