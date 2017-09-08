<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\House\HouseContract;
use App\Repositories\Land\LandContract;
use App\Repositories\Shop\ShopContract;
use App\Repositories\Landlord\LandlordContract;
use App\Repositories\User\UserContract;
use Sentinel;

class HomeController extends Controller
{
    protected $house_repo;
    protected $land_repo;
    protected $shop_repo;
    protected $landlord_repo;
    protected $user_repo;

    public function __construct(HouseContract $houseContract, LandlordContract $landlordContract, ShopContract $shopContract, LandContract $landContract, UserContract $userContract){
        $this->house_repo = $houseContract;
        $this->land_repo = $landContract;
        $this->landlord_repo = $landlordContract;
        $this->shop_repo = $shopContract;
        $this->user_repo = $userContract;
    }

    public function superadmin() {
    	if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
            $house = $this->house_repo->findAll();
            $house_count = count($house);
            $dashboard[] = $house_count;

            $land = $this->land_repo->findAll();
            $land_count = count($land);
            $dashboard[] = $land_count;

            $landlord = $this->landlord_repo->findAll();
            $landlord_count = count($landlord);
            $dashboard[] = $landlord_count;

            $user = $this->user_repo->findAllAgents();
            $user_count = count($user);
            $dashboard[] = $user_count;

            $shop = $this->shop_repo->findAll();
            $shop_count = count($shop);
            $dashboard[] = $shop_count;

            //This would be for the uploaded documents
            // $shop = $this->shop_repo->findAll();
            // $shop_count = count($shop);
            // $dashboard[] = $shop_count;
            // dd($shop_count);
            // dd($dashboard);
        	return view('dashboard.superadmin_index')->with('dashboard', $dashboard);
        }
    }
    
    public function admin() {
    	if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
        	return view('dashboard.admin_index');
        }
    }
    
    public function agent() {
    	if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
            $house = $this->house_repo->agentFindAllByMe();
            $house_count = count($house);
            $dashboard[] = $house_count;

            $land = $this->land_repo->agentFindAllByMe();
            $land_count = count($land);
            $dashboard[] = $land_count;

            $landlord = $this->landlord_repo->agentFindAllByMe();
            $landlord_count = count($landlord);
            $dashboard[] = $landlord_count;

            $shop = $this->shop_repo->agentFindAllByMe();
            $shop_count = count($shop);
            $dashboard[] = $shop_count;
        	return view('dashboard.agent_index')->with('dashboard', $dashboard);
        }
    }
}
