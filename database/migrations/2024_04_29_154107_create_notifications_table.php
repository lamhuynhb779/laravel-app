<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    // ORDER-001: order success
    // ORDER-002: order failed
    // PROMOTION-001: new promotion
    // SHOP-001: new product by user following

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['ORDER-001', 'ORDER-002', 'PROMOTION-001', 'SHOP-001']);
            $table->integer('senderId');
            $table->integer('receiverId');
            $table->string('content')->default('');
            $table->json('options')->default('{}');
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
        Schema::dropIfExists('sql_notifications');
    }
}
