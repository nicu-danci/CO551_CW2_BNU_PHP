<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   // check logged in
   if (isset($_SESSION['id'])) {

      echo template("templates/partials/header.php");
      echo template("templates/partials/nav.php");

      // Build SQL statment that selects a student's modules
      $sql = "SELECT * FROM student";

      $result = mysqli_query($conn,$sql);

      $data['content'] .= "<form action='deletestudents.php'  method='POST' onsubmit=\"return confirm('Do you really want to delete the selected students?');\">";
      // prepare page content
      $data['content'] .= "<table class='table  table-hover mt-5'>";
      $data['content'] .= "<tr class='table-dark'><th>Student ID</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th>
                           <th>Address</th><th>City</th><th>County</th><th>Country</th><th>Post Code</th><th>Photo</th></tr>";

      // Display the modules within the html table
      while($row = mysqli_fetch_array($result)) {
         $data['content'] .= "<tr>";
         $data['content'] .= "<td> {$row["studentid"]} </td>";
         $data['content'] .= "<td> {$row["firstname"]} </td>";
         $data['content'] .= "<td> {$row["lastname"]} </td>";
         $data['content'] .= "<td> {$row["dob"]} </td>";
         $data['content'] .= "<td> {$row["house"]} </td>";
         $data['content'] .= "<td> {$row["town"]} </td>";
         $data['content'] .= "<td> {$row["county"]} </td>";
         $data['content'] .= "<td> {$row["country"]} </td>";
         $data['content'] .= "<td> {$row["postcode"]} </td>";

         $imageFileName = $row["image_filename"];
         $imageSrc = "uploads/" . $imageFileName;
         $data['content'] .= "<td><img src='{$imageSrc}' alt='Student Image' height='100' width='100'></td>";

         $data['content'] .= "<td> <input type='checkbox' name='students[]' value='{$row["studentid"]}' </td>";
         $data['content'] .= "</tr>";
      }

      $data['content'] .= "</table>";
      $data['content'] .= "<input type='submit'  class='btn btn-primary' name='deletebtn' value='Delete'/>";
      $data['content'] .= "</form>";

      // render the template
      echo template("templates/default.php", $data);

   } else {
      header("Location: index.php");
   }

   echo template("templates/partials/footer.php");

?>

