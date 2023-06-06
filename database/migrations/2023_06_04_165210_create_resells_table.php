<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resell', function (Blueprint $table) {
            $table->id();
            $table->string('billing_acount_name')->nullable();
            $table->string('billing_acount_id')->nullable();
            $table->string('project_name')->nullable();
            $table->string('project_id')->nullable();
            $table->string('project_hierarchy')->nullable();
            $table->string('Service_description')->nullable();
            $table->string('Service_ID')->nullable();
            $table->string('SKU_description')->nullable();
            $table->string('SKU_ID')->nullable();
            $table->string('Credit_type')->nullable();
            $table->string('Cost_type')->nullable();
            $table->string('Usage_start_date')->nullable();
            $table->string('Usage_end_date')->nullable();
            $table->string('Usage_amount')->nullable();
            $table->string('Usage_unit')->nullable();
            $table->string('Unrounded_cost')->nullable();
            $table->string('Cost')->nullable();
            $table->integer('created_by')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resell');
    }
};
