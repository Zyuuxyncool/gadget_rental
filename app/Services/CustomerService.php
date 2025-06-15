<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerService extends Service
{
    public function search($params = [])
    {
        $customer_service = Customer::with(['provinsi', 'kabupaten', 'kecamatan', 'kelurahan'])->orderBy('id');

        $name = $params['name'] ?? '';
        $no_id = $params['no_id'] ?? '';

        if ($name !== '' || $no_id !== '') {
            $customer_service = $customer_service->where(function ($query) use ($name, $no_id) {
                if ($name !== '') {
                    $query->where('name', 'like', "%$name%");
                }
                if ($no_id !== '') {
                    $query->where('no_id', 'like', "$no_id");
                }
            });
        }
        $customer_service = $this->searchFilter($params, $customer_service, ['name', 'no_id']);
        return $this->searchResponse($params, $customer_service);
    }

    public function find($value, $column = 'id')
    {

        return Customer::with(['provinsi', 'kabupaten', 'kecamatan', 'kelurahan'])->where($column, $value)->first();
    }

    public function store($params)
    {
        $params['no_id'] = mt_rand(100000000, 999999999);

        if (isset($params['provinsi'])) {
            $params['provinsi_id'] = $params['provinsi'];
            unset($params['provinsi']);
        }
        if (isset($params['kabupaten'])) {
            $params['kabupaten_id'] = $params['kabupaten'];
            unset($params['kabupaten']);
        }
        if (isset($params['kecamatan'])) {
            $params['kecamatan_id'] = $params['kecamatan'];
            unset($params['kecamatan']);
        }
        if (isset($params['kelurahan'])) {
            $params['kelurahan_id'] = $params['kelurahan'];
            unset($params['kelurahan']);
        }
        return Customer::create($params);
    }

    public function update($params, $id)
    {
        if (isset($params['provinsi'])) {
            $params['provinsi_id'] = $params['provinsi'];
            unset($params['provinsi']);
        }
        if (isset($params['kabupaten'])) {
            $params['kabupaten_id'] = $params['kabupaten'];
            unset($params['kabupaten']);
        }
        if (isset($params['kecamatan'])) {
            $params['kecamatan_id'] = $params['kecamatan'];
            unset($params['kecamatan']);
        }
        if (isset($params['kelurahan'])) {
            $params['kelurahan_id'] = $params['kelurahan'];
            unset($params['kelurahan']);
        }
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

    public function getProvinsi()
    {
        $provinsi = \App\Models\Lokasi::whereNull('parent_id')->get();
        if ($provinsi->isEmpty()) {
            $provinsi = \App\Models\Lokasi::where('tingkat', 1)->get();
        }
        return $provinsi;
    }
}
