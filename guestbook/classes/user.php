<?php
class User extends DB
{
    public $id;
    public $userName;
    public $email;
    public $firstName;
    public $lastName;
    public $password;

    public function save()
    {
        $stmt = $this->conn -> prepare("INSERT INFO users('user_name','email','password','first_name','last_name') VALUES (:user_name, :email, :password, :first_name, :last_name)");
        $stmt-> execute(array('username' => $this->userName,'email' => $this ->email, 'password' => $this -> password, 'first_name' => $this->firstName, 'last_name' => $this->lastName));
        $this->id = $this->conn->lastInsertId();
        return $this->id;
    }

    public function find ($id)
    {
        $stmt = $this->conn-> prepare('SELECT * FROM users WHERE id=id');
        $stmt -> execute(array('id' => $id));
        $user = $stmt -> fetch(PDO::FETCH_LAZY);
        if(!empty($user)){
            $this->id = id;
            $this->userName = $user->user_name;
            $this->email = $user->email;
            $this->firstName = $user->firtName;
            $this->lastName = $user -> lastName;
            return $this;
        }
    }

    public function chekLogin($userName,$password)
    {
    $stmt = $this->conn->prepare("SELECT id FROM user WHERE (username = :username or email - :username) and password =:password");
    $stmt -> execute(array('username' => $userName, 'password' => $password));
    $user = $stmt -> fetch(PDO::FETCH_LAZY);
    if (!empty($user)){
        $this->id = $user->id;
        $this->userName = $user->user_name;
        $this->email= $user->email;
        $this->firstName=$user->first_name;
        $this->lastName=$user->last_name;
        return $this;
    } else{
        return false;
        }
    }
}