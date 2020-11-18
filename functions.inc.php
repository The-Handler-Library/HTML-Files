<?php
//functions called in signup.inc.php-------------------------------------------
function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat){
    $result;

    if(empty($name)|| empty($email)|| empty($username)|| empty($pwd)||empty($pwdRepeat)){
        $result = true;
        
    }
    else{
        $result = false;
    }
    return $result;
    
}
//checks input character validity-----------------------------------------------
function invaliduid($username){
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $result = true;
        
    }
    else{
        $result = false;
    }
    return $result;
}
//checks for proper email inpit-------------------------------------------------
function invalidemail($email){
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
        
    }
    else{
        $result = false;
    }
    return $result;
}
//checks password matching-------------------------------------------------------
function pwdMatch($pwd, $pwdRepeat){
    $result;
    if($pwd !== $pwdRepeat){
        $result = true;
        
    }
    else{
        $result = false;
    }
    return $result;
}
//username check within sql database/secures database with sql statement-----------
function uidExists($conn, $username, $email){
   $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
     header("location: signup.php?error=stmtfailed");   
     exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    
    $resultData = mysqli_stmt_get_result($stmt);
    
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}
//signs users up 
function createUser($conn, $name, $email, $username, $pwd){
   $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES(?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
     header("location: signup.php?error=stmtfailed");  
         exit();
    }
    //hashes password
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    
     mysqli_stmt_close($stmt);
     header("location: signup.php?error=none");   
    exit();
   
}
function emptyInputLogin($username, $pwd){
    $result;

    if(empty($username)|| empty($pwd)){
        $result = true;
        
    }
    else{
        $result = false;
    }
    return $result;
    
}

function loginUser($conn, $username, $pwd){
    $uidExists = uidExists($conn, $username, $username);
        
    if($uidExists === false){
        header("location: login.php?wronglogin");
        exit();
    }
    
    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);
    
    if($checkPwd === false){
        header("location: login.php?wronglogin");
        exit();
    }
    else if($checkPwd === true){
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        header("location: index.php?Welcome");
        exit();
    }
}

function userlist($conn, $username) {
    $sql = "SELECT usersId, usersName FROM users WHERE usersUid != ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
     header("location: signup.php?error=stmtfailed");   
     exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    
    $resultData = mysqli_stmt_get_result($stmt);
    return $resultData;
}