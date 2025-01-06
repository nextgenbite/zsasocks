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
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->unique()->nullable();
            $table->text('address');
            // $table->string('thana');
            // $table->string('district');
            $table->text('notes')->nullable();
            $table->decimal('amount')->default(0);
            $table->decimal('coupon')->default(0)->nullable();
            $table->string('delivery_type');
            $table->string('order_date');
            $table->string('order_month');
            $table->string('order_year');
            $table->tinyInteger('status')->default(0); //0= panding, 1= confirm, 2 = dalivered, 3 = sent, 4= return, 5= cancel it's need update to enum
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
