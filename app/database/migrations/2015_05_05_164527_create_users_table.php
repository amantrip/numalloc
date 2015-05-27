<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {


	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('ocn');
            $table->string('assignee');
            $table->enum('type', ['number', 'system']);
            $table->string('accesscode');
            $table->enum('verified', ['Yes', 'No']);
            $table->rememberToken();
            $table->timestamps();
		});
	}


	public function down()
	{
		Schema::drop('users');
	}

}
