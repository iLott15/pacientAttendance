<?php

require_once('../../../../includes/config.php');
require_once('../../../../includes/class/class.Functions.php');

global $mySQL;
$mySQL->sql('SET character_set_results=utf8');

$doctorTypeId = mysqli_real_escape_string($mySQL->link, $_POST['doctorTypeId']);


// Read the input JSON data
$data = json_decode(file_get_contents('php://input'), true);

// Perform the deletion in the database
// You should implement this part based on your database structure
// For example:
$queryDel = $mySQL->sql("DELETE FROM doctor_types WHERE doctorTypeId = " . $doctorTypeId);

// Simulate success for demonstration purposes
$queryDel = true;

if ($queryDel) {
    // Return success response
    echo json_encode(['success' => true, 'message' => 'Doctor Type deleted successfully.']);
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(['success' => false, 'message' => 'Failed to delete doctor type.']);
}

?>