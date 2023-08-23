<?php

namespace Nordy\Php\Entity;
use Nordy\Php\Kernel\Model;

class Notes extends Model {
    private int $id;
    private int $note;

    public function getId() {
        return $this->id;
    }
    
    public function getNote() {
        return $this->note;
    }
}