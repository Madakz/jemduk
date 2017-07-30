<?php

namespace App\Repositories\Landlord;

interface LandlordContract
{	
	public function findAll();
	public function create($request);
	public function findById($landlordId);
	public function edit($landlordId, $request);
	public function findByIdWithRole($landlordId);
	public function remove($landlordId);
	public function getUserId();
	public function agentViewLandlord($landlordId);	
	public function agentEditLandlord($landlordId, $request);
	public function agentDeleteLandlord($landlordId);
	public function agentFindAllByMe();
}
