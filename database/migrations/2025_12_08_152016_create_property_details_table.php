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
        Schema::create('property_details', function (Blueprint $table) {
            $table->id();
            $table->text('business_legal_name')->nullable();
            $table->text('owner_email')->nullable();
            $table->text('owner_phone')->nullable();
            $table->text('owner_fname')->nullable();
            $table->text('owner_lname')->nullable();
            $table->json('homeowner_detail')->nullable();
            $table->json('rental_info_features')->nullable();
            $table->json('occupancy_availability')->nullable();
            $table->json('utilities_inc_restrictions')->nullable();
            $table->json('other_details')->nullable();
            $table->string('status')->default('draft');
            $table->boolean('is_contract_generated')->default(false);
            $table->boolean('is_contract_downloaded')->default(false);
            $table->boolean('is_vflyer_generated')->default(false);
            $table->text('csnare_url')->nullable();
            $table->text('followers')->nullable();
            $table->string('pd_status')->nullable();
            $table->string('contract_status')->nullable();
            $table->boolean('signed')->default(false);
            $table->integer('pod_id')->nullable();
            $table->string('pd_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_details');
    }
};
