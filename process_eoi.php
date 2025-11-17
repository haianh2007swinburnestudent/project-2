<?php
/*  PREVENT DIRECT ACCESS BY URL */

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: apply.php");
    exit();
}

require_once("settings.php");

/* Clean the data */

function clean_input($data) {
    $data = trim($data);            // remove leading/trailing spaces
    $data = stripslashes($data);    // remove backslashes
    $data = htmlspecialchars($data); // remove HTML special chars
    return $data;
}


/* Receive the data */
$jobref = clean_input($_POST["jobref"]);
$firstname = clean_input($_POST["firstname"]);
$lastname = clean_input($_POST["lastname"]);
$dob = clean_input($_POST["dob"]);
$gender = clean_input($_POST["gender"]);
$street = clean_input($_POST["street"]);
$suburb = clean_input($_POST["suburb"]);
$state = clean_input($_POST["state"]);
$postcode = clean_input($_POST["postcode"]);
$email = clean_input($_POST["email"]);
$phone = clean_input($_POST["phone"]);

/* Checkbox values */
$skill1 = isset($_POST["skill1"]) ? clean_input($_POST["skill1"]) : null;
$skill2 = isset($_POST["skill2"]) ? clean_input($_POST["skill2"]) : null;
$skill3 = isset($_POST["skill3"]) ? clean_input($_POST["skill3"]) : null;
$skill4 = isset($_POST["skill4"]) ? clean_input($_POST["skill4"]) : null;
$skill5 = isset($_POST["skill5"]) ? clean_input($_POST["skill5"]) : null;

/* Receive other skills */
$otherskills = isset($_POST['otherskills']) ? trim($_POST['otherskills']) : "";

/* Server-Side Validation */
$errors = [];


/* Job Reference number */
if (empty($jobref)) {
    $errors[] = "Job Reference number cannot be empty.";
}

/* First name */
if (!preg_match("/^[A-Za-z]{1,20}$/", $firstname)) {
    $errors[] = "First name must be alphabetic and max 20 characters.";
}

/* Last name */
if (!preg_match("/^[A-Za-z]{1,20}$/", $lastname)) {
    $errors[] = "Last name must be alphabetic and max 20 characters.";
}



/* Gender */
if (empty($gender)) {
    $errors[] = "Gender selection is required.";
}

/* Street */ 
if (strlen($street) > 40) {
    $errors[] = "Street address must be max 40 characters.";
}
/* Suburb */
if (strlen($suburb) > 40) {
    $errors[] = "Suburb must be max 40 characters.";
}

/* State */
$valid_states = ["VIC","NSW","QLD","NT","WA","SA","TAS","ACT"];
if (!in_array($state, $valid_states)) {
    $errors[] = "Invalid state selected.";
}

/* Postcode: 4 digits */
if (!preg_match("/^[0-9]{4}$/", $postcode)) {
    $errors[] = "Postcode must be exactly 4 digits.";
}

/* Email */
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}

/* Phone */
if (!preg_match("/^[0-9 ]{8,12}$/", $phone)) {
    $errors[] = "Phone number must be 8–12 digits or spaces only.";
}


/* Skill and Other skills rule */
if (($skill1 || $skill2 || $skill3 || $skill4 || $skill5) && empty($otherskills)) {
    $errors[] = "If any skill is selected, OTHER SKILLS must not be empty.";
}

/* 6. Display errors if validation fails */
if (count($errors) > 0) {
    echo "<h2>Validation Errors:</h2><ul>";
    foreach ($errors as $err) {
        echo "<li>$err</li>";
    }
    echo "</ul>";
    echo "<a href='apply.php'>Return to the apply form</a>";
    exit();
}
/* Insert the validated data into the EOI table*/
$sql = "
INSERT INTO eoi (
    job_ref_number, firstname, lastname, dob, gender, street, suburb, state, postcode,
    email, phone, skill1, skill2, skill3, skill4, skill5, other_skills
) VALUES (
    '$jobref', '$firstname', '$lastname', '$dob', '$gender', '$street', '$suburb', '$state', '$postcode',
    '$email', '$phone', '$skill1', '$skill2', '$skill3', '$skill4', '$skill5', '$otherskills')";

    if (mysqli_query($conn, $sql)) {
    $last_id = mysqli_insert_id($conn);
    echo "<h2>Application Submitted Successfully!</h2>";
    echo "<p>Your EOI Number is: <strong>$last_id</strong></p>";
} else {
    echo "SQL Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
