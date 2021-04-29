<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerLocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_location', function (Blueprint $table) {
            $table->id();
            $table->string('longitude');
            $table->string('latitude');
            $table->string('title');
            $table->string('address');
            $table->string('phone');
            $table->timestamps();
        });
        Schema::table('customer_location', function(Blueprint $table){
            $table->foreignId('customer_id')->constrained('customers')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_location');
    }
}
