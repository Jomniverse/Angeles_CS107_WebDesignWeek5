<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Query using Eloquent ORM
        $customers = Customer::all(); //all records from customers table
        return view('customers.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');   //form to create a new customer
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|max:30|unique:customers,username',
            'email' => 'required|email|unique:customers,email',
            'password_hash' => 'required|min:8',
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable',
            'phone_number' => 'nullable|max:15',
        ]);

        Customer::create($validatedData);

        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);
        return view('customers.show', ['customer' => $customer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::find($id);
        return view('customers.edit', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'username' => [
                'required',
                'max:30',
                Rule::unique('customers', 'username')->ignore($id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('customers', 'email')->ignore($id),
            ],
            'password_hash' => 'required|min:8',
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable',
            'phone_number' => 'nullable|max:15',
        ]);

        $validatedData['password_hash'] = bcrypt($validatedData['password_hash']);

        $customer = Customer::findOrFail($id);
        $customer->update($validatedData);

        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->route('customers.index');
    }
}
