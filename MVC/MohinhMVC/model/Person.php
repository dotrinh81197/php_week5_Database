<?php
class Person
{
    public $name;
    public $birthday;
    public $description;

    public function __construct($name, $birthday, $description)
    {
        $this->name = $name;
        $this->birthday = $birthday;
        $this->description = $description;
    }
}
