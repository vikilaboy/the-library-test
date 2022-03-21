<?php
/**
 * Created by PhpStorm.
 * User: El Niño
 * Date: 01/10/2017
 * Time: 19:24
 */

class Book extends Model
{
    public $id;

    public $name;

    protected $fillable = ['name'];

    protected static $table = 'books';

    public static function getAll()
    {
        return Db::getConnection()->query('select b.*, GROUP_CONCAT(a.name) as authors
        from books  b
        inner join author_book ab on ab.book_id = b.id
        inner join authors a on ab.author_id = a.id
        group by b.id', PDO::FETCH_OBJ);
    }

    public function getAuthors($array = false)
    {
        $stmt = Db::getConnection()->prepare('SELECT * FROM authors a INNER JOIN author_book ab on a.id = ab.author_id WHERE ab.book_id = :book_id');
        $stmt->bindParam('book_id', $this->id, PDO::PARAM_INT);
        $stmt->execute();

        if ($array) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $stmt->fetchObject(Author::class);
    }
}