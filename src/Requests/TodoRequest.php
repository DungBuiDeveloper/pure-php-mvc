<?php
namespace App\Requests;

use \BaseClass\Validation;

class TodoRequest extends Validation
{

    public function addValidate($data)
    {
        $this->name('Event Title')->value($data['title'])->required();
        if ($this->isSuccess()) {
            return true;
        } else {
            return $this->getErrors();
        }
    }

    public function deleteValidate($data)
    {
        $this->name('Event')->value($data['id'])->required();
        if ($this->isSuccess()) {
            return true;
        } else {
            return $this->getErrors();
        }
    }

    public function editValidate($data)
    {
        $this->name('Event')->value($data['id'] ?? null)->required();
        if ($this->isSuccess()) {
            return true;
        } else {
            return $this->getErrors();
        }
    }
}
