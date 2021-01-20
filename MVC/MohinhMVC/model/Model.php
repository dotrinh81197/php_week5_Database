<?php
include 'Model.php';
class Model
{
    // function getPersonList()
    public function getPersonList()
    {
        return array(
            'Petter Pan' => new Person('Petter Pan', '19xx', 'Nhan vat hu cau'),
            'MoonWalker' => new Person('MoonWalker', '01-11-1981', " i don't know"),
            'Trung' => new Person('Trung', '1921', "He is very crazy")
        );
    }
    // function getPersonName
    public function getPersonName($name)
    {
        $allPerson = $this->getPersonList();
        return $allPerson[$name];
    }
}
