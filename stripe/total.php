<?php

require_once('./config.php'); 

$balance = \Stripe\Balance::retrieve();
echo json_encode($balance->available[0]->amount);
?>