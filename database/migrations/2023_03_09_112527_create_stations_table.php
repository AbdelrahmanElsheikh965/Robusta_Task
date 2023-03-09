<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationsTable extends Migration {

	public function up()
	{
		Schema::create('stations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('station_time');
		});
	}

	public function down()
	{
		Schema::drop('stations');
	}
}
