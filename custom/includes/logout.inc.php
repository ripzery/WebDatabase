<?php 

// Start session

session_start(); 

// Include required functions file 

require_once('functions.inc.php'); 

// If not logged in, redirect to login screen 

// If logged in, unset session variable and display logged-out message 

// if (check_login_status() == false) { 

//  // Redirect to 
//  redirect('../login.html'); 

// } 
// else { 

 // Kill session variables 

 unset($_SESSION['logged_in']); 

 unset($_SESSION['username']); 

 unset($_SESSION['uid']);

 // Destroy session 

 session_destroy(); 

// } 

?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 

<head> 

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
 	<meta http-equiv="Content-type" content="text/html;charset=utf-8" /> 

 	<title>Creating a Simple PHP and MySQL-Based Login System - dev.thatspoppycock.com</title> 

 	<!-- Bootstrap Core CSS -->
    <link href="../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head> 

<body> 

	<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <img src="../../img/logo.png" style="width:100%;">
                    </div>
                    <div class="panel-body">
                        
                        <h4>Logged Out</h4> 

						<p>You have successfully logged out. Back to <a href="../login.html">login</a> screen.</p> 

                    </div>
                </div>
            </div>
        </div>
    </div>

</body> 

</html>