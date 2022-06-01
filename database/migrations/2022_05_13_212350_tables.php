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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 100);
            $table->string('password', 100);
            $table->string('name', 100);
            $table->enum('role', ['customer', 'admin']);
            $table->string('img_path')->default('img/pfp/default.jpg');
        });
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->integer('price');
            $table->integer('count');
            $table->text('desc');
            $table->string('img_path')->default('img/items/default.png');
        });
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_id', unsigned:true);
            $table->foreign('item_id')->references('id')->on('items');
            $table->integer('count');
            $table->bigInteger('customer_id', unsigned:true);
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_id', unsigned:true);
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->bigInteger('customer_id', unsigned:true);
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('comment');
            $table->date('date');
        });
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('tag', 100);
            $table->bigInteger('item_id', unsigned:true);
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id', unsigned:true);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('item_id', unsigned:true);
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->integer('count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('users');
        Schema::dropIfExists('items');
    }
};
