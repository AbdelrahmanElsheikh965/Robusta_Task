<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->string('password');
			$table->string('api_token');
			$table->string('pin_code');
			$table->integer('bus_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}
