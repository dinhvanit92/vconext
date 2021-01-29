<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function getVoucher()
    {
        $voucher = Voucher::where('priority', '0')->get()->all();
        return response()->json([
            'code' => 201,
            'data' => $voucher
        ]);
    }
    public function getFeatureVoucher()
    {
        $voucher = Voucher::where('priority', '1')->get()->all();
        return response()->json([
            'code' => 201,
            'data' => $voucher
        ]);
    }
}
