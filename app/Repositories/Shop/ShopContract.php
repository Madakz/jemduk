<?php

namespace App\Repositories\Shop;

interface ShopContract
{
	public function create($request);
	public function edit($shopId, $request);
	public function findAll();
	public function findById($shopId);
	public function remove($shopId);
	public function getAllLandlord();
	public function agentViewShop($shopId);
	public function agentEditShop($shopId, $request);
	public function agentDeleteShop($shopId);
	public function agentFindAllByMe();
	public function getUserId();
	public function findAllWithPhoto();
	public function save_allocation_details($request);
	public function de_allocate_shop($shopId);
	public function save_sale_details($request);
}