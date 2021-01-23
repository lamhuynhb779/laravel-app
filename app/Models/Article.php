<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * Fields inside the $fillable property can be mass assigned using 
     * Eloquent’s create() and update() methods
     */
    protected $fillable = ['title', 'body'];
    /**
     * You can also use the $guarded property, to allow all but a few properties.
     */
    protected $guarded = [];
}
