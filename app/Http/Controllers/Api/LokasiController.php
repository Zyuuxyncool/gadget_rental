<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LokasiService;

class LokasiController extends Controller
{
    protected $lokasiService;

    public function __construct(LokasiService $lokasiService)
    {
        $this->lokasiService = $lokasiService;
    }

    public function index($parent_id = '0')
    {
        return response()->json(
            $this->lokasiService->getByParentAndTingkat($parent_id, request()->query('tingkat'))
        );
    }

    public function getLokasi(Request $request)
    {
        return response()->json(
            $this->lokasiService->getLokasi($request->tingkat, $request->parent_id)
        );
    }
}
