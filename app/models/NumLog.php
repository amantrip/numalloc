<?php


class NumLog extends Eloquent {


    protected $table = 'log';

    protected $fillable = ['number', 'type', 'description'];
    protected $hidden = [];

}
