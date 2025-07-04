<?php

namespace App\Services;


use App\Models\Transaction;

class TransactionService extends Service
{

    public function search($params = [])
    {
        $transaction_service = Transaction::with(['customer', 'item'])->orderBy('id');

        $customer_name = $params['customer'] ?? '';
        if ($customer_name !== '') {
            $transaction_service = $transaction_service->whereHas('customer', fn($customer) => $customer->where('name', 'like', "%$customer_name%"));
        }

        $item_name = $params['item'] ?? '';
        if ($item_name !== '') {
            $transaction_service = $transaction_service->whereHas('item', fn($item) => $item->where('name', 'like', "%$item_name%"));
        }

        $date = $params['date'] ?? '';
        if ($date !== '') {
            $transaction_service = $transaction_service->where('date', 'like', "%$date%");
        }

        $statuses = [
            'belum-kembali' => 0,
            'terlambat' => 1,
            'dibatalkan' => 2,
            'history' => 3,
        ];

        if (!empty($params['statuses']) && isset($statuses[$params['statuses']])) {
            $transaction_service->where('status', $statuses[$params['statuses']]);
        }

        $transaction_service = $this->searchFilter($params, $transaction_service, ['status', 'customer_id', 'item_id']);
        return $this->searchResponse($params, $transaction_service);
    }

    public function find($value, $column = 'id')
    {
        return Transaction::where($column, $value)->first();
    }

    public function store($params)
    {
        if (isset($params['price'])) {
            $params['price'] = str_replace('.', '', $params['price']);
        }
        if (!isset($params['status'])) {
            $params['status'] = 0;
        }
        return Transaction::create($params);
    }

    public function update($params, $id)
    {
        if (isset($params['price'])) {
            $params['price'] = str_replace('.', '', $params['price']);
        }
        $transaction_service = Transaction::find($id);
        if (!empty($transaction_service)) {
            $transaction_service->update($params);
        }
        return $transaction_service;
    }

    public function delete($id)
    {
        $transaction_service = Transaction::find($id);
        $transaction_service->delete();
        return $transaction_service;
    }

    public function getStatuses()
    {
        return Transaction::STATUSES;
    }
    public function updateStatus($params)
    {
        $statuses = [
            'belum_kembali' => 0,
            'terlambat' => 1,
            'dibatalkan' => 2,
            'selesai' => 3,
        ];
        $transaction = Transaction::find($params['id']);
        if ($transaction) {
            $transaction->status = is_numeric($params['status']) ? $params['status'] : ($statuses[$params['status']] ?? 0);
            $transaction->save();
        }
        return $transaction;
    }

    public function getTTransactionCustomerId($params = [])
    {
        $transaction_service = Transaction::with(['customer', 'item'])->orderBy('id');

        $customer_id = $params['customer_id'] ?? '';
        if ($customer_id !== '') {
            $transaction_service = $transaction_service->where('customer_id', $customer_id);
        }

        $date = $params['date'] ?? '';
        if ($date !== '') {
            $transaction_service = $transaction_service->whereDate('return_date', $date);
        }

        return $this->searchResponse($params, $transaction_service);
    }
}
