<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Services\ItemService;
use Illuminate\Http\Request;
use App\Services\ImageService;

class ItemController extends Controller
{
    protected $itemService;
    public function __construct()
    {
        $this->itemService = new ItemService();
    }

    public function index(request $request)
    {
        $items = $this->itemService->search($request);
        return view('item.index', compact('items'));
    }

    public function search(Request $request)
    {
        $items = $this->itemService->search($request->all());
        return view('item._table', compact('items'));
    }

    public function create()
    {
        return view('item._form');
    }

    public function store(Request $request)
    {
        $filename = ImageService::save_file($request, 'file_image', 'public/images/item_image');
        if ($filename !== '') $request->merge(['image' => $filename]);
        $this->itemService->store($request->all());
        return redirect()->route('item.index');
    }

    public function edit($id)
    {
        $items = $this->itemService->find($id);
        return view('item._form', compact('items'));
    }

    public function update(Request $request, $id)
    {
        $filename = ImageService::save_file($request, 'file_image', 'public/images');
        if ($filename !== '') $request->merge(['image' => $filename]);
        $this->itemService->update($request->all(), $id);
        return redirect()->route('item.index');
    }

    public function destroy($id)
    {
        $items = $this->itemService->find($id);
        ImageService::delete_file($items->image);
        $this->itemService->delete($id);
        return redirect()->route('item.index');
    }
}
