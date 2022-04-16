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
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('order_detail_id');
            $table->float('unit_price',5);
            $table->integer('size');
            $table->integer('quantity');
            $table->float('discount',3);
            $table->decimal('total',10,2);
            $table->dateTime('date');
            $table->foreignId('product_id')->constrained('products','product_id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('order_id')->constrained('orders','order_id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('bill_number')->constrained('payments','bill_number')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};
