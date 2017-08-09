<?php
namespace App\Repositories\House;

use App\Repositories\House\HouseContract;
use App\Property;
use App\Photo;
use Sentinel;
use Illuminate\Support\Facades\Input;
use File;
use App\Landlord;
use App\Properties_allocation;
use App\Properties_sold;

class EloquentHouseRepository implements HouseContract
{
	public function getUserId(){
		return Sentinel::getUser()->id;
	}

	public function create($request) {
		// dd($request);
	    $house = new Property();
	    $this->setHouseProperties($house, $request);
	    $house->save();
	    $property_id=$house->id;

	    $files= Input::file('picture');
	    // dd($files);
	    // $file_count=count($files);
	    // $uploadcount=0;

	    foreach ($files as $file) {
	    	$filename=$file->getClientOriginalName();
	    	$filename=str_ireplace(' ', '_', $filename);
	    	$filename=time().$filename;
	    	// $filename=time().'.'.$file->getClientOriginalExtension();
	    	$upload_success=$file->move(public_path('photo'), $filename);
	    	// $uploadcount++;
	    	Photo::create([        		
        		'property_id'=>$property_id,
        		'photo_name'=>$filename
        		]);
	    }

	    // if ($uploadcount == $file_count) {
	    // 	Session::flash('success','House added successfully');
	    // }

		// for ($i=0; $i < 3; $i++) {
	    	// $picture = time().'.'.$request->picture[$i]->getClientOriginalExtension();
      //   	$request->picture[$i]->move(public_path('photo'), $picture);
      //   	Photo::create([        		
      //   		'property_id'=>$property_id,
      //   		'photo_name'=>$picture
      //   		]);
        	// $house->picture.$i = $request->picture[$i];
	    	// dd($house->picture[$i]);
	    // }


	    // dd($house->id);
	    return $house;
	}

	public function save_allocation_details($request){	
		// dd($request);	
		$house = new Properties_allocation;
		$house->surname = $request->surname;
		$house->othernames = $request->othernames;
		$house->amount_paid_figure = $request->amount_paid_figure;
		$house->amount_paid_words = $request->amount_paid_words;
		$house->supposed_amount = $request->supposed_amount;
		$house->balance_due = $request->balance_due;
		$house->from_date = $request->from_date;
		$house->to_date = $request->to_date;
		$house->description = $request->description;
		$house->payment_category = $request->category;
		$house->recieved_by = $request->collector_name;
		$house->phone_number = $request->phone_number;
		$house->property_id = $request->property_id;
		$house->user_id = $request->user_id;

		$house->save();

		$house_update = $this->findById($request->property_id);		//get house with id and update from vacant to occupied
		$house_update->status = 'occupied';
		$house_update->save();
		return $house;
	}

	public function de_allocate_house($houseId){
		$house_update = $this->findById($houseId);		//get house with id and update from occupied to vacant
		$house_update->status = 'vacant';
		$house_update->save();
		return $house_update;
	}

	public function save_sale_details($request){
		$house = new Properties_sold;
		$house->surname = $request->surname;
		$house->othernames = $request->othernames;
		$house->amount_paid_figure = $request->amount_paid_figure;
		$house->amount_paid_words = $request->amount_paid_words;
		$house->supposed_amount = $request->supposed_amount;
		$house->balance_due = $request->balance_due;
		$house->landlord_name = $request->landlord_name;
		$house->client_address = $request->client_address;
		$house->description = $request->description;
		$house->payment_category = $request->payment_method;
		$house->recieved_by = $request->collector_name;
		$house->client_phone_number = $request->phone_number;
		$house->client_witness_name = $request->client_witness_name;
		$house->client_witness_phone_number = $request->client_witness_phone_number;
		$house->client_witness_address = $request->client_witness_address;
		$house->landlord_witness_name = $request->landlord_witness_name;
		$house->landlord_witness_phone_number = $request->landlord_witness_phone_number;
		$house->landlord_witness_address = $request->landlord_witness_address;
		$house->property_id = $request->property_id;
		$house->user_id = $request->user_id;

		$house->save();

		$house_update = $this->findById($request->property_id);		//get house with id and update from vacant to occupied
		$house_update->status = 'sold';
		$house_update->save();
		return $house;
	}
	
