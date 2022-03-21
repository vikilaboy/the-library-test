<?php
/**
 * Created by PhpStorm.
 * User: El Niño
 * Date: 01/10/2017
 * Time: 19:24
 */

class Customer extends Model
{
    public $id;

    public $name;

    protected $fillable = ['name'];

    protected static $table = 'customers';
}