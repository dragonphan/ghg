<?php

class Student{
    private $con;
    private $student;

    public function __construct($con, $ic){
        $this->con = $con;
        $studentDetailsQuery = mysqli_query($con,"SELECT * FROM student WHERE ic ='$ic'");
        $this->student = mysqli_fetch_array($studentDetailsQuery);
    }

    public function getIc(){        
        return $this->student['ic'];
    }
    public function getName(){        
        return $this->student['name'];
    }

    public function getDob(){        

        $dob = $this->student['dob'];
        // $formattedDate = date('Y-m-d', strtotime($dob));
        return $this->student['dob'];
    }

    public function getGender(){        
        return $this->student['gender'];
    }
    public function getRace(){        
        return $this->student['race'];
    }
    public function getContact(){        
        return $this->student['contact'];
    }
    public function getEmergencyContact(){        
        return $this->student['emergency_contact'];
    }
    public function getEmail(){        
        return $this->student['email'];
    }
    public function getProfilePic(){
        return $this->student['profile_pic'];
    }
    public function getPassword(){
        return $this->student['password'];
    }
}

?>