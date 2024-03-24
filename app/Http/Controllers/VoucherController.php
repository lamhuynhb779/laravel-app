<?php

namespace App\Http\Controllers;

use App\Models\Vouchers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class VoucherController extends Controller
{
    protected string $uuid;

    //
    public function __construct()
    {
        $this->uuid = uniqid();
    }

    public function getVoucher(Request $request): \Illuminate\Http\JsonResponse
    {
//        $lock = Cache::lock('voucher:1', 3600);
//        if ($lock->get()) {
//            // edit the article
//
//            $lock->release();
//        } else {
//            // can't edit the article because it's already locked by another user
//        }
        $time = microtime(true);
        $voucher = Vouchers::query()->where('state', 1)->whereNull('user_uuid')->first();
        if ($voucher instanceof Vouchers) {
            Vouchers::query()
                ->where('voucher_id', $voucher->voucher_id)
                ->update(['user_uuid' => $this->uuid]);
        } else {
            Log::info('Get voucher failed', [
                'uuid' => $this->uuid,
                'time' => $time,
            ]);

            return response()->json([
                'status' => false,
                'user_uuid' => $this->uuid,
                'message' => 'Voucher is not existing!'
            ]);
        }

        Log::info('Get voucher success', [
            'voucher_id' => $voucher->voucher_id,
            'uuid' => $this->uuid,
            'time' => $time,
        ]);

        return response()->json([
            'status' => true,
            'user_uuid' => $this->uuid,
            'message' => 'Get voucher success!'
        ]);
    }

    public function reset(Request $request): \Illuminate\Http\JsonResponse
    {
        Vouchers::query()->where('state', 1)->update(['user_uuid' => null]);

        return response()->json([
            'status' => true,
            'user_uuid' => $this->uuid,
            'message' => 'Reset voucher success!'
        ]);
    }
}
