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

       
//-------------------------------------------- Event Function --------------------------------------

        function event_register($eventName,$organizerName,$date,$time,$venue,$Description,$cost,$image,$s_id){

            $qry = "insert into eventdetails(eventName,organizerName,date,time,venue,Description,cost,image,epId) values(:eventName,:organizerName,:date,:time,:venue,:Description,:cost,:image,:epid)";

            $stmt = $this->con->prepare($qry);
            $stmt->bindParam(':eventName', $eventName);
            $stmt->bindParam(':organizerName', $organizerName);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':venue', $venue);
            $stmt->bindParam(':time', $time);
            $stmt->bindParam(':Description', $Description);
            $stmt->bindParam(':cost', $cost);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':epid', $s_id);

            $stmt->execute();
            $r = $stmt->rowCount();
            return $r;

        }
        function event_update($eventid,$eventName,$organizerName,$date,$time,$venue,$Description,$cost,$target_file,$s_id)
        {

            $qry = "UPDATE eventdetails set eventName= :b,OrganizerName= :c,date=:d , time =:e, venue= :f, Description=:g, cost=:h, Image =:i where eventId=:a";

            $stmt = $this->con->prepare($qry);
            $stmt->bindParam(":a", $eventid);
            $stmt->bindParam(":b", $eventName);
            $stmt->bindParam(":c", $organizerName);
            $stmt->bindParam(":d", $date);
            $stmt->bindParam(":e", $time);
            $stmt->bindParam(":f", $venue);
            $stmt->bindParam(":g", $Description);
            $stmt->bindParam(":h", $cost);
            $stmt->bindParam(":i", $target_file);

            $stmt->execute();
            $r = $stmt->rowCount();
            return $r;

        }

        public function fetch_event_info($id)
        {
            $query= "Select * from eventdetails where eventId=:id";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }


        function get_all_events(){
            $qry = "select * from eventdetails";
            $stmt = $this->con->prepare($qry);
            $stmt->execute();
            $r = $stmt->rowCount();
            // if($r!= 0)
            // {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            // }
            // else{
            //     return 0;
            // }
        }

        function get_events_by_id($id){
            $qry = "select * from eventdetails where epId = :id";
            $stmt = $this->con->prepare($qry);
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            $r = $stmt->rowCount();
            // if($r!= 0)
            // {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            // }
            // else{
            //     return 0;
            // }
        }

        function get_perticular_events($id){
            $qry = "select * from eventdetails where eventId = :eventId";
            $stmt = $this->con->prepare($qry);
            $stmt->bindParam(':eventId',$id);
            $stmt->execute();
            // if($r!= 0)
            // {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            // }
            // else{
            //     return 0;
            // }
        }

        function DeleteEvent($eventId){
            $qry = "DELETE FROM eventdetails WHERE eventId = :id";
            $stmt = $this->con->prepare($qry);

            $stmt->bindParam(':id',$eventId);
            $stmt->execute();
            $r = $stmt->rowCount();
            return $r;
        }



