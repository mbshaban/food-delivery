<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivers', function (Blueprint $table) {
            $table->id();
            $table->string('deliver_name');
            $table->boolean('isMale');
            $table->string('profile_picture');
            $table->string('full_address');
            $table->string('geolocation');
            $table->string('village');
            $table->timestamps();
        });

        Schema::table('delivers', function(Blueprint $table){
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('district_id')->constrained('districts')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivers');
    }
}
