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
            	'location' => 'required|Min:3',
                'scope' => 'required',
            	'type' => 'required',
            	'size' => 'required',
            	'coo_roo' => 'required',
            	'status' => 'required',
                'price' => 'required|numeric',
                'landlord' => 'required',
                'picture.0' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
                'picture.1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
                'picture.2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
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
                'location' => 'required|Min:3',
                'type' => 'required',
                'size' => 'required',
                'coo_roo' => 'required',
                'status' => 'required',
                'price' => 'required|numeric',
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

    public function allocate($id){
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
            $land = $this->repo->agentViewLand($id);
            $hidden_details[] = $land;
            $hidden_details[] = Sentinel::getUser();
            // dd($hidden_details);
            return view('land.allocate')->with('hidden_details', $hidden_details);
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
            $saved_land = $this->repo->save_allocation_details($request);
            $get_land= $this->repo->agentViewland($saved_land->property_id);      //get land id
            $landlord = $this->landlord_repo->findById($get_land->landlord_id);        //get landlord
            $land[] = $landlord;
            $land[] = $saved_land;
            $land[] = $get_land;
            return view('land.reciept')->with('land', $land);
        }
    }

    public function de_allocate($id){
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
            $land = $this->repo->de_allocate_land($id);
            return view('land.show',['lands' => $land]);
        }
    }

    public function sellLand($id){
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
            $land = $this->repo->agentViewLand($id);
            $hidden_details[] = $land;
            $hidden_details[] = Sentinel::getUser();
            return view('land.sell')->with('hidden_details', $hidden_details);
        }
    }

    public function store_sellLand(Request $request){
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
            $saved_land = $this->repo->save_sale_details($request);   //save sold land details
            $get_land = $this->repo->agentViewland($saved_land->property_id);      //get land id
            $landlord = $this->landlord_repo->findById($get_land->landlord_id);        //get landlord
            $land[] = $landlord;
            $land[] = $saved_land;
            $land[] = $get_land;
            return view('land.sellland_reciept')->with('land', $land);
        }          
    }
}
