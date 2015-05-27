<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOcnsTable extends Migration {


	public function up()
	{
		Schema::create('ocns', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('state');
            $table->string('ocn')->unique();
            $table->string('company');
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('ocns');
	}

}
