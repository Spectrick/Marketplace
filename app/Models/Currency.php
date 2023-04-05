<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use AmrShawky\LaravelCurrency\Facade\Currency as ExchangeCurrency;

class Currency extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'id', 'name', 'price',
        'active', 'sort',
    ];
}
