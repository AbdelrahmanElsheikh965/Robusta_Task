<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('trips', function(Blueprint $table) {
			$table->foreign('start_station_id')->references('id')->on('stations')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('trips', function(Blueprint $table) {
			$table->foreign('end_station_id')->references('id')->on('stations')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('buses', function(Blueprint $table) {
			$table->foreign('bus_id')->references('id')->on('trips')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('trips', function(Blueprint $table) {
			$table->dropForeign('trips_start_station_id_foreign');
		});
		Schema::table('trips', function(Blueprint $table) {
			$table->dropForeign('trips_end_station_id_foreign');
		});
		Schema::table('buses', function(Blueprint $table) {
			$table->dropForeign('buses_bus_id_foreign');
		});
	}
}
