<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductServiceCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_service_categories', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('type')->default(0);
            $table->string('color')->default('#fc544b');
            $table->integer('created_by')->default('0');
            $table->foreignId('parent_id')->references('id')->on('product_service_categories')->nullable();
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
        Schema::dropIfExists('product_service_categories');
    }
}
