<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RentalConsultation extends Model
{
    use SoftDeletes;

    protected $table = 'newbiz_requests';

    protected $fillable = [
        'tenant_id',
        'name',
        'email',
        'phone_number',
        'rental_property_address',
        'city_of_rental_property',
        'best_desc_property',
        'estimated_square_footage',
        'number_of_bedrooms',
        'when_planning_to_rent',
        'plans_with_property',
        'considering_selling',
        'rent_amount_in_mind',
        'worked_with_property_manager',
        'where_heard_about_orca',
        'additional_information',
    ];

    protected $casts = [
        'estimated_square_footage' => 'integer',
        'number_of_bedrooms' => 'integer',
    ];
}
