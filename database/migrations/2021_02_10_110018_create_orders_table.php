<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_status');
            $table->text('location');
            $table->text('geolocation');
            $table->string('village');
            $table->timestamps();
        });
        Schema::table('orders', function(Blueprint $table){
            $table->foreignId('customer_id')->constrained('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('seller_id')->constrained('sellers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('deliver_id')->constrained('delivers')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
