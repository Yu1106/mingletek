<?php

namespace common\model;


use common\util\SQLUtil;

abstract class Model
{
    abstract protected static function tableName();

    protected static function getDb()
    {
        global $pdo;
        return $pdo;
    }

    public static function findById(int $id)
    {
        return self::getDb()->queryOne("select * from `" . static::tableName() . "` where id = :id", [":id" => $id]);
    }

    public static function exists(int $id)
    {
        $result = self::getDb()->queryOne("select 1 from `" . static::tableName() . "` where id = :id", [":id" => $id]);
        return empty($result) ? false : true;
    }

    public static function findAll()
    {
        return self::getDb()->sqlQuery("select * from `" . static::tableName() . "` order by id desc");
    }

    public static function delete(array $idList)
    {
        return self::getDb()->delete("id in (" . SQLUtil::join($idList) . ")", SQLUtil::bind([], $idList), static::tableName());
    }
}
