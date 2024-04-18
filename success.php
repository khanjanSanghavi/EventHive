<?php

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require "eventClass.php";
$obj = new db();


session_start();
$id = $_SESSION['UserId'];
$eventId = $_GET['eventId'];

\Stripe\Stripe::setApiKey('sk_test_51P5BWqSGjdbQxRsmxAUTdULLeON7Y9s2RGBFSqg9mLBDCESaB3CaNcm61BlCpgb3nEEVsvVpD994W99rcPiDId6g00kz9F3hca');

if(isset($_GET['session_id'])) {
    $session_id = $_GET['session_id'];

    try {
        // Retrieve the checkout session using the session ID
        $session = \Stripe\Checkout\Session::retrieve($session_id);
        $paymentIntentId = $session->payment_intent;
        if(isset($paymentIntentId)){

        // Retrieve transaction details from Stripe using the Payment Intent ID
        $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);

        // Extract relevant information from the Payment Intent object
        $amount = $paymentIntent->amount / 100; 
        $currency = strtoupper($paymentIntent->currency);
        $paymentMethod = $paymentIntent->payment_method_types[0];

        $customer = $paymentIntent->customer;
        $customerObj = \Stripe\Customer::retrieve($customer);
        $email = $customerObj->email;

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP host
        $mail->SMTPAuth = true;
        $mail->Username = 'khanjansanghavi0@gmail.com'; // SMTP username
        $mail->Password = 'qydt ermv istn miqa'; // SMTP password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('khanjansanghavi0@gmail.com', 'EVENT HIVE');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Confirmation of Payment';
        $mail->Body = "Dear customer,<br><br>"
                    . "Thank you for your payment!<br><br>"
                    . "Transaction Details:<br>"
                    . "Amount: $amount $currency<br>"
                    . "Payment Method: $paymentMethod<br><br>"
                    . "If you have any questions, feel free to contact us.<br><br>"
                    . "Best regards,<br>EVENT HIVE";

        $mail->send();


        $r = $obj->save_payment_details($paymentIntentId,$amount,$id,$eventId);
        if($r > 0){
            header('location:bill.php?eventId='.$eventId);
        }
    }else{
        $r = $obj->save_payment_details("NULL",0,$id,$eventId);
        if($r > 0){
            header('location:bill.php?eventId='.$eventId);
        }
    }

    } catch (Exception $e) {
        // Handle any errors that occur during retrieval
        echo "Error: " . $e->getMessage();
    }
} else {
    // If the session ID is not provided in the URL
    echo "Session ID not provided.";
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Bill</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }

        .container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            max-width: 150px;
            margin: 0 auto;
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="./image/payment_success.png" alt="Success Logo" class="logo">
        <h2>Transaction Details</h2>
        
        <div class="row">
            <div class="col-md-6">
                <p><strong>Amount:</strong> <?php echo $amount; ?> <?php echo $currency; ?></p>
                <p><strong>Payment Method:</strong> <?php echo $paymentMethod; ?></p>
            </div>
        </div>
    </div>
</body>
</html>

