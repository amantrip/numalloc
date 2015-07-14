<?php


class APIKeys extends Eloquent {


    protected $table = 'api_keys';

    protected $fillable = ['api', 'UID'];
    protected $hidden = [];

}
