<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Land\LandContract;
use App\Repositories\Landlord\LandlordContract;
use Sentinel;

class LandController extends Controller
{
    protected $repo;
    protected $landlord_repo;

	public function __construct(LandContract $landContract, LandlordContract $landlordcontract) {
		$this->repo = $landContract;
        $this->landlord_repo = $landlordcontract;
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
        	$lands = $this->repo->findAll();
        }elseif (Sentinel::getUser()->roles->first()->slug == 'agent') {            
            $lands = $this->repo->agentFindAllByMe();
        }
        return view('land.index')->with('lands', $lands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
            $landlords = $this->repo->getAllLandlord();
            return view('land.create')->with('landlords', $landlords);
        }
    }


    public function create_from_landlord_profile($landlordId){
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
            $landlord = $this->landlord_repo->findById($landlordId);
            return view('land.create_land_from_landlord_profile')->with('landlord', $landlord);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
            $this->validate($request, [
            	'location' => 'required',
            	'type' => 'required',
            	'size' => 'required',
            	'coo_roo' => 'required',
            	'status' => 'required',
            ]);
            
            $lands = $this->repo->create($request);
            if ($lands->id) {
            	return redirect()->route('land_index')
            		->with('success', 'Land successfully added');
            } else {
            	return back()
            		->withInput()
            		->with('error', 'Issues encountered, Try again!');
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
            $lands = $this->repo->findById($id);
        }elseif (Sentinel::getUser()->roles->first()->slug == 'agent') {
            $lands = $this->repo->agentViewLand($id);
        }
        if (!$lands) {
            return view('land.create');
        }            
        return view('land.show', ['lands' => $lands]);
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
            $lands = $this->repo->findById($id);
        }elseif (Sentinel::getUser()->roles->first()->slug == 'agent') {
            $lands = $this->repo->agentViewLand($id);
        }
        if (!$lands) {
        	return view('land.create');
        }        
        return view('land.edit', ['lands' => $lands]);
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
                'location' => 'required',
                'type' => 'required',
                'size' => 'required',
                'coo_roo' => 'required',
                'status' => 'required',
                'price' => 'required',
            ]);
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }elseif(Sentinel::getUser()->roles->first()->slug == 'superadmin') {           
            $lands = $this->repo->edit($id, $request);           
        }elseif(Sentinel::getUser()->roles->first()->slug == 'agent') {
            $lands = $this->repo->agentEditLand($id, $request);
        }
        if ($lands->id) {
            return redirect()->route("land_index")
                ->with('success', 'Land successfully updated');
        }else{
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
            $land = $this->repo->remove($id);
        }elseif (Sentinel::getUser()->roles->first()->slug == 'agent') {
            $land = $this->repo->agentDeleteLand($id);
        }
        return redirect()->route('land_index')
            ->with('success', 'Land deleted successfully');
    }

    public function allocate(){
        return view('land.allocate');
    }

    public function de_allocate(){
        return view('land.show');
    }
}
