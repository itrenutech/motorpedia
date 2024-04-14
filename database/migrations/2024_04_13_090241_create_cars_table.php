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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('brand_id')->unsigned()->index();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->bigInteger('model_id')->unsigned()->index();
            $table->foreign('model_id')->references('id')->on('models');
            $table->bigInteger('variant_id')->unsigned()->index();
            $table->foreign('variant_id')->references('id')->on('variants');
            $table->bigInteger('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('car_categories');
            $table->bigInteger('type_id')->unsigned()->index();
            $table->foreign('type_id')->references('id')->on('car_types');
            $table->bigInteger('transmission_id')->unsigned()->index();
            $table->foreign('transmission_id')->references('id')->on('transmissions');
            $table->bigInteger('fuel_id')->unsigned()->index();
            $table->foreign('fuel_id')->references('id')->on('fuels');
            $table->string('name');
            $table->string('slug');
            $table->string('color', 50);
            $table->string('color_pic', 100);
            $table->smallInteger('featured')->default(0);
            $table->smallInteger('hot_selling')->default(0);
            $table->smallInteger('best_seller')->default(0);
            $table->string('discounted');
            $table->float('exshowroom_price');
            $table->float('discount_amount');
            $table->string('main_image');
            $table->string('video_path');
            $table->string('360_path');
            $table->integer('created_by')->nullable();
            $table->integer('modified_by')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->integer('status')->default(1);
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
