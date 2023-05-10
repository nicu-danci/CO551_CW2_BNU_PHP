<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in.
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // check if the form has been submitted.
   if (isset($_POST['submit'])) {
      // Update data in database
      $sql = "UPDATE student SET firstname=?, lastname=?, dob=?, house=?, town=?, county=?, country=?, postcode=? WHERE studentid=?";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "ssssssssi", $_POST['txtfirstname'], $_POST['txtlastname'], $_POST['txtdob'], $_POST['txthouse'], $_POST['txttown'], $_POST['txtcounty'], $_POST['txtcountry'], $_POST['txtpostcode'], $_SESSION['id']);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
   
      $data['content'] = '<div class="alert alert-success mt-5" role="alert">Details updated successfully!</div>';
   }
  
   else {
      // Build a SQL statment to return the student record with the id that
      // matches that of the session variable.
      $sql = "SELECT * FROM student WHERE studentid='". $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result);

      // using <<<EOD notation to allow building of a multi-line string
      // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
      $data['content'] = <<<EOD

   <h2 class="fs-3 mt-5 mb-5">My Details</h2>

   <form name="frmdetails" action="" method="post">

   <div class="mb-3">
    <label for="txtstudentid"" class="form-label">Student ID</label>
    <input type="text" class="form-control" id="studentid" value="{$row['studentid']}" name="studentid" disabled readonly >
   </div>

   <div class="mb-3">
    <label for="txtfirstname" class="form-label">First Name</label>
    <input type="text" class="form-control" id="firstnametxt" value="{$row['firstname']}" name="txtfirstname" />
   </div>

   <div class="mb-3">
    <label for="txtlastname" class="form-label">Last Name</label>
    <input type="text" class="form-control" id="lastname" value="{$row['lastname']}" name="txtlastname" />
   </div>

   <div class="mb-3">
    <label for="txtdob" class="form-label">Date of Birth</label>
    <input type="date" class="form-control" id="dob" value="{$row['dob']}" name="txtdob">
   </div>

   <div class="mb-3">
    <label for="txthouse" class="form-label">Address</label>
    <input type="text" class="form-control" id="house" value="{$row['house']}" name="txthouse">
   </div>

   <div class="mb-3">
    <label for="txttown" class="form-label">Town</label>
    <input type="text" class="form-control" id="town" value="{$row['town']}" name="txttown">
   </div>

   <div class="mb-3">
    <label for="txtcounty" class="form-label">County</label>
    <input type="text" class="form-control" id="county" value="{$row['county']}" name="txtcounty">
   </div>

   <div class="mb-3">
    <label for="txtcountry" class="form-label">Country</label>
    <input type="text" class="form-control" id="country" value="{$row['country']}" name="txtcountry">
   </div>

   <div class="mb-3">
    <label for="txtpostcode" class="form-label">Post Code</label>
    <input type="text" class="form-control" id="postcode" value="{$row['postcode']}" name="txtpostcode">
   </div>
   
   <div class="mb-3">
    <input type="submit" class="btn btn-primary" value="Update" name="submit" />
   </div>

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
