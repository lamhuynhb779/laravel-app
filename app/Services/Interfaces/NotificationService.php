<?php

namespace App\Services\Interfaces;

interface NotificationService
{
    public function pushNoti(array $data = []): bool;
}
