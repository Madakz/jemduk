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
            	'location' => 'required',
            	'type' => 'required',
            	'scope' => 'required',
                'size' => 'required',
            	'coo_roo' => 'required',
            	'status' => 'required',
                'price' => 'required',
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

    public function allocate(){
        return view('shop.allocate');
    }

    public function de_allocate(){
        return view('shop.show');
    }
}


