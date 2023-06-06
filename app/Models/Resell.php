<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Resell extends Model
{
    use HasFactory;
    use HasRoles;
    use Notifiable;

    protected $guard_name = 'web';
    protected $fillable   = [
        'id',
        'billing_acount_name',
//        'email',
//        'password',
//        'contact',
//        'avatar',
//        'is_active',
//        'created_by',
//        'email_verified_at',
//        'billing_name',
//        'billing_country',
//        'billing_state',
//        'billing_city',
//        'billing_phone',
//        'billing_zip',
//        'billing_address',
//        'shipping_name',
//        'shipping_country',
//        'shipping_state',
//        'shipping_city',
//        'shipping_phone',
//        'shipping_zip',
//        'shipping_address',
    ];
}
