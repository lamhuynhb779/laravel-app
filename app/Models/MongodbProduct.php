<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class MongodbProduct extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $collection = 'products';

    protected $fillable = [
        'product_name',
        'shop_name',
        'price',
    ];

}
