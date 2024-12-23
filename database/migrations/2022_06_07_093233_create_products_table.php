<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('product_name');
            $table->string('slug');
            $table->string('sku');
            $table->integer('product_qty');
            $table->double('selling_price', 8, 2);
            $table->double('discount_price', 8, 2)->nullable();
            $table->longtext('short_descp_en')->nullable();
            $table->string('product_image');
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('video')->nullable();
            $table->boolean('trend')->default(false);
            $table->boolean('top')->default(false);
            $table->integer('priority')->nullable();
            $table->boolean('status')->default(false);
            $table->bigInteger('point')->nullable();
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
        Schema::dropIfExists('products');
    }
}
