<?php
/**
 * Created by PhpStorm.
 * User: El Niño
 * Date: 01/10/2017
 * Time: 19:24
 */

class Loan extends Model
{
    public $id;

    public $name;

    protected static $table = 'loans';

    protected $fillable = ['book_id', 'customer_id', 'borrowed_at', 'returned_at'];

    public static function getAll()
    {
        return Db::getConnection()->query('SELECT l.*, c.name as customer, b.name as book, b.id as book_id FROM loans l INNER JOIN customers c ON l.customer_id = c.id INNER JOIN books b on b.id = l.book_id GROUP BY l.id', PDO::FETCH_OBJ);
    }
}