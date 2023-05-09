<?php

namespace App\Feature\CurrencyConversion\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCurrencyConversionLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'from', 'to', 'amount', 'value', 'created_at'];

    public static function persist($data) : self {
        return self::create($data);
    }
}
