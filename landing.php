<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Irish Grover' rel='stylesheet'>
</head>

<?php
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Set the target number
  $target_number = 10;

  // Check if the input number is equal to the target number
  if (isset($_POST['input_number']) && $_POST['input_number'] == $target_number) {
    // Redirect the user to a different page
    header('Location:http://localhost/SDP/');
    exit;
  }
}
?>

<body class= "landing-background">
    <div class ="main content">
        <div class="wrapper">
            <div class = "container2">
            <img src="http://localhost/SDP/images/landing/Pasta.jpg" alt="Pasta"  class="img1"/>
            <img src="http://localhost/SDP/images/landing/Taco.jpg" alt="Taco"  class="img1"/>
            <img src="http://localhost/SDP/images/landing/Ramen.jpg" alt="Ramen"  class="img1"/>
            <img src="http://localhost/SDP/images/landing/Burger.jpg" alt="Burger"  class="img1"/>
            <img src="http://localhost/SDP/images/landing/Curry.jpg" alt="Curry"  class="img1"/>
            <img src="http://localhost/SDP/images/landing/Pizza.jpg" alt="Pizza"  class="img1"/>
            <img src="http://localhost/SDP/images/landing/Fish.jpg" alt="Fish"  class="img1"/>

            </div>
            <div>
            <h1 class = "swiftService-text">SwiftService</h1>
            <?php
                if (isset($_POST['input_number']) && $_POST['input_number'] != $target_number) {
                    echo "<h1 class='fail text-center'>The establishment code entered is incorrect, please try again</h1>.";
                }
            ?>
            <h2 class="landing-text">Enter Establishment Code:</h2>

            <form method="POST" action="">
            <!-- <label class="landing-text" for="input_number">Enter Establishment Code:</label> -->
            <input type="number" class="landing-input" name="input_number" id="input_number" required> 
            <div style="text-align: center;">
            <br>
            <button class="landing-button" type="submit">Submit</button>
            <!-- <button class="landing-button">Submit</button> -->
            </form>
            </div>
            </div>



        </div>
    </div>


</body>
</html>