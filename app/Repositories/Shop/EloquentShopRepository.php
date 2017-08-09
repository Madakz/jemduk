<?php

namespace App\Repositories\Shop;
use App\Repositories\Shop\ShopContract;
use App\Property;
use App\Photo;
use Sentinel;
use Illuminate\Support\Facades\Input;
use App\Landlord;
use App\Properties_allocation;
use App\Properties_sold;


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

	public function save_allocation_details($request){	
		// dd($request);	
		$shop = new Properties_allocation;
		$shop->surname = $request->surname;
		$shop->othernames = $request->othernames;
		$shop->amount_paid_figure = $request->amount_paid_figure;
		$shop->amount_paid_words = $request->amount_paid_words;
		$shop->supposed_amount = $request->supposed_amount;
		$shop->balance_due = $request->balance_due;
		$shop->from_date = $request->from_date;
		$shop->to_date = $request->to_date;
		$shop->description = $request->description;
		$shop->payment_category = $request->category;
		$shop->recieved_by = $request->collector_name;
		$shop->phone_number = $request->phone_number;
		$shop->property_id = $request->property_id;
		$shop->user_id = $request->user_id;

		$shop->save();

		$shop_update = $this->findById($request->property_id);		//get house with id and update from vacant to occupied
		// dd($shop_update);
		$shop_update->status = 'occupied';
		$shop_update->save();
		return $shop;
	}

	public function save_sale_details($request){
		$shop = new Properties_sold;
		$shop->surname = $request->surname;
		$shop->othernames = $request->othernames;
		$shop->amount_paid_figure = $request->amount_paid_figure;
		$shop->amount_paid_words = $request->amount_paid_words;
		$shop->supposed_amount = $request->supposed_amount;
		$shop->balance_due = $request->balance_due;
		$shop->landlord_name = $request->landlord_name;
		$shop->client_address = $request->client_address;
		$shop->description = $request->description;
		$shop->payment_category = $request->payment_method;
		$shop->recieved_by = $request->collector_name;
		$shop->client_phone_number = $request->phone_number;
		$shop->client_witness_name = $request->client_witness_name;
		$shop->client_witness_phone_number = $request->client_witness_phone_number;
		$shop->client_witness_address = $request->client_witness_address;
		$shop->landlord_witness_name = $request->landlord_witness_name;
		$shop->landlord_witness_phone_number = $request->landlord_witness_phone_number;
		$shop->landlord_witness_address = $request->landlord_witness_address;
		$shop->property_id = $request->property_id;
		$shop->user_id = $request->user_id;

		$shop->save();

		$shop_update = $this->findById($request->property_id);		//get shop with id and update from vacant to occupied
		$shop_update->status = 'sold';
		$shop_update->save();
		return $shop;
	}

	public function de_allocate_shop($shopId){
		$shop_update = $this->findById($shopId);		//get shop with id and update from occupied to vacant
		$shop_update->status = 'vacant';
		$shop_update->save();
		return $shop_update;
	}
	
	public function edit($shopId, $request) {
	    $shop = $this->findById($shopId);
	    $this->setShopProperties($shop, $request);
	    $shop->save();
	    return $shop;
	}
	
	public function findAll(){
		return Property::where('property_type', '=', 'shop')->get();
	}

	public function findAllWithPhoto(){
		return Property::where('property_type', '=', 'shop')->with('photo')->get();
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
