<?php

namespace App\Models;

use CloudinaryLabs\CloudinaryLaravel\MediaAlly;
use Illuminate\Database\Eloquent\Model;

class CloudinaryMedia extends Model
{
    use MediaAlly;

    protected $fillable = [
        'optimized_url',
    ];
}
