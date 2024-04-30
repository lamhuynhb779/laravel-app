<?php

namespace App\Services;

use App\Models\MongodbNotification;

class NotificationService implements \App\Services\Interfaces\NotificationService
{

    public function pushNoti(array $data = []): bool
    {
        $mongoNotification = new MongodbNotification();
        $mongoNotification->type = $data['type'];
        $mongoNotification->senderId = $data['senderId'];
        $mongoNotification->receiverId = $data['receiverId'];

        if ($data['type'] === 'SHOP-001') {
            $mongoNotification->content = '@@@ vừa mới thêm một sản phẩm: @@@@';
        } else if ($data['type'] === 'PROMOTION-001') {
            $mongoNotification->content = '@@@ vừa mới thêm một voucher: @@@@@';
        }

        $mongoNotification->options = $data['options'];

        $mongoNotification->save();

        return true;
    }
}
