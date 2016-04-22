<?php
require __DIR__ . '/vendor/autoload.php';

$url = 'https://nbgdemo.azure-api.net/nodeopenapi' . $_POST['request-path'];
$headers = array(
    'Content-Type' => 'application/json',
    'Ocp-Apim-Subscription-Key' => $_POST['secondary-key']
);

if ($_POST['request-method'] == 'get') {
	$response = Requests::get($url, $headers);
} else if ($_POST['request-method'] == 'post') {
	$response = Requests::post($url, $headers, $_POST['request-body']);
} else if ($_POST['request-method'] == 'put') {
	$response = Requests::put($url, $headers, $_POST['request-body']);
} else if ($_POST['request-method'] == 'delete') {
	$response = Requests::delete($url, $headers, $_POST['request-body']);
} else {
    throw Exception('Invalid request method: "' . $_POST['request-method'] . '"');
}

echo $response -> status_code . PHP_EOL;
echo $response -> body;
?>
