<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockDetail extends Model
{
    protected $table = 'stocks_detail';

    protected $fillable = [
        'symbol',
        'high',
        'low',
        'price',
    ];
}
