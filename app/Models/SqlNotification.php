<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SqlNotification extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $table = 'notifications';

    protected $primaryKey = 'id';

    protected $fillable = [
        'type',
        'senderId',
        'receiverId',
        'content',
        'options'
    ];
}
