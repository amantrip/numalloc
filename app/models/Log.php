<?php


class Log extends Eloquent {


    protected $table = 'log';

    protected $fillable = ['number', 'serial_number', 'description'];
    protected $hidden = [];

}
