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
            	'location' => 'required|Min:3',
                'scope' => 'required',
            	'type' => 'required',
            	'rooms' => 'required',
            	'bathrooms' => 'required',
            	'sitting_room' => 'required',
            	'size' => 'required',
            	'coo_roo' => 'required',
            	'status' => 'required',
            	'price' => 'required|numeric',
                'landlord' => 'required',
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
                'location' => 'required|Min:3',
                'rooms' => 'required',
                'bathrooms' => 'required',
                'sitting_room' => 'required',
                'size' => 'required',
                'coo_roo' => 'required',
                'status' => 'required|Alpha',
                'price' => 'required|numeric',
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

    public function allocate($houseId){
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
            $house = $this->repo->agentViewHouse($houseId);
            $hidden_details[] = $house;
            $hidden_details[] = Sentinel::getUser();
            // dd($hidden_details[1]);
            return view('house.allocate')->with('hidden_details', $hidden_details);
        }
    }

    public function store_allocation(Request $request){
        $this->validate($request, [
                'surname' => 'required|min:3|max:100|Alpha',
                'othernames' => 'required|min:3|max:100|Alpha',
                'amount_paid_figure' => 'required|numeric',
                'amount_paid_words' => 'required|min:3|max:200|Alpha',
                'balance_due' => 'required|numeric',
                'from_date' => 'required|date',
                'to_date' => 'required|date',
                'category' => 'required',
            ]);
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
            $saved_house = $this->repo->save_allocation_details($request);
            $get_house= $this->repo->agentViewhouse($saved_house->property_id);      //get house id
            $landlord = $this->landlord_repo->findById($get_house->landlord_id);        //get landlord
            $house[] = $landlord;
            $house[] = $saved_house;
            $house[] = $get_house;
            return view('house.reciept')->with('house', $house);
        }
    }

    public function de_allocate($id){
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
            $house = $this->repo->de_allocate_house($id);
            return view('house.show',['houses' => $house]);
        }
    }

    public function sellHouse($id){
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
            $house = $this->repo->agentViewHouse($id);
            $hidden_details[] = $house;
            $hidden_details[] = Sentinel::getUser();
            // dd($hidden_details[1]);
            return view('house.sell')->with('hidden_details', $hidden_details);
        }
    }

    public function store_sellHouse(Request $request){
        $this->validate($request, [
                'surname' => 'required|min:3|max:100|Alpha',
                'othernames' => 'required|min:3|max:100|Alpha',
                'phone_number' => 'required',
                'payment_method' => 'required',
                'client_address' => 'required|min:3|AlphaNum',
                'amount_paid_figure' => 'required|numeric',
                'amount_paid_words' => 'required|min:3|max:200|Alpha',
                'balance_due' => 'required|numeric',               
                'landlord_name' => 'required|min:3|max:100|AlphaNum',                
                'landlord_witness_name' => 'required|min:3|max:100|Alpha',
                'client_witness_name' => 'required|min:3|max:100|Alpha',
                'landlord_witness_phone_number' => 'required',
                'client_witness_phone_number' => 'required',
                'landlord_witness_address' => 'required|min:3|AlphaNum',
                'client_witness_address' => 'required|Alpha',
            ]);
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
            $saved_house = $this->repo->save_sale_details($request);   //save sold house details
            $get_house= $this->repo->agentViewhouse($saved_house->property_id);      //get house id
            $landlord = $this->landlord_repo->findById($get_house->landlord_id);        //get landlord
            $house[] = $landlord;
            $house[] = $saved_house;
            $house[] = $get_house;
            return view('house.sellhouse_reciept')->with('house', $house);
        }        
    }
    
}
