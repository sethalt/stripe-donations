<?php

// Rename to config.php and update with correct keys.

require_once('vendor/autoload.php');

$stripe = array(
  "secret_key"      => "",
  "publishable_key" => ""
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>