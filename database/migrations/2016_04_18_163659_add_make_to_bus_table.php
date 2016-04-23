<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMakeToBusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buses', function ($table) {
            $table->string('make');
            $table->boolean('wifi')->default(false);
            $table->boolean('usb')->default(false);
            $table->boolean('toilet')->default(false);
            $table->string('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buses', function ($table) {
            $table->dropcolumn('make');
            $table->dropcolumn('wifi');
            $table->dropcolumn('usb');
            $table->dropcolumn('toilet');
            $table->dropcolumn('type');
        });
    }
}
