<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    protected $customerService;
    public function __construct()
    {
        $this->customerService = new CustomerService();
    }

    public function index(request $request)
    {
        $customers = $this->customerService->search($request);
        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        $customers = $this->customerService->search();
        return view('customer.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $this->customerService->store($request->all());
        return redirect()->route('customer.index');
    }

    public function edit($id)
    {
        $customers = $this->customerService->find($id);
        return view('customer.edit', compact('customers'));
    }

    public function update(Request $request, $id)
    {
        $this->customerService->update($request->all(), $id);
        return redirect()->route('customer.index');
    }

    public function destroy($id)
    {
        $this->customerService->delete($id);
        return redirect()->route('customer.index');
    }
}
