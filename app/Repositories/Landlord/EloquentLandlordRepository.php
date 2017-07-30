<?php
namespace App\Repositories\Landlord;
use App\Repositories\Landlord\LandlordContract;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\User;
use App\Landlord;
use Illuminate\Support\Facades\Input;
use File;

class EloquentLandlordRepository implements LandlordContract
{
    public function getUserId(){
        return Sentinel::getUser()->id;
    }
    
    public function create($request){
        // dd($request);
        $landlord = new Landlord();
        $this->setlandlorddetails($landlord, $request);
        $landlord = $landlord->save();

        return $landlord;
    }

    public function findAll(){
        return Landlord::get();
        //     $users = \DB::table('users')
        //         ->join('role_users', function($join)
        //         {
        //             $join->on('users.id', '=', 'role_users.user_id')
        //                  ->where('role_users.role_id', '=', 4);
        //         })
        //         ->get();
        //     // dd($users);
        // return $users;
    }

    public function findById($landlordId){
        return Landlord::find($landlordId);
    }

    public function findByIdWithRole($landlordId){
        $users=[];
       $users=\DB::table('users')
            ->join('role_users', function ($join) use ($landlordId) {
                $join->on('users.id', '=', 'role_users.user_id')
                     ->where('role_users.user_id', '=', $landlordId);
                    })
            ->get();
        $role=$users['0']->role_id;

        $users[]=\DB::table('roles')->where('id',$role)->first();
        // dd($users);
        return $users;
    }

    public function edit($landlordId, $request){
        // dd($request);
        $landlord = $this->findById($landlordId);
        $this->setlandlorddetails($landlord, $request);
        $landlord->save();
        return $landlord;
    }

    public function agentViewLandlord($landlordId){
        $agentId = $this->getUserId();
        return Landlord::where('user_id', '=', $agentId)->find($landlordId);

    } 

    public function agentEditLandlord($landlordId, $request){
        $agentId = $this->getUserId();
        $landlord = $this->agentViewLandlord($landlordId);
        $this->setlandlorddetails($landlord, $request);
        $landlord->save();
        return $landlord;
    }

    public function agentDeleteLandlord($landlordId){
        $agentId = $this->getUserId();
        $landlord = $this->agentViewLandlord($landlordId);
        $file=public_path("photo/$landlord->picture");
        
        // delete landlord picture from folder       
        if (file_exists($file)) {
            unlink(public_path("photo/$landlord->picture"));
        }
        return $landlord->delete();
    }

    public function agentFindAllByMe(){
        $agentId = $this->getUserId();
        return Landlord::where('user_id', '=', $agentId)->get();
    }

    public function remove($landlordId){
        $landlord = $this->findById($landlordId);
        $file=public_path("photo/$landlord->picture");

        
        // delete landlord picture from folder        
        if (file_exists($file)) {
            unlink(public_path("photo/$landlord->picture"));
        }
        return $landlord->delete();
    }

    private function setlandlorddetails($landlord, $request){
        if (isset($request->picture) && isset($request->state)) {
            $picture = time().'.'.$request->picture->getClientOriginalExtension();
            $request->picture->move(public_path('photo'), $picture);
            $landlord->picture=$picture;
            $landlord->state=$request->state;
            $landlord->local_govt=$request->local_govt;
        }

        $landlord->surname=$request->surname;
        $landlord->othername=$request->othername;
        $landlord->email=$request->email;
        $landlord->phone_number=$request->phone_number;
        $landlord->address=$request->address;
        $landlord->gender=$request->gender;
        $landlord->bank_account=$request->bank_account;
        $landlord->bank_name=$request->bank_name;        
        $landlord->user_id = Sentinel::getUser()->id;
    }

}