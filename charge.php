<?php
require_once('vendor/autoload.php');

$stripe_secret_key = "sk_test_51P5BWqSGjdbQxRsmxAUTdULLeON7Y9s2RGBFSqg9mLBDCESaB3CaNcm61BlCpgb3nEEVsvVpD994W99rcPiDId6g00kz9F3hca";

$eventPrice = $_POST["eventCost"];
$eventId = $_POST["eventId"];

\Stripe\Stripe::setApiKey($stripe_secret_key);

// Create a new customer
$customer = \Stripe\Customer::create([
    "name" => "Charusat",
    "address" => [
        "line1" => "123, Sample Street",
        "city" => "New York",
        "state" => "NY",
        "postal_code" => "10001",
        "country" => "US", // Billing address outside India
    ]
]);

// Get the customer ID
$customer_id = $customer->id;

$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost/miniprojectV2/success.php?eventId={$eventId}&session_id={CHECKOUT_SESSION_ID}",
    // Replace {PAYMENT_INTENT_ID} with the actual Payment Intent ID
    "line_items" => [
        [
            "quantity" => "1",
            "price_data" => [
                "currency" => "inr", // Use USD for non-INR transactions
                "unit_amount" => $eventPrice * 100, // Dummy unit amount (in cents)
                "product_data" => [
                    "name" => $eventId
                ]
            ]
        ]
    ],
    // Use the customer ID in the checkout session
    "customer" => $customer_id,
]);

// Replace {PAYMENT_INTENT_ID} with the actual Payment Intent ID
$redirect_url = str_replace("{CHECKOUT_SESSION_ID}", $checkout_session->payment_intent, $checkout_session->url);

http_response_code(303);
header("Location:".$redirect_url);

?>
