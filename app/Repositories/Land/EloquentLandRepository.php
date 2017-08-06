<?php

namespace App\Repositories\Land;
use App\Repositories\Land\LandContract;
use App\Property;
use App\Photo;
use Sentinel;
use Illuminate\Support\Facades\Input;
use App\Landlord;
use App\Properties_allocation;

class EloquentLandRepository implements LandContract
{
	public function getUserId(){
		return Sentinel::getUser()->id;
	}

	public function create($request) {
	    $land = new Property();
	    $this->setLandProperties($land, $request);
	    $land->save();
	    $property_id = $land->id;

	    $files= Input::file('picture');

	    foreach ($files as $file) {
	    	$filename=$file->getClientOriginalName();
	    	$filename=time().$filename;
	    	$upload_success=$file->move(public_path('photo'), $filename);
	    	Photo::create([        		
        		'property_id'=>$property_id,
        		'photo_name'=>$filename
        		]);
	    }

	    return $land;
	}

	public function save_allocation_details($request){	
		$land = new Properties_allocation;
		$land->surname = $request->surname;
		$land->othernames = $request->othernames;
		$land->amount_paid_figure = $request->amount_paid_figure;
		$land->amount_paid_words = $request->amount_paid_words;
		$land->supposed_amount = $request->supposed_amount;
		$land->balance_due = $request->balance_due;
		$land->from_date = $request->from_date;
		$land->to_date = $request->to_date;
		$land->description = $request->description;
		$land->payment_category = $request->category;
		$land->recieved_by = $request->collector_name;
		$land->phone_number = $request->phone_number;
		$land->property_id = $request->property_id;
		$land->user_id = $request->user_id;

		$land->save();

		$land_update = $this->findById($request->property_id);		//get land with id and update from vacant to occupied
		$land_update->status = 'occupied';
		$land_update->save();
		return $land;
	}

	public function de_allocate_land($landId){
		$land_update = $this->findById($landId);		//get land with id and update from occupied to vacant
		$land_update->status = 'vacant';
		$land_update->save();
		return $land_update;
	}
	
	public function edit($landId, $request) {
	    $land = $this->findById($landId);
	    $this->setLandProperties($land, $request);
	    $land->save();
	    return $land;
	}
	
	public function findAll(){
		return Property::where('property_type', '=', 'land')->get();
	}

	public function findAllWithPhoto(){
		return Property::where('property_type', '=', 'land')->with('photo')->get();
	}

	public function agentViewLand($landId){
		$agentId = $this->getUserId();
		return Property::where('user_id','=', $agentId)->with('photo')->find($landId);
	}	

	public function agentEditLand($landId, $request){
		$agentId = $this->getUserId();
		$land = $this->agentViewLand($landId);
	    $this->setLandProperties($land, $request);
	    $land->save();
	    return $land;

	}

	public function agentDeleteLand($landId){
		$agentId = $this->getUserId();
		$land = Property::where('user_id', '=', $agentId)->find($landId);
		/** deleting the file from photo folder
	    **/
	    $getphotoName = $this->agentViewLand($landId);
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
		$land->photo()->delete();
		return $land->delete();

	}

	public function agentFindAllByMe(){
		$agentId = $this->getUserId();
		return \DB::table('properties')
			->where('property_type', '=', 'land')
			->where('user_id','=', $agentId)
			->get();
	}
	
	public function findById($landId){
	    return Property::with('photo')->find($landId);
	}
	
	public function remove($landId) {
		$land = Property::find($landId);
		/** deleting the file from photo folder
	    **/
	    $getphotoName = $this->findById($landId);
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
		$land->photo()->delete();
		return $land->delete();
	}

	public function getAllLandlord(){
		return Landlord::get();
	}
	
	private function setLandProperties($land, $request) {
		if (isset($request->landlord)) {			
	    	$land->landlord_id = $request->landlord;
		}
		// dd($request);
		$land->location = $request->location;
		$land->scope = $request->scope;
		$land->description = $request->description;
	    $land->type = $request->type;
	    $land->rooms = 'nil';
	    $land->bathrooms = 'nil';
	    $land->sitting_room = 'nil';
	    $land->size = $request->size;
	    $land->coo_roo = $request->coo_roo;
	    $land->status = $request->status;
	    $land->price = $request->price;
	    $land->property_type = $request->property_type;
	    $land->user_id = Sentinel::getUser()->id;
	}
}
