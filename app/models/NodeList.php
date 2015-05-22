<?php


class NodeList extends Eloquent {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'node_list';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $fillable = ['domain', 'socket'];
    protected $hidden = [];

}
