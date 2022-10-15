<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountStoreRequest;
use App\Models\Account;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) {
            return response(
                Account::all()
            );
        }
        $accounts = Account::latest()->paginate(10);
        return view('accounts.index')->with('accounts', $accounts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounts.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountStoreRequest $request)
    {

        $account = Account::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'user_id' => $request->user()->id,
        ]);

        if (!$account) {
            return redirect()->back()->with('error', 'Sorry, there a problem while creating account.');
        }
        return redirect()->route('accounts.index')->with('success', 'Success, account have been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        return view('accounts.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $account->first_name = $request->first_name;
        $account->last_name = $request->last_name;
        $account->email = $request->email;
        $account->phone = $request->phone;
        $account->address = $request->address;

        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($account->avatar) {
                Storage::delete($account->avatar);
            }
            // Store avatar
            $avatar_path = $request->file('avatar')->store('accounts', 'public');
            // Save to Database
            $account->avatar = $avatar_path;
        }

        if (!$account->save()) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem while updating account.');
        }
        return redirect()->route('accounts.index')->with('success', 'Success, your account have been updated.');
    }

    public function destroy(Account $account)
    {
        if ($account->avatar) {
            Storage::delete($account->avatar);
        }

        $account->delete();

       return response()->json([
           'success' => true
       ]);
    }
}
