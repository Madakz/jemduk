<?php

namespace App\Repositories\User;
use App\Repositories\User\UserContract;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\User;
// use Sentinel;

class EloquentUserRepository implements UserContract
{

	public function create($request) {
        // if ($request->user_role == 'landlord') {
        //     $newagent='nil';
        // }else{
            $agent=User::orderBy('id', 'desc')->where('agent_number','!=','nil')->first();
            // dd($agent);
            // $agent=User::latest()->first();
            $agent=$agent['agent_number'];
            $agent=substr($agent, 3);
            $agent ++;
            $newagent=strlen($agent) < 2?"JEM00".$agent:"JEM0".$agent;
        // }   //end else


        // $agent=User::orderBy('id', 'desc')->first();
        // // $agent=User::latest()->first();
        // $agent=$agent['agent_number'];
        // $agent=substr($agent, 3);
        // $agent ++;
        // $newagent=strlen($agent) < 2?"JEM00".$agent:"JEM0".$agent;
        $picture = time().'.'.$request->picture->getClientOriginalExtension();
        $request->picture->move(public_path('photo'), $picture);
        // dd($picture);
	    $credentials = [
            'picture' => $picture,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'status' => $request->status,
            'address' => $request->address,
            'password' => $request->password,
            'agent_number' => $newagent,
        ];
        
        // $user_role=$request->user_role;
        // dd($user_role);
        $user = Sentinel::registerAndActivate($credentials);
        // $role = Sentinel::findRoleBySlug($user_role);
        // $role->users()->attach($user);
        // dd($user);
        return $user;
	}

    public function findAll(){
                
                $user = User::get();
                $users = \DB::table('users')
                    ->join('role_users', function($join)
                    {
                        $join->on('users.id', '=', 'role_users.user_id')
                             ->orwhere('role_users.role_id', '!=', 4);
                    })
                    ->get();
            // dd($users);
        return $users;
    }

    public function findAllAgents(){
        $users=User::where('status','=','agent')->get();
        return $users;
    }

    public function findById($userId){
        return User::find($userId);
    }

    public function findByIdWithRole($userId){
        $users=[];
       $users=\DB::table('users')
            ->join('role_users', function ($join) use ($userId) {
                $join->on('users.id', '=', 'role_users.user_id')
                     ->where('role_users.user_id', '=', $userId);
                    })
            ->get();
        $role=$users['0']->role_id;

        $users[]=\DB::table('roles')->where('id',$role)->first();
        // dd($users);
        return $users;
    }

    public function edit($userId, $request){
        $agent = Sentinel::findById($userId);

        $user_details= [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address' => $request->phone_number,
            'phone_number' => $request->address,
            'status' => $request->status
        ];
        $agent = Sentinel::update($agent, $user_details);
        return $agent;
    }

    public function remove($userId){
        $user = $this->findById($userId);
        // dd(public_path("photo/$user->picture"));
        $file=public_path("photo/$user->picture");
        /**
            delete user picture from folder
        **/
        if (file_exists($file)) {
            unlink(public_path("photo/$user->picture"));
        }
        return $user->delete();
    }

}