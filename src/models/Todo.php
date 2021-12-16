<?php
namespace App\Models;

use \BaseClass\Model;

class Todo extends Model
{
    public function getList()
    {
        $sql = "SELECT id,name as title,start_task as start,end_task as end, status FROM todos";
        $this->query($sql);
        $rows = $this->resultSet();
        return $rows;
    }
    
}
