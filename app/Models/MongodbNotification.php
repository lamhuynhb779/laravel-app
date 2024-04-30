<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class MongodbNotification extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $collection = 'notifications';

    protected $fillable = [
        'type',
        'senderId',
        'receiverId',
        'content',
        'options'
    ];
}
