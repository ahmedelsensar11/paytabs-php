<?php
echo "all is working";
$data = filter_input_array(INPUT_POST);
//var_dump($data);
//echo '<br/>';
$input = file_get_contents('php://input');
$encoded_data = json_encode($input);
//var_dump($input);

file_put_contents('inputs.txt',$encoded_data);
file_put_contents('post.txt',json_encode($data));

/*
// Profile Key (ServerKey)
$serverKey = "SMJN2GHDM2-JDB2KMKMN2-NZZHLZ69GD"; // Example

// Request body include a signature post Form URL encoded field
// 'signature' (hexadecimal encoding for hmac of sorted post form fields)
$signature_fields = filter_input_array(INPUT_POST);
var_dump($signature_fields);


$requestSignature = $signature_fields["signature"];
unset($signature_fields["signature"]);

// Ignore empty values fields
$signature_fields = array_filter($signature_fields);

// Sort form fields
ksort($signature_fields);

// Generate URL-encoded query string of Post fields except signature field.
$query = http_build_query($signature_fields);

$signature = hash_hmac('sha256', $query, $serverKey);
if (hash_equals($signature, $requestSignature) === TRUE) {
    // VALID Redirect
    // Do your logic
    echo 'the redirect is valid';
} else {
    // INVALID Redirect
    // Log request
    echo 'something is wrong';
}
*/