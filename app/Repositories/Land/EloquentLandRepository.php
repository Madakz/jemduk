<?php

namespace App\Repositories\Land;
use App\Repositories\Land\LandContract;
use App\Property;
use App\Photo;
use Sentinel;
use Illuminate\Support\Facades\Input;
use App\Landlord;

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
	
	public function edit($landId, $request) {
	    $land = $this->findById($landId);
	    $this->setLandProperties($land, $request);
	    $land->save();
	    return $land;
	}
	
	public function findAll(){
		return \DB::table('properties')->where('property_type', '=', 'land')->get();
	    // return Property::all();
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
