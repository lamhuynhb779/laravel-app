<?php

namespace App\Http\Controllers;

use App\Models\MongodbNotification;
use App\Models\MongodbProduct;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function createProduct(Request $request): \Illuminate\Http\JsonResponse
    {
        $product = new MongodbProduct();
        $product->product_name = $request->input('product_name');
        $product->shop_name = $request->input('shop_name');
        $product->price = (float) $request->input('price');
        $product->save();


        $service = new NotificationService();

        $data = [
            'type' => 'SHOP-001',
            'senderId' => 1,
            'receiverId' => 1,
            'options' => [
                'product_name' => $request->input('product_name'),
                'shop_name' => $request->input('shop_name'),
            ],
        ];

        try {
            $service->pushNoti($data);
            return response()->json(['status' => true], 201);
        } catch (\Exception $exception) {
            return response()->json(['status' => false], 500);
        }
    }

    public function listNotiByUser($userId)
    {
        $result = MongodbNotification::where('receiverId', (int) $userId)->get();
        if (empty($result)) {
            return response()->json(['status' => true, 'data' => []]);
        }

        return response()->json([
            'status' => true,
            'data' => $result,
        ]);
    }

}
