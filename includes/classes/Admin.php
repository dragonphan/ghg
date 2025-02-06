<?php

class Admin{
    private $con;
    private $admin;

    public function __construct($con, $ic){
        $this->con = $con;
        $adminDetailsQuery = mysqli_query($con,"SELECT * FROM 'admin' WHERE ic ='$ic'");
        $this->admin = mysqli_fetch_array($adminDetailsQuery);
    }

    public function getIc(){        
        return $this->admin['ic'];
    }
    public function getName(){        
        return $this->admin['name'];
    }

    public function getDob(){        

        $dob = $this->admin['dob'];
        // $formattedDate = date('Y-m-d', strtotime($dob));
        return $this->admin['dob'];
    }

    public function getGender(){        
        return $this->admin['gender'];
    }
    public function getRace(){        
        return $this->admin['race'];
    }
    public function getContact(){        
        return $this->admin['contact'];
    }
    public function getEmail(){        
        return $this->admin['email'];
    }
    public function getProfilePic(){
        return $this->admin['profile_pic'];
    }
    public function getPassword(){
        return $this->admin['password'];
    }
}

?>