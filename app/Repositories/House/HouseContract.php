<?php

namespace App\Repositories\House;

interface HouseContract
{
	public function create($request);
	public function edit($houseId, $request);
	public function findAll();
	public function findById($houseId);
	public function remove($houseId);
	public function getAllLandlord();	
	public function agentViewHouse($houseId);	
	public function agentEditHouse($houseId, $request);
	public function agentDeleteHouse($houseId);
	public function agentFindAllByMe();
	public function getUserId();
	// public function findByName($propertyName);		//may use this later
}