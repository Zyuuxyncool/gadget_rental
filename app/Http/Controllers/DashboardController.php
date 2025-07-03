<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerService;
use App\Services\TransactionService;
use App\Services\ItemService;

class DashboardController extends Controller
{
    protected $itemService;
    protected $customerService;
    protected $transactionService;

    public function __construct()
    {
        $this->itemService = new ItemService();
        $this->customerService = new CustomerService();
        $this->transactionService = new TransactionService();
    }


    public function index(Request $request)
    {
        $items = $this->itemService->search(['count' => 1]);
        $customer_limits = $this->customerService->search(['limit' => 10]);
        $customers_count = $this->customerService->search(['count' => 1]);
        $transactions = $this->transactionService->search(['count' => 1]);
        $statuses = $this->transactionService->getStatuses();
        $transactions_customer_id = $this->transactionService->search(['customer_id' => $request->input('customer')]);
        $customer = $request->input('customer', '');
        $transactions_customer_id = this
        $customers = $this->customerService->search();

        return view('dashboard', compact(
            'items',
            'customers',
            'transactions',
            'customer_limits',
            'customers_count',
            'transactions_customer_id'
        ));
    }
}
