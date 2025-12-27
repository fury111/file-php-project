<?php

if(session_status() === PHP_SESSION_NONE){
       session_start();
}
//to make sure that the user is logged in 
function isLoggedIn(){
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function isAdmin(){
    return isLoggedIn() && isset($_SESSION['role']) && $_SESSION['role']==='admin';
}

function getCurrentUser(){
    if(!isLoggedIn()){
        return null;
    }

    return [
        'user_id'=> $_SESSION['user_id'],
        'first_name'=> $_SESSION['first_name'],
        'last_name'=> $_SESSION['last_name'],
        'email'=> $_SESSION['email'],
        'location'=> $_SESSION['location'] ?? '',
        'role'=> $_SESSION['role']
    ];
}

function getFullName(){
    if(!isLoggedIn()){
        return '';
    }

    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];

    return trim($first_name.' '.$last_name);

}


function login($user_id,$first_name,$last_name,$email,$location='',$role='user'){
    $_SESSION['user_id'] = $user_id;
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['email'] = $email;
    $_SESSION['location'] = $location;
    $_SESSION['role'] = $role;
    $_SESSION['login_time'] = time();
}




function logout(){

    $_SESSION =array(); //Delete all data in the session
    
    if(isset($_COOKIE[session_name()])){ //session name بترجع اسم ال cookie 
        setcookie(session_name(),'',time()-3600,'/');
    }

    session_destroy(); // delete it completly from the server 
}

function requireLogin ($redirectURL='public/login.php'){
    if(!isLoggedIn()){
        header("Location: $redirectURL");
        exit();
    }
}


function requireAdmin($redirectURL='public/index.php'){
    if(!isAdmin()){
        header("Location: $redirectURL");
        exit();
    }
}




?>