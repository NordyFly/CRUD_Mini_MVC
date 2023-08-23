<?php
namespace Nordy\Php\Entity;

use Nordy\Php\Kernel\Model;

class User extends Model
{

    private int $id;
    private string $first_name;
    private string $last_name;

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->first_name;
    }
    public function getSurname()
    {
        return $this->last_name;
    }

}
