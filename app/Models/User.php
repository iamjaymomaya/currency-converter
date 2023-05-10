<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Feature\CurrencyConversion\Domain\Models\UserCurrencyConversionLog;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function persistConversionQuery(string $from, string $to, float $amount = 1) {
        return UserCurrencyConversionLog::persist(
            [
                'user_id' => $this->id,
                'from' => $from,
                'to' => $to,
                'amount' => $amount,
                'created_at' => Carbon::now()
            ]
        );
    }

    public function updateResponse(UserCurrencyConversionLog $query, $resp) {
        $query->value = $resp;
        $query->save();

        return $query;
    }

    public function userCurrencyConversionLogs() {
        return $this->hasMany(UserCurrencyConversionLog::class);
    }

    public function userCurrencyConversionLogsInDesc() {
        return $this->hasMany(UserCurrencyConversionLog::class)->orderBy('id', 'desc');
    }
}
