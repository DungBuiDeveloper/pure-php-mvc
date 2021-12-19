<?php
namespace App\Services;

class StatusTodo
{
    public static function formatStatusToBg($data)
    {
        foreach ($data as $key => $value) {
            switch ($value['status']) {
                case PLANNING:
                    $color = PLANNING_COLOR;
                    break;
                case DOING:
                    $color = DOING_COLOR;
                    break;
                default:
                    $color = COMPLETE_COLOR;
                    break;
            }
            $data[$key]['backgroundColor'] = $color;
        }
        return $data;
    }
}
