<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Services\CustomerService;
use App\Models\Lokasi;
use App\Services\ImageService;
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
        $filename = ImageService::save_file($request, 'file_image', 'public/images/customer_image');
        if ($filename !== '') $request->merge(['image' => $filename]);
        $this->customerService->store($request->all());
        return redirect()->route('customer.index');
    }

    public function edit($id)
    {
        $customer = $this->customerService->find($id);
        $customers = $this->customerService->search();
        $provinsi = $this->customerService->getProvinsi();
        return view('customer.edit', compact('customer', 'customers', 'provinsi'));
    }

    public function update(Request $request, $id)
    {
        $filename = ImageService::save_file($request, 'file_image', 'public/images/customer_image');
        if ($filename !== '') $request->merge(['image' => $filename]);
        // dd($request->all());
        $this->customerService->update($request->all(), $id);
        return redirect()->route('customer.index');
    }

    public function destroy($id)
    {
        $customers = $this->customerService->find($id);
        ImageService::delete_file($customers->image);
        $this->customerService->delete($id);
        return redirect()->route('customer.index');
    }
    public function show($id)
    {
        $customers = $this->customerService->find($id);
        $provinsi = Lokasi::whereNull('parent_id')->get();
        return view('customer.show', compact('customers', 'provinsi'));
    }
}
