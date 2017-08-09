<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\User\UserContract;
use App\Repositories\ClientView\ClientViewContract;
use App\Repositories\House\HouseContract;
use App\Repositories\Land\LandContract;
use App\Repositories\Shop\ShopContract;
use Sentinel;

class ClientController extends Controller
{
    protected $repo;
    protected $clientViewRepo;
    protected $houseRepo;
    protected $landRepo;
    protected $shopRepo;

    public function __construct(UserContract $userContract, ClientViewContract $ClientViewContract, HouseContract $houseContract, LandContract $landContract, ShopContract $shopContract) {
        $this->repo = $userContract;
        $this->clientViewRepo = $ClientViewContract;
        $this->houseRepo = $houseContract;
        $this->landRepo = $landContract;
        $this->shopRepo = $shopContract;
    }

    public function about(){
    	return view('clientviews.about');
    }

    public function agent(){
        $users = $this->repo->findAllAgents();
        return view('clientviews.agents')->with('users', $users);
    }

    public function forSell(){
        $properties = $this->clientViewRepo->viewPropertyForSell();
    	return view('clientviews.forSellProperties')->with('properties', $properties);
    }

    public function forRent(){
        $properties = $this->clientViewRepo->viewPropertyForRent();
    	return view('clientviews.forRentProperties')->with('properties', $properties);
    }

    public function forLease(){
        $properties = $this->clientViewRepo->viewPropertyForLease();
    	return view('clientviews.forLeaseProperties')->with('properties', $properties);
    }

    public function gallery(){
        $properties = $this->clientViewRepo->getAllPropertiesPhoto();
    	return view('clientviews.gallery')->with('properties', $properties);
    }

    public function service(){
    	return view('clientviews.service');
    }

    public function faqs(){
    	return view('clientviews.faq');
    }

    public function show($id){
        $property = $this->clientViewRepo->findPropertyById($id);
        // dd($property);
        return view('clientviews.show')->with('property', $property);
    }

    public function request_property($id){
        return view('clientviews.request')->with('id', $id);
    }

    public function store_request(Request $request){
        // dd($request);
        $this->validate($request, [
            'fullname' => 'required',
            'email' => 'required|Between:3,64|email',
            'city/state' => 'required',
            'phone_number' => 'required|numeric',
            'message' => 'required|AlphaNum',
        ]);


        $save_request = $this->clientViewRepo->create_property_request($request);
        // dd($save_request);
        if ($save_request->id) {
            return redirect()->route('show_property',[$save_request->property_id])
                ->with('success', 'Your request has been successfully sent, you will recieve a reply shortly in your email');
        } else {
            return back()
                ->withInput()
                ->with('error', 'Issues encountered, Try again!');
        }
    }

    public function get_intouch(Request $request){
        // dd($request);
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|Between:3,100|email',
            'subject' => 'required',
            'message' => 'required|AlphaNum',
        ]);
        $get_intouch = $this->clientViewRepo->save_get_intouch($request);
        if ($get_intouch->id) {
            return back()
                ->withInput()
                ->with('success','Thankyou for your message, We will reply you shortly');
        }else{
            return back()
                ->withInput
                ->with('error', 'issues encountered, pls try again!');
        }
    }

    public function allhouses(){
        $properties = $this->houseRepo->findAllWithPhoto();
        // dd($properties);
        return view('clientviews.houses')->with('properties', $properties);
    }

    public function alllands(){
        $properties = $this->landRepo->findAllWithPhoto();
        return  view('clientviews.lands')->with('properties', $properties);
    }

    public function allshops(){
        $properties = $this->shopRepo->findAllWithPhoto();
        return view('clientviews.shops')->with('properties', $properties);
    }
}
