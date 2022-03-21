<?php
/**
 * Created by PhpStorm.
 * User: El Niño
 * Date: 01/10/2017
 * Time: 21:48
 */

class Model
{

    /**
     * List of field types
     */
    const TYPE_INT     = 1;
    const TYPE_BOOL    = 2;
    const TYPE_STRING  = 3;
    const TYPE_FLOAT   = 4;
    const TYPE_DATE    = 5;
    const TYPE_HTML    = 6;
    const TYPE_NOTHING = 7;
    const TYPE_SQL     = 8;

    protected static $table;

    protected $definition;

    protected $fillable;

    /**
     * @return PDOStatement
     */
    public static function getAll()
    {
        return Db::getConnection()->query(sprintf('SELECT * FROM %s', static::$table), PDO::FETCH_CLASS, static::class);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public static function getById($id)
    {
        $stmt = Db::getConnection()->prepare(sprintf('SELECT * FROM %s WHERE id = :id LIMIT 1', static::$table));
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchObject(static::class);
    }

    /**
     * @param $id
     *
     * @return int
     */
    public static function deleteById($id)
    {
        $stmt = Db::getConnection()->prepare(sprintf('DELETE FROM %s WHERE id = :id', static::$table));
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount();
    }

    protected function sailDefinition()
    {
        foreach ($this->definition as $field => $rules) {
            if (isset($rules['allowEmpty']) && $rules['allowEmpty'] === true && empty($this->{$field})) {
                return true;
            }

            switch ($rules['type']) {
                case self::TYPE_INT:
                    break;
                case self::TYPE_BOOL:
                    break;
                case self::TYPE_STRING:

                    break;
            }
        }

        return false;
    }

    protected function extractFillableParams($params)
    {
        return array_intersect_key($params, array_combine($this->fillable, $this->fillable));
    }

    /**
     * @param array $params
     *
     * @return int
     */
    public function save($params = [])
    {
        if (!empty($params['id'])) {
            $id = $params['id'];
        }

        $params = $this->extractFillableParams($params);

        if (isset($id)) {
            $columns = [];
            foreach ($params as $k => $v) {
                $columns[] = sprintf('%s = :%s', $k, $k);
            }
            $stmt = Db::getConnection()->prepare(sprintf('UPDATE %s SET %s WHERE id = :id', static::$table, implode(',', $columns)));
            $stmt->bindValue('id', $id);
        } else {

            $stmt = Db::getConnection()->prepare(sprintf('INSERT INTO %s (%s) VALUES (%s)', static::$table, implode(',', array_keys($params)),
                implode(',', array_map(function ($val) {
                    return sprintf(':%s', $val);
                }, array_keys($params)))));
        }

        foreach ($params as $param => $value) {
            $stmt->bindValue($param, $value);
        }

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}