<?php

namespace App\Repositories\Land;

interface LandContract
{
	public function create($request);
	public function edit($landId, $request);
	public function findAll();
	public function findById($landId);
	public function remove($landId);
	public function getAllLandlord();
	public function agentViewLand($landId);	
	public function agentEditLand($landId, $request);
	public function agentDeleteLand($landId);
	public function agentFindAllByMe();
	public function getUserId();
	public function findAllWithPhoto();
	public function save_allocation_details($request);
	public function de_allocate_land($landId);
	public function save_sale_details($request);
}
