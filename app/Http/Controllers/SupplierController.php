<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function active_suppliers()
    {
        if (request()->wantsJson()) {
            return response(
                User::where("role","=","supplier")->where("kyc_completed", "=", 1)->get()
            );
        }
        $suppliers = User::where("role","=","supplier")->where("kyc_completed", "=", 1)->paginate(10);
        return view('suppliers.index')->with('suppliers', $suppliers);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inactive_suppliers()
    {
        if (request()->wantsJson()) {
            return response(
                User::where("role","=","supplier")->where("kyc_completed", "=", 0)->get()
            );
        }
        $suppliers = User::where("role","=","supplier")->where("kyc_completed", "=", 0)->paginate(10);
        return view('suppliers.index')->with('suppliers', $suppliers);
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
                User::where("role","=","supplier")->get()
            );
        }
        $suppliers = User::where("role","=","supplier")->paginate(10);
        return view('suppliers.index')->with('suppliers', $suppliers);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(User $supplier)
    {
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $supplier)
    {
        $supplier->business_name = $request->business_name;
        $supplier->first_name = $request->first_name;
        $supplier->last_name = $request->last_name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->longitude = $request->longitude;
        $supplier->latitude = $request->latitude;
        $supplier->tagline = $request->tagline;
        $supplier->kyc_completed = $request->kyc_completed;

        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($supplier->avatar) {
                Storage::delete($supplier->avatar);
            }
            // Store avatar
            $avatar_path = $request->file('avatar')->store('suppliers', 'public');
            // Save to Database
            $supplier->avatar = $avatar_path;
        }

        if ($request->hasFile('header_image')) {
            // Delete old header_image
            if ($supplier->header_image) {
                Storage::delete($supplier->header_image);
            }
            // Store header_image
            $header_image_path = $request->file('header_image')->store('suppliers', 'public');
            // Save to Database
            $supplier->header_image = $header_image_path;
        }

        if ($request->hasFile('national_identification_front')) {
            // Delete old national_identification_front
            if ($supplier->national_identification_front) {
                Storage::delete($supplier->national_identification_front);
            }
            // Store national_identification_front
            $national_identification_front_path = $request->file('national_identification_front')->store('suppliers', 'public');
            // Save to Database
            $supplier->national_identification_front = $national_identification_front_path;
        }

        if ($request->hasFile('national_identification_back')) {
            // Delete old national_identification_back
            if ($supplier->national_identification_back) {
                Storage::delete($supplier->national_identification_back);
            }
            // Store national_identification_back
            $national_identification_back_path = $request->file('national_identification_back')->store('suppliers', 'public');
            // Save to Database
            $supplier->national_identification_back = $national_identification_back_path;
        }

        if ($request->hasFile('business_registration_cert')) {
            // Delete old business_registration_cert
            if ($supplier->business_registration_cert) {
                Storage::delete($supplier->business_registration_cert);
            }
            // Store business_registration_cert
            $business_registration_cert_path = $request->file('business_registration_cert')->store('suppliers', 'public');
            // Save to Database
            $supplier->business_registration_cert = $business_registration_cert_path;
        }

        if ($request->hasFile('recent_bank_statement')) {
            // Delete old recent_bank_statement
            if ($supplier->recent_bank_statement) {
                Storage::delete($supplier->recent_bank_statement);
            }
            // Store recent_bank_statement
            $recent_bank_statement_path = $request->file('recent_bank_statement')->store('suppliers', 'public');
            // Save to Database
            $supplier->recent_bank_statement = $recent_bank_statement_path;
        }

        if (!$supplier->save()) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem while updating supplier.');
        }
        return redirect()->route('suppliers.index')->with('success', 'Success, your supplier details have been updated.');
    }

    public function destroy(User $supplier)
    {
        if ($supplier->avatar) {
            Storage::delete($supplier->avatar);
        }

        $supplier->deleted = 1;

        $supplier->save();

       return response()->json([
           'success' => true
       ]);
    }

}
