<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemService extends Service
{

    public function search($params = [])
    {
        $item_service = Item::orderBy('id');

        $name_item = $params['name'] ?? '';
        if ($name_item !== '') $item_service = $item_service->where('name', 'like', "%$name_item%");

        $item_service = $this->searchFilter($params, $item_service, []);
        return $this->searchResponse($params, $item_service);
    }

    public function find($value, $column = 'id')
    {
        return Item::where($column, $value)->first();
    }

    public function store($params)
    {
        return Item::create($params);
    }

    public function update($params, $id)
    {
        $item_service = Item::find($id);
        if (!empty($item_service)) $item_service->update($params);  
        return $item_service;
    }

    public function delete($id)
    {
        $item_service = Item::find($id);
        $item_service->delete();
        return $item_service;
    }
}
