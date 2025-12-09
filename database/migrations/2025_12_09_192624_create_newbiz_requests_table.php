<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('newbiz_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable()->index();
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->text('rental_property_address');
            $table->string('city_of_rental_property');
            $table->string('best_desc_property')->nullable();
            $table->integer('estimated_square_footage')->nullable();
            $table->integer('number_of_bedrooms')->nullable();
            $table->string('when_planning_to_rent')->nullable();
            $table->string('plans_with_property')->nullable();
            $table->string('considering_selling')->nullable();
            $table->string('rent_amount_in_mind')->nullable();
            $table->string('worked_with_property_manager')->nullable();
            $table->string('where_heard_about_orca')->nullable();
            $table->text('additional_information')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newbiz_requests');
    }
};
