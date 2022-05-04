<?php
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.countrystatecity.in/v1/countries/IN/states/MN/cities",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => array(
    'X-CSCAPI-KEY: SEhMTlp3bWRmY2dzZlhGR2p4T1J5Y0lnTmFGYmVQTFBBU1Z0VXA0OQ=='
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;