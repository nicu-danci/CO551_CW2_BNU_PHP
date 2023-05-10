<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   require_once 'vendor/autoload.php';

   $faker = Faker\Factory::create();

   if (isset($_SESSION['id'])) {
      
      for ($i=0; $i<5; $i++) {
         $sql = "INSERT INTO student (studentid, password, firstname, lastname, dob, house, town, county, country, postcode)
         VALUES ('{$faker->randomNumber()}' , '{$faker->regexify('/[A-Z0-9]{10}/')}' , '{$faker->firstName()}' , '{$faker->lastName()}' , '{$faker->date()}' ,'{$faker->streetAddress()}' , 
         '{$faker->city()}' , '{$faker->state()}' , '{$faker->country()}' ,
          '{$faker->postcode()}')"; 

         $result = mysqli_query($conn,$sql);    
      }  

      header("Location: students.php");
      exit();
   }
?>
