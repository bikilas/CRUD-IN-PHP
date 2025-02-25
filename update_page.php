<?php include("header.php"); ?>
<?php include("dbcon.php"); ?>

<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "SELECT * FROM students WHERE id ='$id'";
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die("Query Failed: " . mysqli_error($connection));
    } 
    else {
        $row = mysqli_fetch_assoc($result);
    }
}

if(isset($_POST['update_students'])) {
    if(isset($_GET['id_new'])) {
        $idnew = $_GET['id_new'];
    }

    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $age = $_POST['age'];

    // Handle image upload
    $image = $row['image']; // Keep existing image if not updated
    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
        $image = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    // Handle file upload
    $file = $row['file']; // Keep existing file if not updated
    if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
        $file = 'uploads/' . basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], $file);
    }

    $query = "UPDATE students SET first_name='$f_name', last_name='$l_name', age='$age', image='$image', file='$file' WHERE id='$idnew'";

    $result = mysqli_query($connection, $query);

    if(!$result) {
        die("Query Failed: " . mysqli_error($connection));
    } 
    else {
        header('Location: index.php?update_msg=You have successfully updated the data');
        exit();
    }
}
?>

<form action="update_page.php?id_new=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="f_name">First Name</label>
        <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>">
    </div>
    <div class="form-group">
        <label for="l_name">Last Name</label>
        <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']; ?>">
    </div>
    <div class="form-group">
        <label for="age">Age</label>
        <input type="text" name="age" class="form-control" value="<?php echo $row['age']; ?>">
    </div>
    <div class="form-group">
        <label for="image">Profile Image</label>
        <input type="file" name="image" class="form-control">
        <?php if($row['image']): ?>
            <p>Current Image: <img src="<?php echo $row['image']; ?>" width="100"></p>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="file">Upload File</label>
        <input type="file" name="file" class="form-control">
        <?php if($row['file']): ?>
            <p>Current File: <a href="<?php echo $row['file']; ?>" target="_blank">Download</a></p>
        <?php endif; ?>
    </div>
    <input type="submit" class="btn btn-success" name="update_students" value="Upload & Update">
</form>

<?php include("footer.php"); ?>
