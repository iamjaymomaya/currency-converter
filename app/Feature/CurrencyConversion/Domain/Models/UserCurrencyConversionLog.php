<?php

namespace App\Feature\CurrencyConversion\Domain\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCurrencyConversionLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'from', 'to', 'amount', 'value', 'created_at', 'updated_at'];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime:d-m-Y H:i:s',
    ];

    public static function persist($data) : self {
        return self::create($data);
    }
}
