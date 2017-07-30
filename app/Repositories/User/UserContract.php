<?php

namespace App\Repositories\User;

interface UserContract
{
	public function create($request);
	public function findAll();
	public function findById($userId);
	public function edit($userId, $request);
	public function remove($userId);
	public function findByIdWithRole($userId);
	public function findAllAgents();
}
