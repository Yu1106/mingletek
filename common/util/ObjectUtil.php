<?php
/**
 * Created by PhpStorm.
 * User: jacky
 * Date: 2019/11/17
 * Time: 下午 11:44
 */

namespace common\util;


class ObjectUtil
{
    /**
     * @param $from
     * @param $to
     * @param array $properties
     * @return mixed
     */
    public static function copyProperties($from, $to, array $properties)
    {
        foreach ($properties as $p) {
            if (isset($from->$p)) {
                $to->$p = $from->$p;
            }
        }
        return $to;
    }

    public static function array2map(array $list, string $key)
    {
        $map = [];
        foreach ($list as $obj) {
            $map[$obj->$key] = $obj;
        }
        return $map;
    }

    public static function object2array($object, array $attributes)
    {
        $data = [];
        foreach ($attributes as $attribute) {
            $data[$attribute] = $object->$attribute;
        }

        return $data;
    }

    public static function arrayMerge($a, $b)
    {
        $args = func_get_args();
        $res = array_shift($args);
        while (!empty($args)) {
            foreach (array_shift($args) as $k => $v) {
                if (is_int($k)) {
                    if (array_key_exists($k, $res)) {
                        $res[] = $v;
                    } else {
                        $res[$k] = $v;
                    }
                } elseif (is_array($v) && isset($res[$k]) && is_array($res[$k])) {
                    $res[$k] = self::arrayMerge($res[$k], $v);
                } else {
                    $res[$k] = $v;
                }
            }
        }

        return $res;
    }
}
