<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyDetails extends Model
{
    use SoftDeletes;

    protected $table = 'property_details';

    protected $fillable = [
        'request_id',
        'business_legal_name',
        'owner_email',
        'owner_phone',
        'owner_fname',
        'owner_lname',
        'homeowner_detail',
        'rental_info_features',
        'occupancy_availability',
        'utilities_inc_restrictions',
        'other_details',
        'status',
        'is_contract_generated',
        'is_contract_downloaded',
        'is_vflyer_generated',
        'csnare_url',
        'followers',
        'pd_status',
        'contract_status',
        'signed',
        'pod_id',
        'pd_id',
    ];

    protected $casts = [
        'homeowner_detail' => 'array',
        'rental_info_features' => 'array',
        'occupancy_availability' => 'array',
        'utilities_inc_restrictions' => 'array',
        'other_details' => 'array',
        'is_contract_generated' => 'boolean',
        'is_contract_downloaded' => 'boolean',
        'is_vflyer_generated' => 'boolean',
        'signed' => 'boolean',
        'pod_id' => 'integer',
    ];
}
