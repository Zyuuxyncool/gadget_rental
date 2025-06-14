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
        $customers = $this->customerService->search(['count' => 1]);
        $transactions = $this->transactionService->search(['count' => 1]);
        return view('dashboard', compact('items', 'customers', 'transactions'));
    }
}
