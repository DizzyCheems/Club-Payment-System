<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function custom_login(Request $request)
    {
        $credentials = $request->only('email', 'password', 'role');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/students/add'); 
        }

        return back()->withInput()->withErrors(['email' => 'Invalid credentials']); 
    }
    /**
     * Display a listing of the resource.
     */
    public function index()     
    {
        $users = User::all(); 
        return view('users.list', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view ('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {      
      $message=[
          'required' => 'This field is required!'
      ];
    
      $request->validate([      
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'role' => 'required',
        'password' => 'required|confirmed',
      ], $message);
    
      $user = User::where('email', $request->email)->first();
    
      if($user){
        return redirect()->back()->withInput()->withErrors(['email' => 'Email already exists.']);
      }
    
      User::create([
        'name' => $request->name, 
        'email' => $request->email,
        'role' => Str::upper($request->role),
        'password' => Hash::make($request->password),
      ]);
    
      return redirect()->route('user.index')->with('success', 'User Registered Successfully');    
    }

    /**
     * Display the specified resource.
     */
    public function view($id)
    {
        //
        $data=User::find($id);
        return view ('users.view',['user'=>$data]);   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data=User::find($id);
        return view('users.edit',['user'=>$data]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
        $message=[
            'required' => 'This credential field is required!',
            'unique' => 'This email address is already registered!',
        ]; 
        $request->validate([
            'name' =>'nullable',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'role' =>'nullable',
            'password' =>'nullable',
    
        ],$message);
        $user=User::find($request->id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->role= Str::upper($request->role);
        $user->password=Hash::make($request->password);
        $user->save();
        return redirect()->route('user.index')
        ->with('success', 'User, Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

 	// handle delete an employee ajax request
     public function delete(Request $request) {
		$id = $request->id;
		$data = User::find($id);
		User::destroy($id);
      }
}
