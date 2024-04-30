<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SqlProduct extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = [
        'product_name',
        'shop_name',
        'price',
    ];
}
