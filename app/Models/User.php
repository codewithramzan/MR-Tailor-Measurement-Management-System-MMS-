<?php

class User extends Model
{

    public function login($username)
    {

        $query = $this->conn->prepare(

            "SELECT * FROM users WHERE username=?"

        );

        $query->execute([$username]);

        return $query->fetch(PDO::FETCH_ASSOC);

    }

}