<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\House\HouseContract;
use App\Repositories\Landlord\LandlordContract;
use Sentinel;

class HouseController extends Controller
{
    protected $repo;
    protected $landlord_repo;

	public function __construct(HouseContract $houseContract, LandlordContract $landlordcontract) {
		$this->repo = $houseContract;
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
            $houses = $this->repo->findAll();
        }elseif (Sentinel::getUser()->roles->first()->slug == 'agent') {
        	$houses = $this->repo->agentFindAllByMe();
        }
        return view('house.index')->with('houses', $houses);
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
            return view('house.create')->with('landlords', $landlords);
        }
    }

    public function create_from_landlord_profile($landlordId){
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
            $landlord = $this->landlord_repo->findById($landlordId);
            return view('house.create_house_from_landlord_profile')->with('landlord', $landlord);
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
        	// dd($request);
            $this->validate($request, [
            	'location' => 'required',
                'scope' => 'required',
            	'type' => 'required',
            	'rooms' => 'required',
            	'bathrooms' => 'required',
            	'sitting_room' => 'required',
            	'size' => 'required',
            	'coo_roo' => 'required',
            	'status' => 'required',
            	'price' => 'required',
            	'picture.0' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
                'picture.1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
                'picture.2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            ]);


            $houses = $this->repo->create($request);
            if ($houses->id) {
            	return redirect()->route('house_index')
            		->with('success', 'House successfully added');
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
            $houses = $this->repo->findById($id);
        }elseif (Sentinel::getUser()->roles->first()->slug == 'agent') {            
            $houses = $this->repo->agentViewHouse($id);
        }
        if (!$houses) {
            return view('house.create');
        }
        return view('house.show', ['houses' => $houses]);

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
            $houses = $this->repo->findById($id);            
        }elseif (Sentinel::getUser()->roles->first()->slug == 'agent') {
            $houses = $this->repo->agentViewHouse($id);
        }
        if (!$houses) {
            return view('house.create');
        }        
        return view('house.edit', ['houses' => $houses]);
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
                'rooms' => 'required',
                'bathrooms' => 'required',
                'sitting_room' => 'required',
                'size' => 'required',
                'coo_roo' => 'required',
                'status' => 'required',
                'price' => 'required',
                // 'picture.0' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
                // 'picture.1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
                // 'picture.2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',

            ]);
        
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }elseif (Sentinel::getUser()->roles->first()->slug == 'superadmin') {            
            $houses = $this->repo->edit($id, $request);
        }elseif (Sentinel::getUser()->roles->first()->slug == 'agent') {
           $houses = $this->repo->agentEditHouse($id, $request);
        }
        if ($houses->id) {
            return redirect()->route("house_index")
                ->with('success', 'House successfully updated');
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
            $house = $this->repo->remove($id);
        }elseif (Sentinel::getUser()->roles->first()->slug == 'agent') {
            $house = $this->repo->agentDeleteHouse($id);
        }
        return redirect()->route('house_index')
                ->with('success', 'House deleted successfully');
    }

    public function allocate(){
        return view('house.allocate');
    }

    public function de_allocate(){
        return view('house.show');
    }
}
