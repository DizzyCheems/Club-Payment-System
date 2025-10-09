<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
        $courses = Course::all();
        return view('users.create', ['courses' => $courses]);
    }

    public function create_user()
    {
        $courses = Course::all();
        return view('users.create_user', ['courses' => $courses]);
    }

    /**
     * Store a newly created admin user in storage.
     */
    public function store_admin(Request $request)
    {      
        $message = [
            'required' => 'This field is required!'
        ];

        $request->validate([      
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'password' => 'required|confirmed',
        ], $message);

        // Create the user with hashed password
        $createdUser = User::create([
            'name' => $request->name, 
            'email' => $request->email,
            'role' => Str::upper($request->role),
            'password' => Hash::make($request->password),
        ]);

        // Create a related Student record
        Student::create([
            'user_id' => $createdUser->id,
            'name' => $createdUser->name,
        ]);

        return redirect()->route('user.index')->with('success', 'User Registered Successfully');    
    }

    /**
     * Store a newly created regular user in storage.
     */
    public function store_user(Request $request)
    {      
        $message = [
            'required' => 'This field is required!'
        ];

        $request->validate([      
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'password' => 'required|confirmed',
        ], $message);

        // Create the user with hashed password
        $createdUser = User::create([
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
        $data = User::find($id);
        return view('users.view', ['user' => $data]);   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = User::find($id);
        return view('users.edit', ['user' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $message = [
            'required' => 'This credential field is required!',
            'unique' => 'This email address is already registered!',
        ]; 

        $request->validate([
            'name' => 'nullable',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'role' => 'nullable',
            'password' => 'nullable',
        ], $message);

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = Str::upper($request->role);

        if ($request->password) {
            // Hash the password if it was updated
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request) 
    {
        $id = $request->id;
        User::destroy($id);
    }

        public function getUserInfo($id)
    {
        $user = User::find($id);

        if($user) {
            return response()->json([
                'name' => $user->name,
                'id_num' => $user->id_num ?? '',
                'course_id' => $user->student->course_id ?? ''
            ]);
        }

        return response()->json([
        'name' => $user->name ?? '',
        'id_num' => '',
        'course_id' => ''
    ]);
    }

    public function account()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // If admin, use admin account blade (users/account.blade.php)
        if ($user->isAdmin()) {
            return view('users.account', compact('user'));
        }

        // Regular user view
        return view('user.account_user', compact('user'));
    }


    // Show edit account page
public function editAccount()
{
    $user = auth()->user();

    // Only allow regular users
    if (!$user->isUser()) {
        abort(403, 'Unauthorized action.');
    }

    return view('user.edit_user', compact('user'));
}

// Update account
public function updateAccount(Request $request)
{
    $user = auth()->user();

    if (!$user->isUser()) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->password) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('user.account')->with('success', 'Account updated successfully.');
}

public function editAdminAccount()
{
    $user = auth()->user();

    // Only allow admin users
    if (!$user->isAdmin()) {
        abort(403, 'Unauthorized action.');
    }

    return view('users.edit', compact('user'));
}

public function updateAdminAccount(Request $request)
{   
    $user = auth()->user();

    if (!$user->isAdmin()) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->password) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('user.account')->with('success', 'Account updated successfully.');
}


}
