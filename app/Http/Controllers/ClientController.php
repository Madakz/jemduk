<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\User\UserContract;
use App\Repositories\ClientView\ClientViewContract;
use Sentinel;

class ClientController extends Controller
{
    protected $repo;
    protected $clientViewRepo;

    public function __construct(UserContract $userContract, ClientViewContract $ClientViewContract) {
        $this->repo = $userContract;
        $this->clientViewRepo = $ClientViewContract;
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
            'email' => 'required',
            'phone_number' => 'required',
            'message' => 'required',
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
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
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
}
