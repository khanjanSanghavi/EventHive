<?php
    class db{
        var $con;
        var $login = false;
        function __construct(){
            try{
                $this->con = new PDO('mysql:host=localhost; dbname=projecteventdb' , 'root' , '');
                $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        
        function student_register($s_id,$s_name,$gender,$department,$phonenumber,$email,$username,$password)
        {
            $qry = "insert into student(s_id,s_name,gender,department,phonenumber,email,username,password) values(:a,:b,:h,:c,:d,:e,:f,:g)";

            $stmt = $this->con->prepare($qry);
       
            $stmt->bindParam(':a', $s_id);
            $stmt->bindParam(':b', $s_name);
            $stmt->bindParam(':h', $gender);
            $stmt->bindParam(':c', $department);
            $stmt->bindParam(':d', $phonenumber);
            $stmt->bindParam(':e', $email);
            $stmt->bindParam(':f', $username);
            $stmt->bindParam(':g', $password);

            $stmt->execute();

        $r = $stmt->rowCount();
        return $r;
        }

        function validate_student($lusername,$lpassword)
        {
            $qry = "select * from student where username = :a && password = :b";
            $stmt = $this->con->prepare($qry);

            $stmt->bindParam(':a',$lusername);
            $stmt->bindParam(':b',$lpassword);
            $stmt->execute();
            $r = $stmt->rowCount();
            
            //print_r($r);
            if($r != 0)
            {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);       
                return $result;
            }
            else
            {
                $r = 0;
                return 0;
            }
        }

    }
        ?>