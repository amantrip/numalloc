<?php


class Number extends Eloquent {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'numbers';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $fillable = ['number', 'owner', 'ocn', 'certificate', 'location','alt_spid' , 'service_indicator','reachability', 'type', 'pin'];
    protected $hidden = [];

}
