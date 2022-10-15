<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MerchantController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function active_merchants()
    {
        if (request()->wantsJson()) {
            return response(
                User::where("role","=","merchant")->where("kyc_completed", "=", 1)->get()
            );
        }
        $merchants = User::where("role","=","merchant")->where("kyc_completed", "=", 1)->paginate(10);
        return view('merchants.index')->with('merchants', $merchants);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inactive_merchants()
    {
        if (request()->wantsJson()) {
            return response(
                User::where("role","=","merchant")->where("kyc_completed", "=", 0)->get()
            );
        }
        $merchants = User::where("role","=","merchant")->where("kyc_completed", "=", 0)->paginate(10);
        return view('merchants.index')->with('merchants', $merchants);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) {
            return response(
                User::where("role","=","merchant")->get()
            );
        }
        $merchants = User::where("role","=","merchant")->paginate(10);
        return view('merchants.index')->with('merchants', $merchants);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $merchant
     * @return \Illuminate\Http\Response
     */
    public function show(User $merchant)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $merchant)
    {
        return view('merchants.edit', compact('merchant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $merchant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $merchant)
    {
        $merchant->first_name = $request->first_name;
        $merchant->last_name = $request->last_name;
        $merchant->email = $request->email;
        $merchant->phone = $request->phone;
        $merchant->address = $request->address;
        $merchant->longitude = $request->longitude;
        $merchant->latitude = $request->latitude;
        $merchant->tagline = $request->tagline;
        $merchant->kyc_completed = $request->kyc_completed;

        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($merchant->avatar) {
                Storage::delete($merchant->avatar);
            }
            // Store avatar
            $avatar_path = $request->file('avatar')->store('merchants', 'public');
            // Save to Database
            $merchant->avatar = $avatar_path;
        }

        if ($request->hasFile('header_image')) {
            // Delete old header_image
            if ($merchant->header_image) {
                Storage::delete($merchant->header_image);
            }
            // Store header_image
            $header_image_path = $request->file('header_image')->store('merchants', 'public');
            // Save to Database
            $merchant->header_image = $header_image_path;
        }

        if ($request->hasFile('national_identification_front')) {
            // Delete old national_identification_front
            if ($merchant->national_identification_front) {
                Storage::delete($merchant->national_identification_front);
            }
            // Store national_identification_front
            $national_identification_front_path = $request->file('national_identification_front')->store('merchants', 'public');
            // Save to Database
            $merchant->national_identification_front = $national_identification_front_path;
        }

        if ($request->hasFile('national_identification_back')) {
            // Delete old national_identification_back
            if ($merchant->national_identification_back) {
                Storage::delete($merchant->national_identification_back);
            }
            // Store national_identification_back
            $national_identification_back_path = $request->file('national_identification_back')->store('merchants', 'public');
            // Save to Database
            $merchant->national_identification_back = $national_identification_back_path;
        }

        if ($request->hasFile('business_registration_cert')) {
            // Delete old business_registration_cert
            if ($merchant->business_registration_cert) {
                Storage::delete($merchant->business_registration_cert);
            }
            // Store business_registration_cert
            $business_registration_cert_path = $request->file('business_registration_cert')->store('merchants', 'public');
            // Save to Database
            $merchant->business_registration_cert = $business_registration_cert_path;
        }

        if ($request->hasFile('recent_bank_statement')) {
            // Delete old recent_bank_statement
            if ($merchant->recent_bank_statement) {
                Storage::delete($merchant->recent_bank_statement);
            }
            // Store recent_bank_statement
            $recent_bank_statement_path = $request->file('recent_bank_statement')->store('merchants', 'public');
            // Save to Database
            $merchant->recent_bank_statement = $recent_bank_statement_path;
        }

        if (!$merchant->save()) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem while updating merchant.');
        }
        return redirect()->route('merchants.index')->with('success', 'Success, your merchant details have been updated.');
    }

    public function destroy(User $merchant)
    {
        if ($merchant->avatar) {
            Storage::delete($merchant->avatar);
        }

        $merchant->deleted = 1;

        $merchant->save();

       return response()->json([
           'success' => true
       ]);
    }

}
