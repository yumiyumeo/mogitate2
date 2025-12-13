<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->string('image');
            $table->json('seasons');
            $table->text('description', 120);
            $table->timestamps();
        });
        Schema::table('products', function (Blueprint $table) {
        $table->string('season')->nullable()->after('price');
    });
    }

    public function down()
    {
        Schema::dropIfExists('products');
        Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('season');
    });
    }
}
