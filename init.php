<?php

require_once 'Vereafy.php';

// Copy your API Key from the Cecula Developer Platform and paste below
$apiKey = '';

// The mobile number that your form user submitted.
$mobile = '';

$vereafyClient = new Vereafy($apiKey);
echo $vereafyClient->init($mobile);