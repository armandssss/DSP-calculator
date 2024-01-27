<?php
$recaptcha_secret_key = '6Lfncl4pAAAAACGKEfKo03CyVGJWyyB_IkPlxtAZ';
$recaptcha_response = $_POST['g-recaptcha-response'];

$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = [
    'secret' => $recaptcha_secret_key,
    'response' => $recaptcha_response,
];

$options = [
    'http' => [
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data),
    ],
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$response = json_decode($result, true);

if ($response['success']) {
    $email = $_POST['email'];
    $first = $_POST['first'];
    $last = $_POST['last'];
    $phone = $_POST['phone'];
    echo "Form submitted successfully!";
} else {
    echo "reCAPTCHA verification failed!";
}
?>
