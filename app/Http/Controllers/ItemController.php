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


    public function index()
    {
        $items = $this->itemService->search();
        return view('item.index', compact('items'));
    }

    public function create()
    {
        $items = $this->itemService->search();
        return view('item.create', compact('items'));
    }

    public function store(Request $request)
    {

        $filename = ImageService::save_file($request, 'file_image', 'public/images');
        if ($filename !== '') $request->merge(['image' => $filename]);
        $this->itemService->store($request->all());
        return redirect()->route('item.index');
    }

    public function edit($id)
    {
        $item = $this->itemService->find($id);
        $items = $this->itemService->search();
        return view('item.edit', compact('item', 'items'));
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
