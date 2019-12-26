<?php
/**
 * Created by PhpStorm.
 * User: jacky
 * Date: 2019/11/17
 * Time: 下午 11:40
 */

namespace common\util;


class SQLUtil
{
    public static function join(array $arr, string $prefix = "p")
    {
        $tmpArr = [];
        foreach ($arr as $i => $v) {
            $key = sprintf(":%s%s", $prefix, $i);
            $tmpArr[] = $key;
        }

        return implode(",", $tmpArr);
    }

    public static function bind(array $orig, array $arr, string $prefix = "p")
    {
        $returnArr = [];
        foreach ($arr as $i => $v) {
            $key = sprintf(":%s%s", $prefix, $i);
            $returnArr[$key] = $v;
        }
        return ObjectUtil::arrayMerge(
            $orig,
            $returnArr
        );
    }

    public static function buildCondition(array $conditions)
    {
        $sql = "";
        $params = [];
        $operatorMaps = ["equals" => "=", "greater" => ">", "less" => "<"];
        foreach ($conditions as $conditionKey => $condition) {
            $prepareField = ":" . $conditionKey;
            if (trim($condition["value"]) !== "" && $condition["operator"] != "no") {
                $sql .= " AND `" . $condition["field"] . "` " . $operatorMaps[$condition["operator"]] . " " . $prepareField;
                $params[$prepareField] = $condition["value"];
            }
        }
        return ["sql" => $sql, "params" => $params];
    }
}
