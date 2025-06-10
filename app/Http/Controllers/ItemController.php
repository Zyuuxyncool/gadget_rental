<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Services\ItemService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected $ItemService;
    public function __construct()
    {
        $this->ItemService = new ItemService();
    }


    public function index()
    {
        $items = $this->ItemService->search();
        return view('item.index', compact('items'));
    }

    public function create()
    {
        $items = $this->ItemService->search();
        return view('item.create', compact('items'));
    }

    public function store(Request $request)
    {
        $this->ItemService->store($request->all());
        return redirect()->route('item.index');
    }

    public function edit($id)
    {
        $item = $this->ItemService->find($id); 
        $items = $this->ItemService->search(); 
        return view('item.edit', compact('item', 'items'));
    }

    public function update(Request $request, $id)
    {
        $this->ItemService->update($request->all(), $id);
        return redirect()->route('item.index');
    }

    public function destroy($id)
    {
        $this->ItemService->delete($id);
        return redirect()->route('item.index');
    }
}
