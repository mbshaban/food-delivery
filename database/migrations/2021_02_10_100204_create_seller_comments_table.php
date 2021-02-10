<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_comments', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->timestamps();
        });
        Schema::table('seller_comments', function(Blueprint $table){
            $table->foreignId('seller_id')->constrained('sellers')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('seller_comments');
    }
}