//----------------------------------User Functions--------------------------------------------------
       
        function student_register($s_id,$s_name,$gender,$department,$phonenumber,$email,$username,$password)
        {
            $qry = "insert into user_details(S_id,studentName,gender,department,phonenumber,email,username,password) values(:id,:name,:gender,:dept,:num,:email,:username,:pass)";

            $stmt = $this->con->prepare($qry);
       
            $stmt->bindParam(':id', $s_id);
            $stmt->bindParam(':name', $s_name);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':dept', $department);
            $stmt->bindParam(':num', $phonenumber);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':pass', $password);


            $stmt->execute();

        $r = $stmt->rowCount();
        return $r;
        }

        function validate_student($lusername,$lpassword)
        {
            $qry = "select * from user_details where username = :a && password = :b";
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

        function validate_username($lusername)
        {
            $qry = "select * from user_details where username = :a";
            $stmt = $this->con->prepare($qry);
            $stmt->bindParam(':a',$lusername);
            $stmt->execute();
            $r = $stmt->rowCount();
            if($r != 0){  
                return 0;
            }else{
                return 1;
            }
        }
        function validate_mail($mail)
        {
            $qry = "select * from user_details where email = :a";
            $stmt = $this->con->prepare($qry);
            $stmt->bindParam(':a',$mail);
            $stmt->execute();
            $r = $stmt->rowCount();
            if($r != 0){  
                return 0;
            }else{
                return 1;
            }
        }


        public function fetchOne($id){
            $query = "SELECT * FROM user_details WHERE id = :id";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':id' , $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        public function fetchPlanner($id)
        {
            $query = "SELECT * FROM eventplannerdetails WHERE eventPlannerId = :id";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':id' , $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        

        function get_all_user(){
            $qry = "select * from user_details";
            $stmt = $this->con->prepare($qry);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);       
            return $result;
            
          
        }
        function get_all_eventPlanner(){
            $qry = "select * from eventplannerdetails";
            $stmt = $this->con->prepare($qry);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);       
            return $result;
            
          
        }

        function get_user_data($sid){
            $qry = "select * from user_details where id = :sid";
            $stmt = $this->con->prepare($qry);

            $stmt->bindParam(':sid',$sid);
            $stmt->execute();
            $r = $stmt->rowCount();            
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

        function DeleteAttendee($userid){
            $qry = "DELETE FROM user_details WHERE id = :id";
            $stmt = $this->con->prepare($qry);

            $stmt->bindParam(':id',$userid);
            $stmt->execute();
            $r = $stmt->rowCount();
            return $r;
        }
        
        public function fetch_info($id)
        {
            $query= "Select * from user_details where id=:id";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
       
        public function fetch_eventPlanner_info($id)
        {
            $query= "Select * from eventplannerdetails where eventPlannerId=:id";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    public function updateStudentInfo($id,$s_id,$s_name,$gender,$department,$phonenumber,$email,$username,$password)
    {
 
        $qry= "UPDATE user_details set S_id = :s_id, studentName = :s_name,gender = :gen,department =:dept, phonenumber = :phnum, email =:email, username = :unm, password =:pass where id = :id ";
        $stmt = $this->con->prepare($qry);

        $stmt->bindParam(':s_id', $s_id);
        $stmt->bindParam(':s_name', $s_name);
        $stmt->bindParam(':gen', $gender);
        $stmt->bindParam(':dept', $department);
        $stmt->bindParam(':phnum', $phonenumber);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':unm', $username);
        $stmt->bindParam(':pass', $password);
        $stmt->bindParam(':id', $id);
        
        
        $stmt->execute();

        $r = $stmt->rowCount();
        return $r;
    }

    
    public function userfeedback($name,$mail,$feedback)
        {
            $qry = "insert into feedback(name,email,comment) values(:a,:b,:c)";
            $stmt = $this->con->prepare($qry);
            
            $stmt->bindParam(':a', $name);
            $stmt->bindParam(':b', $mail);
            $stmt->bindParam(':c', $feedback);
            $stmt->execute();
            $r = $stmt->rowCount();
            return $r;
        }


    //----------------------------------Event Planner Functions-------------------------------------

    function event_planner_register($ep_id,$ep_name,$gender,$department,$phonenumber,$email,$username,$password)
        {
            $qry = "insert into eventplannerdetails(studentId,name,gender,department,phonenumber,email,username,password) values(:id,:name,:gender,:dept,:num,:email,:username,:pass)";

            $stmt = $this->con->prepare($qry);
       
            $stmt->bindParam(':id', $ep_id);
            $stmt->bindParam(':name', $ep_name);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':dept', $department);
            $stmt->bindParam(':num', $phonenumber);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':pass', $password);


            $stmt->execute();

        $r = $stmt->rowCount();
        return $r;
        }

        function validate_event_planner($username,$password){
            $qry = "select * from eventplannerdetails where username = :a AND password = :b";
            $stmt = $this->con->prepare($qry);

            $stmt->bindParam(':a',$username);
            $stmt->bindParam(':b',$password);
            $stmt->execute();
            $r = $stmt->rowCount();
            if($r != 0)
            {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);       
                return $result;
            }
            else
            {
                return 0;
            }
        }

        function validate_epusername($username)
        {
            $qry = "select * from user_details where username = :a";
            $stmt = $this->con->prepare($qry);
            $stmt->bindParam(':a',$username);
            $stmt->execute();
            $r = $stmt->rowCount();
            if($r != 0){  
                return 0;
            }else{
                return 1;
            }
        }

        public function updateEventPlannerInfo($id,$ep_id,$ep_name,$gender,$department,$phonenumber,$email,$username,$password)
    {
 
        $qry= "UPDATE eventplannerdetails set studentId = :ep_id, name = :ep_name , gender = :gen,department =:dept, phonenumber = :phnum, email =:email, username = :unm, password =:pass where eventPlannerId = :epid ";
        $stmt = $this->con->prepare($qry);

        $stmt->bindParam(':ep_id', $ep_id);
        $stmt->bindParam(':ep_name', $ep_name);
        $stmt->bindParam(':gen', $gender);
        $stmt->bindParam(':dept', $department);
        $stmt->bindParam(':phnum', $phonenumber);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':unm', $username);
        $stmt->bindParam(':pass', $password);
        $stmt->bindParam(':epid', $id);
        
        
        $stmt->execute();

        $r = $stmt->rowCount();
        return $r;
    }

        public function fetch_epinfo($id)
        {
            $query= "Select * from eventplannerdetails where eventPlannerId=:id";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        function DeleteEventPlanner($plannerId){
            $qry = "DELETE FROM eventplannerdetails WHERE eventPlannerId = :id";
            $stmt = $this->con->prepare($qry);

            $stmt->bindParam(':id',$plannerId);
            $stmt->execute();
            $r = $stmt->rowCount();
            return $r;
        }



//------------------------------------------Traction functions--------------------------------------

        function save_payment_details($paymentIntentId,$amount,$sid,$eid){
            $qry = "insert into paymentdetails(paymentIntentId,amount,sId,eId) values(:paymentIntentId,:amount,:sid,:eid)";

            $stmt = $this->con->prepare($qry);

            $stmt->bindParam(":paymentIntentId",$paymentIntentId);
            $stmt->bindParam(":amount",$amount);
            $stmt->bindParam(":sid",$sid);
            $stmt->bindParam(":eid",$eid);

            $stmt->execute();
            $r = $stmt->rowCount();
            return $r;
        }


        function ifRegistered($sid , $eid)
        {
            $qry = "select * from paymentdetails where sId = :a AND eId = :b";
            $stmt = $this->con->prepare($qry);
            $stmt->bindParam(':a',$sid);
            $stmt->bindParam(':b',$eid);
            $stmt->execute();
            $r = $stmt->rowCount();
            if($r != 0){  
                return 1;
            }else{
                return 0;
            }
        }
        //-----------------------------------admin fun-----------------------------

    function totUsers()
    {
        $qry = "select count(*) as total_users from  user_details";
        $stmt = $this->con->query($qry);
        
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total_users'];
    }

    function totEvents()
    {
        $qry = "select count(*) as total_users from  eventdetails";
        $stmt = $this->con->query($qry);
        
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total_users'];
    }

    function totPlanner()
    {
        $qry = "select count(*) as total_users from  eventplannerdetails";
        $stmt = $this->con->query($qry);
        
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total_users'];
    }

    function bill($eventId)
    {
        $qry = "select cost as price from  eventdetails";
        $stmt = $this->con->query($qry);
        
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['price'];
    }
    }

?>