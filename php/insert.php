<?php
$_username = $_POST['username']
$_password = $_POST['password']

if (!empty($username) || !empty($password)){
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "borrowbook";

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname)
    
    if(mysqli_connect_error()){
        die('Connect Error(' . myssqli_connect_error().')'. mysqli_connect_error());

    } else{
        $SELECT = "SELECT email from register Where email = ? Limit 1";
        $INSERT = "INSERT Into register ( username , password) values(?,?) "

        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if($rnum==0){
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_parem("is", $username, $password);
            $stmt->execute();
            echo "New Record Inserted Succesfully";
        } else{
            echo "Someone already Register using this email"
        }
        $stmt->close();
        $conn->close();
    }
    

} else{
    echo "all field are required";
    die();
}
?>