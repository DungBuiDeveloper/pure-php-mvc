<?php
namespace App\Requests;

use \BaseClass\Validation;

class TodoRequest extends Validation
{

    public function addValidate($data)
    {
        $this->name('Event Title')->value($data['title']?? null)->required();
        $this->name('Start Event')->value($data['start'] ?? null)->required();
        $this->name('End Event')->value($data['end'] ?? null)->required();
        if ($this->isSuccess()) {
            return true;
        } else {
            return $this->getErrors();
        }
    }

    public function deleteValidate($data)
    {
        $this->name('Event')->value($data['id'])->pattern('int')->required();
        if ($this->isSuccess()) {
            return true;
        } else {
            return $this->getErrors();
        }
    }

    public function editValidate($data)
    {
        $this->name('Event')->value($data['id'] ?? null)->pattern('int')->required();
        if ($this->isSuccess()) {
            return true;
        } else {
            return $this->getErrors();
        }
    }
}
