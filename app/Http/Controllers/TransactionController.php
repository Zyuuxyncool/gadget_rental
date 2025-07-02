<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;
use App\Services\ItemService;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use App\Exports\TransactionExport;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    protected $transactionService;
    protected $itemService;
    protected $customerService;
    public function __construct()
    {
        $this->transactionService = new TransactionService();
        $this->itemService = new ItemService();
        $this->customerService = new CustomerService();
    }

    public function index(Request $request)
    {
        $transactions = $this->transactionService->search($request);
        return view('transaction.index', compact('transactions'));
    }

    public function search(Request $request)
    {
        $transactions = $this->transactionService->search($request->all());
        $statuses = $this->transactionService->getStatuses();
        $tab = $request->get('belum_kembali');
        return view('transaction._table', compact('transactions', 'statuses', 'tab'));
    }

    public function updateStatus(Request $request, $id)
    {
        $params = $request->all();
        $params['id'] = $id;
        $this->transactionService->updateStatus($params);
        return response()->json(['success' => true]);
    }

    public function create()
    {
        $customers = $this->customerService->search();
        $items = $this->itemService->search();
        return view('transaction._form', compact('customers', 'items'));
    }

    public function store(Request $request)
    {
        $this->transactionService->store($request->all());
        return redirect()->route('transaction.index');
    }

    public function edit($id)
    {
        $transactions = $this->transactionService->find($id);
        return view('transaction._form', compact('transactions'));
    }

    public function update(Request $request, $id)
    {
        $this->transactionService->update($request->all(), $id);
        return redirect()->route('transaction.index');
    }

    public function destroy($id)
    {
        $this->transactionService->delete($id);
        return redirect()->route('transaction.index');
    }

    public function export(Request $request)
    {
        $params = $request->all();
        return Excel::download(new TransactionExport($params), 'transactions.xlsx');
    }
}