	public function edit($houseId, $request) {
		// dd($houseId);
	    $house = $this->findById($houseId);
	    $this->setHouseProperties($house, $request);
	    $house->save();
	    $property_id=$house->id;

	    // $files= Input::file('picture');

	    // foreach ($files as $file) {
	    // 	$filename=$file->getClientOriginalName();
	    // 	$filename=time().$filename;
	    // 	$upload_success=$file->move(public_path('photo'), $filename);
	    // 	Photo::create([        		
     //    		'property_id'=>$property_id,
     //    		'photo_name'=>$filename
     //    		]);
	    // }

	    return $house;
	}
	
	public function findAll(){
		return \DB::table('properties')->where('property_type', '=', 'house')->get();
	    // return Property::where('property_type','house')->all();
	}

	public function findAllWithPhoto(){
		return Property::where('property_type', '=', 'house')->with('photo')->get();
	    // return Property::where('property_type','house')->all();
	}

	//fix them directly under their correspondence
	public function agentViewHouse($houseId){
		$agentId = $this->getUserId();
		$property = Property::where('user_id','=', $agentId)->with('photo')->find($houseId);

	    return $property;
	}	

	public function agentEditHouse($houseId, $request){
		$agentId = $this->getUserId();
		// dd($houseId);
	    $house = $this->agentViewHouse($houseId);
	    $this->setHouseProperties($house, $request);
	    $house->save();
	    $property_id=$house->id;

	    return $house;
	}

	public function agentDeleteHouse($houseId){
		$agentId = $this->getUserId();
		/** creating an instance of the property model
		**/
	    $house = Property::where('user_id','=', $agentId)->find($houseId);
	    /** deleting the file from photo folder
	    **/
	    $getphotoName = $this->agentViewHouse($houseId);
	    $photofiles = $getphotoName->photo;
	    foreach ($photofiles as $file) {
	    	// dd($file);
	    	$photofile=public_path("photo/$file->photo_name");
	    	if (file_exists($photofile)) {
	    		unlink(public_path("photo/$file->photo_name"));
	    	}
	    }

	    /**delete file name from photos database table
	    **/
		$house->photo()->delete();
		return $house->delete();
	}

	public function agentFindAllByMe(){
		$agentId = $this->getUserId();
		return \DB::table('properties')
			->where('property_type', '=', 'house')
			->where('user_id','=', $agentId)
			->get();
	}
	
	public function findById($houseId){
		// $property=[];
		$property = Property::with('photo')->find($houseId);
		// dd($property->photo[0]);

	    return $property;
	}
	
	public function remove($houseId) {
		/** creating an instance of the property model
		**/
	    $house = Property::find($houseId);

	    /** deleting the file from photo folder
	    **/
	    $getphotoName = $this->findById($houseId);
	    $photofiles = $getphotoName->photo;
	    foreach ($photofiles as $file) {
	    	// dd($file);
	    	$photofile=public_path("photo/$file->photo_name");
	    	if (file_exists($photofile)) {
	    		unlink(public_path("photo/$file->photo_name"));
	    	}
	    }
	    // File::delete($photofiles);
	    // dd($photofiles);

	    /**delete file name from photos database table
	    **/
	    // dd($house->photo());
		$house->photo()->delete();
		return $house->delete();
	}

	// public function findByName($propertyName){		//uncomment this function later on
		
	// }

	public function getAllLandlord(){
		return Landlord::get();
	}
	
	private function setHouseProperties($house, $request) {
		if (isset($request->landlord)) {			
	    	$house->landlord_id = $request->landlord;
		}
	    $house->location = $request->location;
	    $house->scope = $request->scope;
	    $house->description = $request->description;
	    $house->type = $request->type;
	    $house->rooms = $request->rooms;
	    $house->bathrooms = $request->bathrooms;
	    $house->sitting_room = $request->sitting_room;
	    $house->size = $request->size;
	    $house->coo_roo = $request->coo_roo;
	    $house->status = $request->status;
	    $house->price = $request->price;
	    $house->property_type = $request->property_type;
	    
	    // for ($i=0; $i < 3; $i++) {
	    // 	$picture = time().'.'.$request->picture[$i]->getClientOriginalExtension();
     //    	$request->picture[$i]->move(public_path('photo'), $picture);
     //    	$house->picture.$i = $request->picture[$i];
	    // }

	    // print_r($images);
	    // dd($house->picture[$i]);
	    // $house->picture[$i] = $request->picture[$i];
	    // dd($request->picture[$i]);
	    // $house->picture[0] = $request->picture[1];
	    // $house->picture = $request->picture[2];
	    $house->user_id = Sentinel::getUser()->id;
	    // dd($house->picture0);
	}
}
