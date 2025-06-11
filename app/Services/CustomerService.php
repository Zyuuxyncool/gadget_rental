<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerService extends Service
{
    public function search($params = [])
    {
        $customer_service = Customer::orderBy('id');

        $name_customer = $params['name'] ?? '';
        if ($name_customer !== '') $customer_service = $customer_service->where('name', 'like', "%name_customer%");

        $customer_service = $this->searchFilter($params, $customer_service, []);
        return $this->searchResponse($params, $customer_service);
    }

    public function find($value, $column = 'id')
    {
        return Customer::where($column, $value)->first();
    }

    public function store($params)
    {
        return Customer::create($params);
    }

    public function update($params, $id)
    {
        $customer_service = Customer::find($id);
        if (!empty($customer_service)) $customer_service->update($params);
        return $customer_service;
    }

    public function delete($id)
    {
        $customer_service = Customer::find($id);
        $customer_service->delete();
        return $customer_service;
    }
}
