<?php

namespace App\Http\Controllers\Back\Customers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderBy('order')->paginate(10);
        return view('back.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.customers.create');
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
            "name" => "required|string",
            "order" => "required|numeric",
            "images.*" => "required|max:2024|mimes:jpg,png,jpeg",
            "web" => "required|string",
            "status" => "required|numeric",
        ]);

        if ($request->hasFile('images')) {
            $path = Storage::putFile('clientes', $request->images[0]);
        }

        Customer::create([
            'name' => $request->name,
            'logotype' => $path,
            'web' => $request->web,
            'order' => $request->order,
            'status' => $request->status
        ]);

        return redirect()->route('customers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);

        return view('back.customers.update', compact('customer'));
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
        // dd($request->all());
        $request->validate([
            "name" => "required|string",
            "order" => "required|numeric",
            "images.*" => "required|max:2024|mimes:jpg,png,jpeg",
            "web" => "required|string",
            "status" => "required|numeric",
        ]);

        $customer = Customer::findOrFail($id);

        if ($request->hasFile('images')) {

            $path = Storage::putFile('clientes', $request->images[0]);

            if (Storage::exists($customer->logotype)) {
                Storage::delete($customer->logotype);
            }
        } else {
            $path = $customer->logotype;
        }

        $customer->update([
            'name' => $request->name,
            'logotype' => $path,
            'web' => $request->web,
            'order' => $request->order,
            'status' => $request->status
        ]);

        return redirect()->route('customers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        if (Storage::exists($customer->logotype)) {
            Storage::delete($customer->logotype);
        }

        $customer->delete();

        return response()->json("ok");
    }
}