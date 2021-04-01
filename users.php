<?php

class User{
    private $id;
    private $username;
    private $email;
    private $password;
    private $gender;
    private $country;

    /* constructor <-> destructor */

    /* I D */
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }

    /* U S E R N A M */
    public function setUsername($username)
    {
        /* a->z A->Z 0->9  between 6-12 */
        $userName = trim($username);
        if(preg_match('/^[a-zA-Z0-9]{6,12}$/', $userName))
        {
             $this->username = $username;  
             return true;
        }
        else
        {
            return false;
        }
    }
    public function getUsername()
    {
        return $this->username;
    }
    /* E M A I L */
    public function setEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
             $this->email = $email;
             return true;
        }
        else
        {
            return false;
        }
    }
    public function getEmail()
    {
        return $this->email;
    }
    /* P A S S W O R D */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getPassword()
    {
        return $this->password;
    }
    /* G E N D E R */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }
    public function getGender()
    {
        return $this->gender;
    }
    /* N A T I O N A L I T Y */
    public function setCountry($country)
    {
        $this->country = $country;
    }
    public function getCountry()
    {
        return $this->country;
    }

    public function register()
    {   
        include('database.php');
        /* CHECK FREE OR NOT */
        $select = 'SELECT u_name, u_email FROM users WHERE u_name = :uname OR u_email = :uemail';
        $command = $pdo->prepare($select);
        $command->execute([
            'uname'=>$this->getUsername(),
            'uemail'=>$this->getEmail()
        ]);
        /* STORE THE DATA */

        if($command->fetch(PDO::FETCH_ASSOC))
        {
            return false;
        }
        else
        {
            $query = 'INSERT INTO users (u_name, u_pass, u_email, u_gender, u_country, u_login) VALUES (:uname, :upass, :uemail, :ugender, :ucountry, :ulogin)';
            $command1 = $pdo->prepare($query);
            $command1->execute([
                'uname'=> $this->getUsername(),
                'upass'=> $this->getPassword(),
                'uemail'=> $this->getEmail(),
                'ugender'=> $this->getGender(),
                'ucountry'=> $this->getCountry(),
                'ulogin'=> 'offline'
            ]);
            return true;
        }
        /* D A T A B A S E destroy */
        $pdo = null;
    }

    public function login()
    {
        include('database.php');
        $query = "SELECT * FROM users WHERE u_name = :uname AND u_pass = :upass ";
        $command = $pdo->prepare($query);
        $command->execute([
            'uname'=>$this->getUsername(),
            'upass'=>$this->getPassword()
        ]);

        $row = $command->fetch(PDO::FETCH_ASSOC);
        if($row > 0)
        {
            $this->setId($row['id']);
            $this->setPassword($row['u_pass']);
            $this->setEmail($row['u_email']);
            $this->setGender($row['u_gender']);
            $this->setCountry($row['u_country']);

            $this->updateOnline($this->getUsername());
           
            return true;                  
        }
        else
        {
            return false;
        }
        /* D A T A B A S E destroy */
        $pdo = null;
    }


    public function updateOnline()
    {
        include('database.php');
        $queryUpdate = "UPDATE users SET u_login = 'online' WHERE u_name = :uname";
        $command = $pdo->prepare($queryUpdate);
        $command->execute([
        'uname'=>$this->getUsername()
        ]);
        $command->fetch();
        /* D A T A B A S E destroy */
        $pdo = null;
    }
    public function updateOffline($session)
    {
        include('database.php');
        $queryOffline = "UPDATE users SET u_login = 'offline' WHERE u_name = :uname";
        $command = $pdo->prepare($queryOffline);
        $command->execute([
        'uname'=>$session
        ]);
        $command->fetch();
        /* D A T A B A S E destroy */
        $pdo = null;
    }
}

?>