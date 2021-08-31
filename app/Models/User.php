<?php

namespace App\Models;

use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Interfaces\Wallet;

class User extends Authenticatable implements Wallet
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasWallet;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone_no'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->code) {
                $model->code = static::findAvailableCode();
                if (!$model->code) {
                    return false;
                }
            }
        });
        static::saved(function ($model) {
        });
    }

    public static function findAvailableCode()
    {
        for ($i = 0; $i < 10; $i++) {
            $code = str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            $code = strtoupper($code);
            if (!static::query()->where('code', $code)->exists()) {
                return $code;
            }
        }   
        return false;
    }

    public function readable()
    {
        return $this->hasMany(UserRead::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function bentos()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function referral(){
        return $this->hasMany(User::class,'referrer');
    }

    public function payments(){
        return $this->hasMany(UserPayment::class);
    }

    public function invite(){
        return $this->belongsTo(User::class, 'referrer');
    }

    public function merchant(){
        return $this->hasOne(UserMerchant::class);
    }
   
    public function cartItem(){
        return $this->hasMany(CartItem::class);
    }

    public function coupons(){
        return $this->hasMany(UserCoupon::class);
    }

    
}
