<?php

namespace App\Services;

use App\Models\Transaction;

class TransactionService extends Service
{

    public function search($params = [])
    {
        $transactionService = Transaction::orderBy('id');

        $customer_name = $params['customer_name'] ?? '';
        if ($customer_name !== '') {
            $transactionService = $transactionService->whereHas('customer', fn($customer) => $customer->where('name', 'like', "%$customer_name%"));
        }

        $item_name = $params['item_name'] ?? '';
        if ($item_name !== '') {
            $transactionService = $transactionService->whereHas('item', fn($item) => $item->where('name', 'like', "%$item_name%"));
        }

        $transactionService = $this->searchFilter($params, $transactionService, ['price', 'date', 'time', 'return_date', 'status']);
        return $this->searchResponse($params, $transactionService);
    }

    public function find($value, $column = 'id')
    {
        return Transaction::where($column, $value)->first();
    }

    public function store($params)
    {
        return Transaction::create($params);
    }

    public function update($params, $id)
    {
        $transactionService = Transaction::find($id);
        $transactionService->update();
        return $transactionService;
    }

    public function delete($params, $id)
    {
        $transactionService = Transaction::find($id);
        $transactionService->delete();
        return $transactionService;
    }
}
