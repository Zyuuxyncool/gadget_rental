<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transaction.index');
    }

    public function create()
    {
        return view('transaction.create');
    }

    public function store(Request $request)
    {
        redirect()->route('transaction.index');
    }   

    public function edit($id)
    {
        return view('transaction.edit');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('transaction.index');
    }

    public function destroy($id)
    {
        return redirect()->route('transaction.index');
    }
}

