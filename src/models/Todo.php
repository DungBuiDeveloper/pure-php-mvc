<?php
namespace App\Models;

use \BaseClass\Model;


class Todo extends Model
{
    public function getList() {
        $sql = "SELECT id,name as title,start_task as start,end_task as end, status FROM todos";
        $this->query($sql);
        return $this->resultSet();
    }

    public function addTodo($data) {
        $this->query('INSERT INTO todos (name, start_task, end_task, status) VALUES (:name, :start_task, :end_task, :status)');
        $this->bind(':name', $data['title']);
        $this->bind(':start_task', $data['start']);
        $this->bind(':end_task', $data['end']);
        $this->bind(':status', 1);
        $this->execute();
        return $this->lastInsertId();
    }

    public function deleteTodo($data) {
        $this->query('DELETE FROM todos WHERE id = :id');
        $this->bind(':id', $data['id']);
        $this->execute();
        return true;
    }

    public function editTodo($data) {

        $this->query('UPDATE todos SET name = :title, status = :status,end_task =:end_task , start_task=:start_task WHERE id = :id');
        $this->bind(':title', $data['title']);
        $this->bind(':status', $data['status']);
        $this->bind(':id', $data['id']);
        $this->bind(':start_task', $data['start']);
        $this->bind(':end_task', $data['end']);
        $this->execute();
        return true;
    }
    
}
