<?php


class OCN extends Eloquent {


    protected $table = 'ocns';

    protected $fillable = ['state', 'ocn', 'company', 'type'];
    protected $hidden = [];

}
