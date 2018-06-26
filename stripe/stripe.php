<?php

require_once('./config.php'); 

// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
$token = $_POST['stripeToken'];
$shirtSize = ($_POST['shirtSize']) ? $_POST['shirtSize'] : null;
$email = $_POST['stripeEmail'];
$amount = $_POST['amount'];




try {
  // Use Stripe's library to make requests...
    $customer = \Stripe\Customer::create(array(
        'email' => $email,
        'source'  => $token
    ));
    $charge = \Stripe\Charge::create([
        'amount' => $amount,
        'currency' => 'usd',
        'description' => 'Contribution',
        'customer' => $customer->id,
        'metadata[shirt-size]' => $shirtSize,
        'metadata[tier]' => '1',
        'receipt_email' => $email,
    ]); 


    $arr = array('status'=>'success');
    echo json_encode($arr);

} catch(\Stripe\Error\Card $e) {
    // Since it's a decline, \Stripe\Error\Card will be caught
    $body = $e->getJsonBody();
    $err  = $body['error'];
    echo json_encode($err);
}

?>