<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_item_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('item_id');
            $table->unsignedInteger('order_id');
            $table->integer('quantity');
            $table->timestamps();

            //foreign key
             $table->foreign('item_id')
            ->references('id')
            ->on('items')
            ->onDelete('restrict')
            ->onUpdate('cascade');

             $table->foreign('order_id')
            ->references('id')
            ->on('orders')
            ->onDelete('restrict')
            ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_item_orders');
    }
}
