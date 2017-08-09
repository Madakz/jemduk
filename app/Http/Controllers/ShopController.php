<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Shop\ShopContract;
use App\Repositories\Landlord\LandlordContract;
use Sentinel;

class ShopController extends Controller
{
    protected $repo;
    protected $landlord_repo;

	public function __construct(ShopContract $shopContract, LandlordContract $landlordcontract) {
		$this->repo = $shopContract;
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
            $shops = $this->repo->findAll();
        }elseif (Sentinel::getUser()->roles->first()->slug == 'agent') {
            $shops = $this->repo->agentFindAllByMe();
        }
        return view('shop.index')->with('shops', $shops);

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
            return view('shop.create')->with('landlords', $landlords);
        }
    }

    public function create_from_landlord_profile($landlordId){
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
            $landlord = $this->landlord_repo->findById($landlordId);
            return view('shop.create_shop_from_landlord_profile')->with('landlord', $landlord);
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
            	'location' => 'required|Min:3|AlphaNum',
            	'type' => 'required',
            	'scope' => 'required',
                'size' => 'required',
            	'coo_roo' => 'required',
            	'status' => 'required',
                'price' => 'required|numeric',
                'picture.0' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
                'picture.1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
                'picture.2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            ]);
            
            $shops = $this->repo->create($request);
            if ($shops->id) {
            	return redirect()->route('shop_index')
            		->with('success', 'Shop successfully added');
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
            $shops = $this->repo->findById($id);
            
        }elseif (Sentinel::getUser()->roles->first()->slug == 'agent') {
            $shops = $this->repo->agentViewShop($id);
        }
        if (!$shops) {
            return view('shop.create');
        }        
        return view('shop.show', ['shops' => $shops]);
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
            $shops = $this->repo->findById($id);
            
        }elseif (Sentinel::getUser()->roles->first()->slug == 'agent') {
            $shops = $this->repo->agentViewShop($id);
        }
        if (!$shops) {
            return view('shop.create');
        }
        
        return view('shop.edit', ['shops' => $shops]);
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
                'location' => 'required|Min:3|AlphaNum',
                'type' => 'required',
                'size' => 'required',
                'coo_roo' => 'required',
                'status' => 'required',
                'price' => 'required|numeric',
            ]);
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }elseif (Sentinel::getUser()->roles->first()->slug == 'superadmin') {
            $shops = $this->repo->edit($id, $request);            
        }elseif (Sentinel::getUser()->roles->first()->slug == 'agent') {
            $shops = $this->repo->agentEditShop($id, $request);
        }
        if ($shops->id) {
            return redirect()->route("shop_index")
                ->with('success', 'Shop successfully updated');
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
            $shop = $this->repo->remove($id);            
        }elseif (Sentinel::getUser()->roles->first()->slug == 'agent') {
           $shop = $this->repo->agentDeleteShop($id);
        }
        return redirect()->route('shop_index')
                ->with('success', 'Shop deleted successfully');
    }

    public function allocate($id){
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
            $shop = $this->repo->agentViewShop($id);
            $hidden_details[] = $shop;
            $hidden_details[] = Sentinel::getUser();
            return view('shop.allocate')->with('hidden_details', $hidden_details);
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
            $shop = $this->repo->save_allocation_details($request);
            return view('shop.reciept')->with('shop', $shop);
        }
    }

    public function de_allocate($id){
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
            $shop = $this->repo->de_allocate_shop($id);
            return view('shop.show',['shops' => $shop]);
        }
    }

    public function sellShop($id){
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
            $shop = $this->repo->agentViewShop($id);
            $hidden_details[] = $shop;
            $hidden_details[] = Sentinel::getUser();
            return view('shop.sell')->with('hidden_details', $hidden_details);
        }
    }

    public function store_sellShop(Request $request){
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
            $saved_shop = $this->repo->save_sale_details($request);   //save sold shop details
            $get_shop= $this->repo->agentViewShop($saved_shop->property_id);      //get shop id
            $landlord = $this->landlord_repo->findById($get_shop->landlord_id);        //get landlord
            $shop[] = $landlord;
            $shop[] = $saved_shop;
            $shop[] = $get_shop;
            return view('shop.sellshop_reciept')->with('shop', $shop);
        }
    }
}


