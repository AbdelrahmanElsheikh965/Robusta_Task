<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration {

	public function up()
	{
		Schema::create('trips', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->integer('start_station_id')->unsigned()->nullable();
			$table->integer('end_station_id')->unsigned()->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('trips');
	}
}
