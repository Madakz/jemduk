<?php
namespace App\Repositories\ClientView;

interface ClientViewContract{
	public function viewPropertyForSell();
	public function viewPropertyForRent();
	public function viewPropertyForLease();
	public function getAllPropertiesPhoto();
	public function findPropertyById($propertyId);
	public function create_property_request($request);
	public function save_get_intouch($request);
}