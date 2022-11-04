<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactStoreRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_id = auth()->user()->id;

        if(auth()->user()->role === "assistant"){
            $account_id = auth()->user()->account_id;
        }
        if (request()->wantsJson()) {
            return response(
                Contact::where("account_id", "=", $account_id)->get()
            );
        }
        $contacts = Contact::where("account_id", "=", $account_id)->latest()->paginate(10);
        return view('contacts.index')->with('contacts', $contacts);
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customers()
    {
        $account_id = auth()->user()->id;

        if(auth()->user()->role === "assistant"){
            $account_id = auth()->user()->account_id;
        }
        if (request()->wantsJson()) {
            return response(
                Contact::where("contact_type", "=", "customer")->where("account_id", "=", $account_id)->get()
            );
        }
        $contacts = Contact::where("contact_type", "=", "customer")->where("account_id", "=", $account_id)->latest()->paginate(10);
        return view('contacts.customers')->with('customers', $contacts);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function suppliers()
    {
        $account_id = auth()->user()->id;

        if(auth()->user()->role === "assistant"){
            $account_id = auth()->user()->account_id;
        }
        if (request()->wantsJson()) {
            return response(
                Contact::where("contact_type", "=", "supplier")->where("account_id", "=", $account_id)->get()
            );
        }
        $contacts = Contact::where("contact_type", "=", "supplier")->where("account_id", "=", $account_id)->latest()->paginate(10);
        return view('contacts.suppliers')->with('suppliers', $contacts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactStoreRequest $request)
    {

        $account_id = auth()->user()->id;

        if(auth()->user()->role === "assistant"){
            $account_id = auth()->user()->account_id;
        }

        $avatar_path = '';

        if ($request->hasFile('avatar')) {
            $avatar_path = $request->file('avatar')->store('contacts', 'public');
        }

        //dd($request);

        $contact = Contact::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'avatar' => $avatar_path,
            'account_id' => $account_id,
            //'favorite' => $request->favorite,
            'contact_type' => $request->contact_type,
        ]);

        if (!$contact) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem while creating contact.');
        }
        return redirect()->route('contacts.index')->with('success', 'Success, your contact has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $contact->first_name = $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->address = $request->address;
        $contact->favorite = $request->favorite;
        $contact->contact_type = $request->contact_type;

        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($contact->avatar) {
                Storage::delete($contact->avatar);
            }
            // Store avatar
            $avatar_path = $request->file('avatar')->store('contacts', 'public');
            // Save to Database
            $contact->avatar = $avatar_path;
        }

        if (!$contact->save()) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem while updating contact.');
        }
        return redirect()->route('contacts.index')->with('success', 'Success, your contact has been updated.');
    }

    public function destroy(Contact $contact)
    {
        if ($contact->avatar) {
            Storage::delete($contact->avatar);
        }

        $contact->deleted = 1;
        $contact->save();

       return response()->json([
           'success' => true
       ]);
    }
}
