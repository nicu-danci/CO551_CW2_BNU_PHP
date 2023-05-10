<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

  echo template("templates/partials/header.php");
  echo template("templates/partials/nav.php");

  // if the form has been submitted
  if (isset($_POST['submit'])) {

    // validate uploaded file
    $allowed_extensions = array('jpg', 'jpeg', 'png');
    $filename = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $filesize = $_FILES['image']['size'];

    //maxim size of uploaded file 5 MB in bytes
    $max_filesize = 5000000;

    if (!in_array($extension, $allowed_extensions)) {
      $data['content'] = '<div class="alert alert-danger mt-5 mb-3" role="alert" >Invalid file type. Please upload a JPG, JPEG or PNG file.</div>
      <button class="btn btn-primary mb-5" onclick="history.back()">Back</button>';
    } elseif ($filesize > $max_filesize) {
      $data['content'] = '<div class="alert alert-danger mt-5 mb-3" role="alert" >File size too large. Maximum file size is 5 MB.</div>
      <button class="btn btn-primary mb-5" onclick="history.back()">Back</button>';
    } else {
      // move uploaded file to 'uploads' directory
      move_uploaded_file($tempname, 'uploads/' . $filename);

      $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      // Check if all required fields are provided
      if (
        !empty($_POST['studentid']) && !empty($_POST['password']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['dob'])
        && !empty($_POST['house']) && !empty($_POST['town']) && !empty($_POST['county']) && !empty($_POST['country']) && !empty($_POST['postcode'])
      ) {


        // Prepare the SQL statement
        $sql = "INSERT INTO student (studentid, password, firstname, lastname, dob, house, town, county, country, postcode, image_filename)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        // Bind the parameters to the statement
        mysqli_stmt_bind_param($stmt, "sssssssssss", $_POST['studentid'], $hashed_password, $_POST['firstname'], $_POST['lastname'],
         $_POST['dob'], $_POST['house'], $_POST['town'], $_POST['county'], $_POST['country'], $_POST['postcode'], $filename);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
          $data['content'] = '<div class="alert alert-success mt-5 mb-3" role="alert">Student added successfully.</div>';
        } else {
          $data['content'] = '<div class="alert alert-danger mt-5 mb-3" role="alert">All fields are required!</div>';
        }

        // Close the statement and database connection
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
      }

    }

  } else {


    // using <<<EOD notation to allow building of a multi-line string
    // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
    // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
    $data['content'] = <<<EOD

   <h2 class="fs-3 mt-5 mb-5">Add New Student</h2>


   <form  name="frmdetails" action="" method="post" enctype="multipart/form-data">

   <div class="mb-3">
    <label for="studentid" class="form-label">Student ID</label>
    <input type="text" class="form-control" id="studentid" value="" name="studentid" />
   </div>

   <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" value="" name="password" />
  </div>

  <div class="mb-3">
    <label for="firstname" class="form-label">First Name</label>
    <input type="text" class="form-control" id="firstname" value="" name="firstname" />
  </div>

  <div class="mb-3">
    <label for="lastname" class="form-label">Last Name</label>
    <input type="text" class="form-control" id="lastname" value="" name="lastname" />
  </div>

  <div class="mb-3">
    <label for="dob" class="form-label">Date of Birth</label>
    <input type="date" class="form-control" id="dob" value="" name="dob" />
  </div>

  <div class="mb-3">
    <label for="house" class="form-label">Address</label>
    <input type="text" class="form-control" id="house" value="" name="house" />
  </div>

  <div class="mb-3">
    <label for="town" class="form-label">Town</label>
    <input type="text" class="form-control" id="town" value="" name="town" />
  </div>

  <div class="mb-3">
    <label for="county" class="form-label">County</label>
    <input type="text" class="form-control" id="county" value="" name="county" />
  </div>
  
  <div class="mb-3">
    <label for="country" class="form-label">Country</label>
    <input type="text" class="form-control" id="country" value="" name="country" />
  </div>

  <div class="mb-3">
    <label for="postcode" class="form-label">Post Code</label>
    <input type="postcode" class="form-control" id="postcode" value="" name="postcode" />
  </div>

  <div class="mb-3">
    <label for="image" class="form-label">Upload Image</label>
    <input type="file" class="form-control" id="image" name="image" />
  </div>

  <input type="submit" class="btn btn-primary" value="Save" name="submit"/>
  
</form>
EOD;

  }

  // render the template
  echo template("templates/default.php", $data);

} else {
  header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>