<?php
//connect ot server
if ($dbc = @mysqli_connect('localhost','root', ''))
{
    //select db
   if (@mysqli_select_db($dbc,'chatDB'))
    {
        if(isset($_POST['name']) && isset($_POST['message']))
        {
            //get the message and name from post request ajax , then insert it to messages table
            $Name = $_POST['name'];
            $Message = $_POST['message'];
      
           $q1 = "INSERT INTO messages (Name,Content) values ('$Name','$Message')";
            if(@mysqli_query($dbc,$q1))
                        {
                            echo "<b>".$Name . "</b>" . " > " . $Message ;
                        }
        }

        $result = array();
        //get the new id's and select from the table
            $start = isset($_GET['start']) ? intval($_GET['start']) : 0 ;
            $q2="SELECT * FROM messages WHERE ID > " . $start ;
            $r=mysqli_query($dbc,$q2);
            if($r){
             while($row=mysqli_fetch_array($r,MYSQLI_ASSOC))
             {
                 $result[]=$row;
             }
            }
            //then transform the result from a reagular array into a json form  
         echo json_encode($result), "\n";
      }
}
?>