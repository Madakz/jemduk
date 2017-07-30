<?php
namespace App\Repositories\ClientView;
use App\Repositories\ClientView\ClientViewContract;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Property;
use App\Photo;
use App\Property_request_messages;
use App\Get_intouch_messages;

class EloquentClientViewRepository implements ClientViewContract{

	public function viewPropertyForSell(){
		$properties = Property::with('photo')->where('scope', '=', 'Sale')->get();
		return $properties;
	}

	public function viewPropertyForRent(){
		$properties = Property::with('photo')->where('scope', '=', 'Rent')->get();
		return $properties;
	}

	public function viewPropertyForLease(){
		$properties = Property::with('photo')->where('scope', '=', 'Lease')->get();
		return $properties;
	}

	public function getAllPropertiesPhoto(){
		$properties = Photo::get();
		return $properties;
	}

	public function findPropertyById($propertyId){
		$properties = Property::with('photo')
								->where('id','=', $propertyId)
								->first();
		return $properties;
	}

	public function create_property_request($request){
		// dd($request);
		$request_obj = new Property_request_messages;
        $request_obj->fullname = $request->fullname;
        $request_obj->phone_number = $request->phone_number;
        $request_obj->email = $request->email;
        $request_obj->city_state = $request->city_state;
        $request_obj->message = $request->message;
        $request_obj->property_id = $request->property_id;
        $request_obj->save();
        return $request_obj;
	}

	public function save_get_intouch($request){
		$get_intouch = new Get_intouch_messages;
		$get_intouch->first_name = $request->first_name;
		$get_intouch->last_name = $request->last_name;
		$get_intouch->email = $request->email;
		$get_intouch->subject = $request->subject;
		$get_intouch->message = $request->message;
		$get_intouch->save();
		return $get_intouch;
	}
}