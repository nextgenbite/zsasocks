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
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('name');
            $table->string('phone');
            $table->text('address');
            $table->string('thana');
            $table->string('district');
            $table->text('notes')->nullable();
            $table->float('amount',8,2);
            $table->float('coupon',8,2)->nullable();
            $table->string('delivery_type');
            $table->string('order_date');
            $table->string('order_month');
            $table->string('order_year');
            $table->tinyInteger('status')->default(0); //0= panding, 1= confirm, 2 = dalivered, 3 = sent, 4= return, 5= cancel 
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
        Schema::dropIfExists('orders');
    }
}
