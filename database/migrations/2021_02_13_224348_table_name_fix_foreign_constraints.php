<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableNameFixForeignConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::rename('category', 'categories');

        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('category', 'category_id');
            $table->bigInteger('category_id')->unsigned()->change();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->boolean('has_color_variant')->default(false)->after('description');
            $table->boolean('has_size_variant')->default(false)->after('description');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->text('description');
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->integer('quantity');
            $table->integer('total_cost');
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category', function (Blueprint $table) {
            //
        });
    }
}
