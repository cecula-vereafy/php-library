<?php

require_once 'Vereafy.php';

// Copy your API Key from the Cecula Developer Platform and paste below
$apiKey = '';

// The PIN REF that was initiated during the Init Request
$pinref = '';

// The token that your form user received on their mobile phone.
$token = '';

$vereafyClient = new Vereafy($apiKey);
echo $vereafyClient->complete($pinref, $token);