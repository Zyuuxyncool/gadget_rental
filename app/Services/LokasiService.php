<?php

namespace App\Services;

use App\Models\Lokasi;

class LokasiService extends Service
{
    public function getByParentAndTingkat($parent_id = '0', $tingkat = null)
    {
        $lokasi_service = Lokasi::query();

        if (!is_null($tingkat)) {
            $lokasi_service->where('tingkat', $tingkat);
        }

        if ($parent_id !== '0') {
            $lokasi_service->whereIn('parent_id', explode(',', $parent_id));
        }

        return $lokasi_service->get();
    }

    public function getLokasi($tingkat, $parent_id)
    {
        if ($tingkat == 1) {
            return Lokasi::whereNull('parent_id')->get();
        } else {
            return Lokasi::where('parent_id', $parent_id)->get(); 
        }
    }
}
