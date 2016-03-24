<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->integer('from')->unsigned();
            $table->foreign('from')->references('id')->on('cities');
            $table->integer('to')->unsigned();
            $table->foreign('to')->references('id')->on('cities');
            $table->string('name');
            $table->decimal('rating');
            $table->time('depart_at');
            $table->time('arrive_at');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->enum('reoccurring', array('NO', 'WEEKDAY', 'MONTHDAY', 'MONTH_REL', 'YEARLY'))->default('NO');
            $table->integer('weekdays');
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
        Schema::drop('trips');
    }
}
