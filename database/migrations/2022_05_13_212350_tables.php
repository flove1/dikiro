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
            $table->string('token')->nullable();
            $table->enum('role', ['customer', 'admin']);
        });
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->integer('price');
            $table->integer('count');
            $table->text('desc');
            $table->string('img_path');
        });
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_id', unsigned:true);
            $table->foreign('item_id')->references('id')->on('items');
            $table->integer('count');
            $table->bigInteger('customer_id', unsigned:true);
            $table->foreign('customer_id')->references('id')->on('users');
        });
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_id', unsigned:true);
            $table->foreign('item_id')->references('id')->on('items')->cascadeOnDelete();
            $table->bigInteger('customer_id', unsigned:true);
            $table->foreign('customer_id')->references('id')->on('users');
            $table->text('comment');
            $table->date('date');
        });
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('tag', 100);
            $table->bigInteger('item_id', unsigned:true);
            $table->foreign('item_id')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('users');
        Schema::dropIfExists('items');
    }
};
