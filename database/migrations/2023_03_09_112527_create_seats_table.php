<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatsTable extends Migration {

	public function up()
	{
		Schema::create('seats', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->integer('user_id')->unsigned()->nullable();
			$table->timestamps();
			$table->integer('bus_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('seats');
	}
}
