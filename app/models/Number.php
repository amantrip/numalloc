<?php


class Number extends Eloquent {


    protected $table = 'numbers';


    protected $fillable = ['number', 'cnam', 'ocn', 'assignee', 'certificate', 'location_zip', 'location','otc', 'rao', 'bsp', 'collect', 'alt_spid' , 'service_indicator','reachability', 'type', 'pin', 'password', 'accesscode'];
    protected $hidden = [];

}
