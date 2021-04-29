<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->string('seller_type');
            $table->string('owner_name');
            $table->string('logo');
            $table->string('image');
            $table->string('full_address');
            $table->text('geolocation')->nullable();
            $table->string('village')->nullable();
            $table->boolean('is_new')->nullable();
            $table->boolean('is_favourite')->nullable();
            $table->string('deliver_time')->nullable();
            $table->integer('review')->nullable();
            $table->timestamps();
        });
        Schema::table('sellers', function(Blueprint $table){
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('district_id')->constrained('districts')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('status_id')->constrained('seller_status')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sellers');
    }
}
