<?php
namespace App\Services;
use App\Models\Item;

    class ServiceItem
    {
        public function getAllItems()
        {
            return Item::all();
        }
    
        public function getItemById($id)
        {
            return Item::find($id);
        }
    
        public function createItem($data)
        {
            return Item::create($data);
        }
    
        public function updateItem($id, $data)
        {
            $item = Item::find($id);
            if ($item) {
                $item->update($data);
                return $item;
            }
            return null;
        }
    
        public function deleteItem($id)
        {
            $item = Item::find($id);
            if ($item) {
                $item->delete();
                return true;
            }
            return false;
        }
    }