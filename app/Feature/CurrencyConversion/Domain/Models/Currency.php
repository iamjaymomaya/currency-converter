<?php

namespace App\Feature\CurrencyConversion\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'symbol', 'created_at'];
}
