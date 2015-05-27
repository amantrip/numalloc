<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNumbersTable extends Migration {


	public function up()
	{
		Schema::create('numbers', function(Blueprint $table)
		{
			$table->increments('id');
            $table->bigInteger('number')->unique();
            $table->string('cnam');
            $table->string('ocn');
            $table->string('assignee');
            $table->longText('certificate');
            $table->string('location_zip');
            $table->string('location');
            $table->string('otc');// A six-digit, TNS-assigned Operating Telephone Company number.
            $table->string('rao'); //The Telcordia-assigned billing Revenue Accounting Office.
            $table->string('bsp'); // Billing Service Provider.
            $table->enum('collect', ['allow', 'deny']);
            $table->integer('alt_spid');
            $table->string('service_indicator');
            $table->string('reachability');
            $table->enum('type', ['mobile', 'landline']);
            $table->string('pin');
            $table->string('password');
            $table->string('accesscode');
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('numbers');
	}

}
