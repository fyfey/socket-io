<?php

$data = file_get_contents('php://input');

$curl = curl_init('localhost:3000/auth');
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Content-type: application/json"));

curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

$response = curl_exec($curl);

file_put_contents('auth.log', $response."\n", FILE_APPEND);

curl_close($curl);

echo $response;
