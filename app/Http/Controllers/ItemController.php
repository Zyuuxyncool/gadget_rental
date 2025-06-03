<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return view('item.index');
    }

    public function create()
    {
        return view('item.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('item.index');
    }

    public function edit($id)
    {
        return view('item.edit');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('item.index');
    }

    public function destroy($id)
    {
        return redirect()->route('item.index');
    }
}
