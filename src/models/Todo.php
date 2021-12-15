<?php
namespace App\Models;

use \BaseClass\Model;

class Todo extends Model
{
    public function getList()
    {
        $sql = "SELECT id,name,start_task,end_task FROM todos";
        $this->query($sql);
        $rows = $this->resultSet();
        return $rows;
    }
    
}
