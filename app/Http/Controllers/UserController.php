<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\User\UserContract;
use Sentinel;

class UserController extends Controller
{
    	protected $repo;

			public function __construct(UserContract $userContract) {
				$this->repo = $userContract;
			}

	    /**
	     * Display a listing of the resource.
	     *
	     * @return \Illuminate\Http\Response
	     */
	    public function index()
	    {
	    	if (Sentinel::guest())
	        {
	            return redirect()->route('login');
	        }else{
		    	$users = $this->repo->findAllAgents();
		        return view('user.index')->with('users', $users);
		    }
	    }

	    /**
	     * Show the form for creating a new resource.
	     *
	     * @return \Illuminate\Http\Response
	     */
	    public function create()
	    {
	        
	    }

	    /**
	     * Store a newly created resource in storage.
	     *
	     * @param  \Illuminate\Http\Request  $request
	     * @return \Illuminate\Http\Response
	     */
	    public function store(Request $request)
	    {
	    	if (Sentinel::guest())
	        {
	            return redirect()->route('login');
	        }else{
		        $this->validate($request, [
		        	'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		            'first_name' => 'required',
		            'last_name' => 'required',
		            'email' => 'required|unique:users',
		            // 'user_role' => 'required',
		            'status' => 'required',
		            'phone_number' => 'required',
		            'address' => 'required',
		            'password' => 'required|min:6',
		            'confirm_password' => 'required|min:6|same:password',
		            // required|min:3|confirmed
		        ]);
		        
		       
		       // dd($request);
		        $user = $this->repo->create($request);
		        // dd($user);
		        if ($user->id) {
		            return redirect(route('register'))->withInput()->with('success', 'User Succesfully added');
		        } else {
		            return back()
		                ->withInput()
		                ->with('error', 'Could not add User. Try again.');
		        }
		    }
	    }

	    /**
	     * Display the specified resource.
	     *
	     * @param  int  $id
	     * @return \Illuminate\Http\Response
	     */
	    public function show($id)
	    {
	    	if (Sentinel::guest())
	        {
	            return redirect()->route('login');
	        }else{
		        $users = $this->repo->findById($id);
		        // $users = $this->repo->findByIdWithRole($id);
		        if (!$users) {
		        	return view('authentication.login');
		        }
	        
	        	return view('user.show', ['users' => $users]);
	        }
	    }

	    /**
	     * Show the form for editing the specified resource.
	     *
	     * @param  int  $id
	     * @return \Illuminate\Http\Response
	     */
	    public function edit($id)
	    {
	    	if (Sentinel::guest())
	        {
	            return redirect()->route('login');
	        }else{
		        $users = $this->repo->findById($id);
		        if (!$users) {
		        	return view('authentication.login');
		        }
		        
		        return view('user.edit', ['users' => $users]);
		    }
	    }

	    /**
	     * Update the specified resource in storage.
	     *
	     * @param  \Illuminate\Http\Request  $request
	     * @param  int  $id
	     * @return \Illuminate\Http\Response
	     */
	    public function update(Request $request, $id)
	    {
	    	if (Sentinel::guest())
	        {
	            return redirect()->route('login');
	        }else{
		    	$this->validate($request, [
		            'first_name' => 'required',
		            'last_name' => 'required',
		            'email' => 'required',
		            // 'user_role' => 'required',
		            // 'status' => 'required',
		            'phone_number' => 'required',
		            'address' => 'required',
		        ]);
		        $users = $this->repo->edit($id, $request);
		        if ($users->id) {
		        	return redirect()->route("agent_index")
		        		->with('success', 'Agent is successfully updated');
		        } else {
		        	return back()
		        		->withInput()
		        		->with('error', 'Issues encountered, Try again!');
		        }
		    }  
	    }

	    /**
	     * Remove the specified resource from storage.
	     *
	     * @param  int  $id
	     * @return \Illuminate\Http\Response
	     */
	    public function destroy($id)
	    {
	    	if (Sentinel::guest())
	        {
	            return redirect()->route('login');
	        }else{
		        $users = $this->repo->remove($id);
		        return redirect()->route('agent_index')
	        	->with('success', 'Agent is deleted successfully');
	        }
	    }
}
