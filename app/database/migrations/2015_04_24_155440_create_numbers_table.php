<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNumbersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('numbers', function(Blueprint $table)
		{
			$table->increments('id');
            $table->bigInteger('number')->unique();
            $table->integer('ocn');
            $table->string('owner');
            $table->longText('certificate');
            $table->string('location');
            $table->integer('alt_spid');
            $table->string('service_indicator');
            $table->string('reachability');
            $table->enum('type', ['mobile', 'landline']);
            $table->string('pin');
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('numbers');
	}

}
