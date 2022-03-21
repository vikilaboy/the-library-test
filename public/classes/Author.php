<?php
/**
 * Created by PhpStorm.
 * User: El Niño
 * Date: 01/10/2017
 * Time: 19:24
 */

class Author extends Model
{
    public $id;

    public $name;

    protected static $table = 'authors';

    protected $fillable = ['name'];

    protected $definition = [
        'name' => ['type' => self::TYPE_STRING, 'required' => true, 'size' => 255, 'allowEmpty' => false]
    ];
}