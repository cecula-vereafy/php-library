<?php

require_once 'Vereafy.php';

// Copy your API Key from the Cecula Developer Platform and paste below
$apiKey = '';

$vereafyClient = new Vereafy($apiKey);
echo $vereafyClient->getBalance()->balance;