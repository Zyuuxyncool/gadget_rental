<?php

namespace App\Services;

use App\Models\Admin;

class AdminService extends Service
{
    public function search($params = [])
    {
        $admin = Admin::orderBy('id');

        $name = $params['name'] ?? '';
        if ($name !== '') $admin = $admin->where('name', 'like', "%$name%");

        $admin = $this->searchFilter($params, $admin, ['phone', 'user_id']);
        return $this->searchResponse($params, $admin);
    }

    public function find($value, $column = 'id')
    {
        return Admin::where($column, $value)->first();
    }

    public function store($params)
    {
        return Admin::create($params);
    }

    public function update($params, $id)
    {
        $admin = Admin::find($id);
        if (!empty($admin)) $admin->update($params);
        return $admin;
    }

    public function delete($id)
    {
        $admin = Admin::find($id);
        if (!empty($admin)) {
            try { $admin->delete(); } catch (\Exception $e) { return ['error' => 'Delete failed! This data currently being used']; }
        }
        return $admin;
    }

    public function restore($id)
    {
        $admin = Admin::withTrashed()->where('id', $id)->first();
        if (!empty($admin)) $admin->restore();
        return $admin;
    }
}
