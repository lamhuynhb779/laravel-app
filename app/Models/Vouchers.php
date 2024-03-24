<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $voucher_id
 */
class Vouchers extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_uuid',
    ];
}
