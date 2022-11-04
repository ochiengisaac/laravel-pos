<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\UserWelcome;

use DB;




class UserController extends Controller

{

    public function addTestUser(Request $request){
        DB::table('users')->insert([  'name' => 'test',  'email' => 'test@test.com',  'role'=>'admin', 'password' => Hash::make('123abc???')]);
    }

    public function updateContact(Request $request){
        $user = User::where("email", "=", "fkyalo@poneahealth.com")->first();
        if($user){
            $user->password = Hash::make('Pick12AndPack');
            $user->save();
             
        }
    }

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    { 

        $users = auth()->user()->role == "admin" ? User::where("deleted", "=", 0)->where("role", "<>", "contact")->latest()->paginate(50) : User::latest()->where("deleted", "=", 0)->where('id', '=', auth()->user()->id)->paginate(50);


        return view('user.index', compact('users'))

            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function admin_user()

    {

        $users = auth()->user()->role == "admin" ? User::where("deleted", "=", 0)->where("role", "=", "admin")->latest()->paginate(50) : User::latest()->where("deleted", "=", 0)->where("role", "=", "admin")->where('id', '=', auth()->user()->id)->paginate(50);


        return view('user.index', compact('users'))

            ->with('i', (request()->input('page', 1) - 1) * 50);
    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('user.create');
    }





    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $request->validate([

            'name' => 'required',

            'email' => 'required|unique:users',

            'phone' => 'required|unique:users',

            'password' => 'required',

            //'logo' => 'required',

        ]);



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);



        return redirect()->route('user.index')

            ->with('success', 'User created successfully.');
    }



    /**

     * Display the specified resource.

     *

     * @param  \App\User  $user

     * @return \Illuminate\Http\Response

     */

    public function show(User $user)

    {

        return view('user.show', compact('user'));
    }

    /**

     * Show the form for editing the user profile.

     *

     * @return \Illuminate\Http\Response

     */

    public function profile()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\User  $user

     * @return \Illuminate\Http\Response

     */

    public function edit(User $user)

    {

        return view('user.edit', compact('user'));
    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\User  $user

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, User $user)

    {

        $request->validate([

            'name' => 'required',

            'email' => 'required',

            'phone' => 'required',

            //'logo' => 'required',

        ]);


        $userData = $request->all();
        if ($userData['password'] == "") {
            unset($userData['password']);
        }
        $user->update($userData);
        $user = User::where('id', $user->id)->first();
        if ($request->password != "") {
            $user->password = Hash::make($request->password);
            $user->save();
        }



        return redirect()->route('user.profile')

            ->with('success', 'User updated successfully');
    }


    public function updateProfile(Request $request)

    {
        $user = auth()->user();

        $request->validate([

            'first_name' => 'required',
            'last_name' => 'required',

            'email' => 'required',

            'phone' => 'required',

            //'logo' => 'required',

        ]);


        $userData = $request->all();

        if ($userData['password'] == "") {
            unset($userData['password']);
        }
        $user->update($userData);
        $user = User::where('id', $user->id)->first();
        if ($request->password != "") {
            $user->password = Hash::make($request->password);
            $user->save();
        }
        return redirect()->route('profile')

            ->with('success', 'Profile updated successfully');
    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\User  $user

     * @return \Illuminate\Http\Response

     */

    public function destroy(User $user)

    {

        $user->delete();



        return redirect()->route('user.index')

            ->with('success', 'User deleted successfully');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}