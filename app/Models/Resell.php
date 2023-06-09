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
            'billing_acount_id',
            'project_name',
            'project_id',
            'project_hierarchy',
            'Service_description',
            'Service_ID',
            'SKU_description',
            'SKU_ID',
            'Credit_type',
            'Cost_type',
            'Usage_start_date',
            'Usage_end_date',
            'Usage_amount',
            'Usage_unit',
            'Unrounded_cost',
            'Cost',
    ];

    public static function Where(string $string)
    {
    }
}
