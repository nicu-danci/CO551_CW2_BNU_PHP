<?php
   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   // check logged in
   if (isset($_SESSION['id'])) {

      // check if delete button is clicked and students array is not empty
      if (isset($_POST['deletebtn']) && !empty($_POST['students'])) {
         echo "<form action='deletestudents.php' method='post' onsubmit=\"return confirm('Do you really want to delete the selected students?');\">";
         
         


         $stmt = mysqli_prepare($conn, "DELETE FROM student WHERE studentid = ?");
foreach ($_POST['students'] as $student) {
    mysqli_stmt_bind_param($stmt, "s", $student);
    mysqli_stmt_execute($stmt);
}
mysqli_stmt_close($stmt);


         header("Location: students.php");
      } else {
         echo template("templates/partials/header.php");
         echo template("templates/partials/nav.php");
         echo '<h2 class="fs-3 mt-5 mb-5">No students selected</h2>'; 
         echo "<button class='btn btn-primary mt-5' onclick='history.back()'>Back to student list</button>";
      }

   } else {
      header("Location: index.php");
   }
?>
