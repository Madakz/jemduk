<?php

namespace App\Repositories\Shop;
use App\Repositories\Shop\ShopContract;
use App\Property;
use App\Photo;
use Sentinel;
use Illuminate\Support\Facades\Input;
use App\Landlord;

class EloquentShopRepository implements ShopContract
{
	public function getUserId(){
		return Sentinel::getUser()->id;
	}

	public function create($request) {
	    $shop = new Property();
	    $this->setShopProperties($shop, $request);
	    $shop->save();
	    $property_id = $shop->id;
	    

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
	    return $shop;
	}
	
	public function edit($shopId, $request) {
	    $shop = $this->findById($shopId);
	    $this->setShopProperties($shop, $request);
	    $shop->save();
	    return $shop;
	}
	
	public function findAll(){
		return \DB::table('properties')->where('property_type', '=', 'shop')->get();
	    // return Property::all();
	}

	public function agentViewShop($shopId){
		$agentId = $this->getUserId();
		return Property::where('user_id', '=', $agentId)->with('photo')->find($shopId);
	}

	public function agentEditShop($shopId, $request){
		$agentId = $this->getUserId();
		$shop = $this->agentViewShop($shopId);
	    $this->setShopProperties($shop, $request);
	    $shop->save();
	    return $shop;
	}

	public function agentDeleteShop($shopId){
		$agentId = $this->getUserId();
		$shop = Property::where('user_id', '=', $agentId)->find($shopId);
		/** deleting the file from photo folder
	    **/
	    $getphotoName = $this->agentViewShop($shopId);
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
		$shop->photo()->delete();
		return $shop->delete();
	}

	public function agentFindAllByMe(){
		$agentId = $this->getUserId();
		return \DB::table('properties')
			->where('property_type', '=', 'shop')
			->where('user_id', '=', $agentId)
			->get();
	}
	
	public function findById($shopId){
	    return Property::with('photo')->find($shopId);
	}
	
	public function remove($shopId) {
		$shop = Property::find($shopId);
		/** deleting the file from photo folder
	    **/
	    $getphotoName = $this->findById($shopId);
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
		$shop->photo()->delete();
		return $shop->delete();
	}

	public function getAllLandlord(){
		return Landlord::get();
	}
	
	private function setShopProperties($shop, $request) {
		if (isset($request->landlord)) {			
	    	$shop->landlord_id = $request->landlord;
		}
		// dd($request);
		$shop->location = $request->location;
		$shop->scope = $request->scope;
		$shop->description = $request->description;
	    $shop->type = $request->type;
	    $shop->rooms = 'nil';
	    $shop->bathrooms = 'nil';
	    $shop->sitting_room = 'nil';
	    $shop->size = $request->size;
	    $shop->coo_roo = $request->coo_roo;
	    $shop->status = $request->status;
	    $shop->price = $request->price;
	    $shop->property_type = $request->property_type;
	    $shop->user_id = Sentinel::getUser()->id;
		
	}
}
