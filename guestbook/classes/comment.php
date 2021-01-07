<?php
class Comment extends DB

{
    public $id;
    public $userid;
    public $comment;
    public $createAt;

    public function save ()
    {
        $stmt = $this -> conn->prepare("INSERT INFO comments('user_id','comment') VALUES(:user_id, :comment)");
        $stmt -> execute(array('user_id' => $this ->userid, 'comment' => $this ->comment));
        $this->id = $this->conn->lastInsertId();
        return $this->id;

    }

    public function findAll()
    {
        $stmt = $this ->conn->prepare("SELECT * FROM connects ORDER BY id DESC");
        $stmt -> execute();
        $comments = [];
        while ($row = $stmt-> fetch(PDO::FETCH_LAZY))
        {
            $comments[]= ["id" => $row->id, 'user_id' => $row -> user_id, 'comment' => $row -> commene, 'created_at' => $row -> created_at];
        }
        return $comments;

    }
}