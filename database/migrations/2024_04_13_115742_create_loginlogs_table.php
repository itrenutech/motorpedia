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
        Schema::create('loginlogs', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('login_id')->nullable();
            $table->string('login_by')->nullable();
            $table->string('type')->nullable();
            $table->string('time')->nullable();            
            $table->string('ip_address')->nullable();            
            $table->string('session')->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loginlogs');
    }
};
