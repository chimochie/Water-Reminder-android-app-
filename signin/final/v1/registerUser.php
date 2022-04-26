<?php
require_once '../includes/DbOperations.php';
$response = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
       isset($_POST['fullname']) and 
        isset($_POST['username']) and
        isset($_POST['email']) and
        isset($_POST['password']) and
        isset($_POST['confirmpassword'])
    ) {
        $db = new  DbOperations();
        $result = $db->createUser(
            $_POST['fullname'],
            $_POST['username'],
            $_POST['email'] ,
            $_POST['password'],
            $_POST['confirmpassword']

        );
        if ($result == 1) {
            $response['error'] = false;
            $response['message'] = "user register successfully";
        } elseif ($result == 2) {
            $response['error'] = true;
            $response['message'] = "some error occured please try again";
        } elseif ($result == 0) {
            $response['error'] = true;
            $response['message'] = "It seems you are already registered, please choose a different email and username";
        }
    } else {
        $response['error'] = true;
        $response['message'] = "Required fields are missing";
    }
} else {
    $response['error'] = true;
    $response['message'] = "Invalid Request";
}
echo json_encode($response);
