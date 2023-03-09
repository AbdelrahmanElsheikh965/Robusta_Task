<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesTable extends Migration {

	public function up()
	{
		Schema::create('buses', function(Blueprint $table) {
			$table->integer('bus_id')->primary()->unsigned();
			$table->integer('seats')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('buses');
	}
}
