<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['add_students'])){
    include('dbcon.php');

    if(!$connection){
        die("Database connection failed: " . mysqli_connect_error());
    }

    $f_name = trim($_POST['f_name']);
    $l_name = trim($_POST['l_name']);
    $age = (int) trim($_POST['age']);

    // Debugging: Check if data is being received
    if(empty($f_name) || empty($l_name) || empty($age)){
        die("All text fields are required! First name: $f_name, Last name: $l_name, Age: $age");
    }

    // File upload handling
    $upload_dir = 'uploads/';
    if(!is_dir($upload_dir)){
        if(!mkdir($upload_dir, 0777, true)){
            die("Failed to create upload directory");
        }
    }

    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = $upload_dir . basename($image);

    $file = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_path = $upload_dir . basename($file);

    // Debugging: Check if files are being uploaded
    if(empty($image) || empty($file)){
        die("Both image and file are required! Image: $image, File: $file");
    }

    // Move uploaded files
    if(!move_uploaded_file($image_tmp, $image_path)){
        die("Failed to move uploaded image: $image_tmp to $image_path");
    }

    if(!move_uploaded_file($file_tmp, $file_path)){
        die("Failed to move uploaded file: $file_tmp to $file_path");
    }

    // Debugging: Confirm file paths
    if(!file_exists($image_path)){
        die("Image file not found at $image_path");
    }

    if(!file_exists($file_path)){
        die("File not found at $file_path");
    }

    // Insert into database
    $query = "INSERT INTO students (first_name, last_name, age, image, file) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $query);

    if($stmt){
        mysqli_stmt_bind_param($stmt, 'ssiss', $f_name, $l_name, $age, $image_path, $file_path);
        $execute = mysqli_stmt_execute($stmt);

        if($execute){
            mysqli_stmt_close($stmt);
            mysqli_close($connection);
            header("Location: index.php?insert_msg=Your data has been added successfully");
            exit();
        } else {
            die("Query Failed: " . mysqli_error($connection));
        }
    } else {
        die("Preparation Failed: " . mysqli_error($connection));
    }
}
?>
