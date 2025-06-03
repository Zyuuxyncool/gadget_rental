<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {

        return view('customer.index');
    }

    public function create()
    {

        return view('customer.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('customer.index');
    }

    public function edit($id)
    {
        return view('customer.edit');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('customer.index');
    }

    public function destroy($id)
    {
        return redirect()->route('customer.index');
    }
}
