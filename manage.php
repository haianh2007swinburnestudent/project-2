<?php
session_start();
require_once("settings.php");



function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

include_once("header.inc");
include_once("nav.inc");


$action = isset($_POST["action"]) ? clean_input($_POST["action"]) : "";

echo "<h1>Manage EOIs</h1>";


?>


<h2>List of all EOIs</h2>
<form method="post">
    <input type="hidden" name="action" value="list_all">
    <label>Sort by:</label>
    <select name="sortfield">
        <option value="EOInumber">EOInumber</option>
        <option value="firstname">First Name</option>
        <option value="lastname">Last Name</option>
        <option value="job_ref_number">Job Ref</option>
        <option value="status">Status</option>
    </select>
    <input type="submit" value="Show All">
</form>


<h2>Search EOIs by Job Reference</h2>
<form method="post">
    <input type="hidden" name="action" value="search_jobref">
    Job Reference: <input type="text" name="jobref">
    <input type="submit" value="Search">
</form>

<h2>Search EOIs by Applicant</h2>
<form method="post">
    <input type="hidden" name="action" value="search_name">
    First Name: <input type="text" name="firstname">
    Last Name: <input type="text" name="lastname">
    <input type="submit" value="Search">
</form>


<h2>Delete EOIs for a Job Reference</h2>
<form method="post">
    <input type="hidden" name="action" value="delete_jobref">
    Job Reference: <input type="text" name="jobref">
    <input type="submit" value="Delete">
</form>


<h2>Update EOI Status</h2>
<form method="post">
    <input type="hidden" name="action" value="update_status">
    EOI Number: <input type="number" name="eoi">
    New Status:
    <select name="status">
        <option value="New">New</option>
        <option value="Current">Current</option>
        <option value="Final">Final</option>
    </select>
    <input type="submit" value="Update">
</form>

<hr>

<?php


function display_table($result) {
    if (mysqli_num_rows($result) == 0) {
        echo "<p>No records found.</p>";
        return;
    }

    echo "<table border='1'>";

    // Header
    echo "<tr>";
    while ($fieldinfo = mysqli_fetch_field($result)) {
        echo "<th>" . $fieldinfo->name . "</th>";
    }
    echo "</tr>";

    // Rows
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
}



if ($action == "list_all") {

    $sort = clean_input($_POST["sortfield"]);
    $valid_sorts = ["EOInumber","firstname","lastname","job_ref_number","status"];
    if (!in_array($sort, $valid_sorts)) $sort = "EOInumber";

    $sql = "SELECT * FROM eoi ORDER BY $sort";
    $result = mysqli_query($conn, $sql);

    echo "<h2>All EOIs</h2>";
    display_table($result);
}

else if ($action == "search_jobref") {

    $jobref = clean_input($_POST["jobref"]);
    $sql = "SELECT * FROM eoi WHERE job_ref_number='$jobref'";
    $result = mysqli_query($conn, $sql);

    echo "<h2>EOIs for Job Ref: $jobref</h2>";
    display_table($result);
}

else if ($action == "search_name") {

    $fname = clean_input($_POST["firstname"]);
    $lname = clean_input($_POST["lastname"]);

    $sql = "SELECT * FROM eoi WHERE 1";

    if (!empty($fname)) $sql .= " AND firstname='$fname'";
    if (!empty($lname)) $sql .= " AND lastname='$lname'";

    $result = mysqli_query($conn, $sql);

    echo "<h2>EOI Search Result</h2>";
    display_table($result);
}

else if ($action == "delete_jobref") {

    $jobref = clean_input($_POST["jobref"]);
    $sql = "DELETE FROM eoi WHERE job_ref_number='$jobref'";
    mysqli_query($conn, $sql);

    echo "<p>All EOIs for job ref <strong>$jobref</strong> have been deleted.</p>";
}

else if ($action == "update_status") {

    $eoi = intval($_POST["eoi"]);
    $status = clean_input($_POST["status"]);

    $sql = "UPDATE eoi SET status='$status' WHERE EOInumber=$eoi";
    mysqli_query($conn, $sql);

    echo "<p>Status updated for EOI number $eoi.</p>";
}

mysqli_close($conn);

include_once("footer.inc");
?>

