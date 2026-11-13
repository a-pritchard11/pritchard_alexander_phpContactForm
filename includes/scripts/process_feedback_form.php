<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/../helpers.php';

$requestType = $_SERVER['REQUEST_METHOD'];

if ($requestType !== 'POST') {
    http_response_code(500);
    exit('Must be a POST request!');
}

$formInput = $_POST;

$_SESSION['form_input'] = $formInput;


$errors = [];

if (!array_key_exists('name', $formInput)) {
    $errors['name'] = 'Name must be filled out!';
}

$name = $formInput['name'];
if (strlen($name) < 3 || strlen($name) > 30) {
    $errors['name'] = 'Name must be more than 3 characters and less than 30';
}

if (!array_key_exists('phone_number', $formInput)) {
    $errors['phone_number'] = 'Phone number must be filled out!';
}
$phoneNumber = $formInput['phone_number'];

if (!array_key_exists('email', $formInput)) {
    $errors['email'] = 'Email is required!';
}

$email = $formInput['email'];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['email'] = 'Email must be a correct format!';
}

$otherfb = $formInput['other_fb'] ?? [];

if (!is_array($otherfb)) {
    $errors['other_fb'] = 'Other feedback must be an array!';
}

$validFb = ['length', 'talking-points', 'confidence'];
if (count($otherfb) > count($validFb)) {
    $errors['other_fb'] = 'Other feedback is invalid!';
}

foreach ($otherfb as $feedback) {
    if (!in_array($feedback, $validFb)) {
        $errors['other_fb'] = $feedback . 'this is not valid feedback!';
    }
}

$_SESSION['form_errors'] = $errors;


if (count($errors) === 0) {

    $to      = 'hello@email.com';
    $subject = 'New Feedback Submitted';
    $message = '';

    $message .= '<h1>Feedback</h1>';
    $message .= '<ul>';
    $message .= '<li>Name: ' . $name . '</li>';
    $message .= '<li>Email: ' . $email . '</li>';
    $message .= '<li>Phone Number: ' . $phoneNumber . '</li>';
    $message .= '</ul>';
    $message .= '<p>Other feedback:</p>';
    $message .= '<ul>';

    foreach ($otherfb as $feedback) {
        $message .= '<li>' . $feedback . '</li>';
    }
    $message .= '</ul>';

    mail($to, $subject, $message);
}

header('Location: /week_nine_inclass/adopt-form.php');
