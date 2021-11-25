Jai Hind..

// Vulnerability has been removed from the code..


//index.php

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <title>Secure Coding</title>
  </head>
  <body>
  <div class="container py-2">
    <div class="jumbotron">
      <h1>Login</h1>
      <form  method="POST" action="index.php">
        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" name="username" placeholder="Enter Username">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" name="password" placeholder="Enter Password">
        </div>
        <div class="form-group">
          <button class="btn btn-success" type="submit">Login</button>
        </div>
      </form>
    </div>
  </div>
  <?php
    include "connection.php";
    session_start();

    if(isset($_POST['username']) && isset($_POST['password']))
    {
      $uname = $_POST['username'];
      $password = $_POST['password'];
      $uname = filter_var($uname, FILTER_SANITIZE_STRING);
      $password = filter_var($password, FILTER_SANITIZE_STRING);
      
      $query=mysqli_query($connection,"SELECT * FROM users WHERE username ='$uname' AND password ='$password'") or die("Query Unsuccessfull:".mysqli_error($connection));

      if($query_run)
      {
        echo "Login Successfull";
      }

      $num_rows=mysqli_num_rows($query);
      $row=mysqli_fetch_array($query);

      if($num_rows > 0)
      {
        $_SESSION["id"]=$row['id'];
        header("Location: profile.php?id=".$_SESSION["id"]);
      }
    }
  ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </body>
</html>



//profile.php

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <title>Secure Coding</title>
  </head>
  <?php include 'connection.php';
    session_start();
    $id=$_SESSION['id'];
    $query=mysqli_query($connection,"SELECT * FROM users where id='$id'")or die(mysqli_error($connection));
    $row=mysqli_fetch_array($query);
  ?>
<body>
<div class="container py-2">
    <div class="jumbotron">
        <h1>User Profile</h1>
        <form method="POST" action="profile.php" >
            <div class="form-group">
                <label>Username:</label>
                <input type="text" class="form-control" name="username" value="<?php echo $row['username']; ?>"/>
            <div>
            <div class="form-group">
                <label>Email:</label>
                <input type="text" class="form-control" name="email" value="<?php echo $row['email']; ?>" />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success" name="submit">Update</button>
                <button name="logout" class="btn btn-danger">Log out</button>
            </div>
        </form>
    <div>
<div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
      <?php
        if(isset($_POST['submit']))
        {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $query = "UPDATE users SET username = '$username', email = '$email' WHERE id = '$id'";
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
            header("Location: index.php");
        }  
        if(isset($_POST['logout']))
        {
            unset($_SESSION['id']);
            session_destroy();
            header("Location: index.php");
        }            
?>
              
      //connection.php        
<?php
    $dbuser = "root";
    $dbpass = "";
    $dbname = "secure_coding";
    $host = "localhost";
    error_reporting(0);
    $connection = mysqli_connect($host, $dbuser, $dbpass, $dbname) or die("Connection Failed: ".mysqli_connect_errno());
?>
              
              
              //secure_coding.sql
              
              -- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2021 at 02:13 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `secure_coding`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin'),
(3, 'user', 'user@gmail.com', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
