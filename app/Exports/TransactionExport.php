<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionExport implements FromQuery, WithHeadings, WithMapping
{
    protected $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function query()
    {
        $query = Transaction::with(['customer', 'item']);

        $statuses = [
            'belum-kembali' => 0,
            'terlambat' => 1,
            'dibatalkan' => 2,
            'history' => 3,
        ];

        if (!empty($this->params['statuses']) && isset($statuses[$this->params['statuses']])) {
            $query->where('status', $statuses[$this->params['statuses']]);
        }
        if (!empty($this->params['date'])) {
            $query->where('date', $this->params['date']);
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Customer Name',
            'Item Name',
            'Price',
            'Date',
            'Time',
            'Return Date',
            'Status',
        ];
    }

    public function map($transaction): array
    {
        return [
            $transaction->id,
            optional($transaction->customer)->name,
            optional($transaction->item)->name,
            $transaction->price ?? 0,
            $transaction->date ?? '',
            $transaction->time ?? '',
            $transaction->return_date ?? '',
            $transaction->status ?? '',
        ];
    }
}
