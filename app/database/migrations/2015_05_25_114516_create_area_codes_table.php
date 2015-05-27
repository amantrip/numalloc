<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaCodesTable extends Migration {


	public function up()
	{
		Schema::create('area_codes', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('area');
            $table->integer('code');
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('area_codes');
	}

}
