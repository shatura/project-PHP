<?php


class validation
{
    private $_db;
    public $errors = [];

    public function __constract($db)
    {
        $this->_db = $db;
    }

    public function checkEmpty($name,$value)
    {
        $name = ucfirst(str_replace("_", " ", $name));
        if (empty($value)) {
            return $this->errors[] = "Please enter " .$name;
        }else{
            return 0;
        }
    }

    public  function checkMatch($name1,$name2,$value1,$value2)
    {
        $name1 = ucfirst(str_replace("_"," ", $name1));
        $name2 = ucfirst(str_replace("_"," ", $name2));
        if ($value1 !== $value2){
            return $this->errors[] = "Your " .$name2. " is not match " .$name1;
        }else{
            return 0;
        }
    }

    public function checkMaxLength($name,$value,$table,$column)
    {
        $name = ucfirst(str_replace("_"," ", $name));
        $maxLength = $this->_db->getMaxLegth($table,$column);
        if (strlen($value) > $maxLength){
            return $this->errors = $name. " is too long. Max length is " .$maxLength. " characters";
        }else{
            return 0;
        }
    }

    public function checkMinLength($name,$value,$minLength)
    {
        $name = ucfirst(str_replace("_"," ", $name));
        if (strlen($value) < $minLength){
            return $this->errors = $name. " should contains at least " .$minLength. " characters";
        }else{
            return 0;
        }
    }

}