<?php
    $con = new mysqli("localhost","root","","vue_crud");
    if($con->connect_error){
        die("error".$con->connect_error);
    }
    $result = array('error'=>false);
    $action='';

    if(isset($_GET['action'])){
        $action=$_GET['action'];
    }

    if($action == 'read'){
        $sql = $con->query("SELECT * FROM users");
        $users=array();
        while($row = $sql->fetch_assoc()){
            array_push($users, $row);
        }
        $result['users'] = $users;
    }

    if($action == 'create'){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $sql = $con->query("INSERT INTO users (name, email, phone) VALUES ('$name', '$email', '$phone')");
        if($sql){
            $result['message'] ="User added successfully";
        }
        else{
            $result['error']=true;
            $result['message'] ="Error while adding user";
        }
    }
    if($action == 'update'){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $sql = $con->query("UPDATE users SET name='$name',email='$email',phone='$phone' where id='$id'");
        if($sql){
            $result['message'] ="User updated successfully";
        }
        else{
            $result['error']=true;
            $result['message'] ="Error while updating user";
        }
    }

    if($action == 'update'){
        $id = $_POST['id'];
        
        $sql = $con->query("DELETE FROM users where id='$id'");
        if($sql){
            $result['message'] ="User deleted successfully";
        }
        else{
            $result['error']=true;
            $result['message'] ="Error while deleting user";
        }
    }

    $con->close();
    echo json_encode($result);
?>