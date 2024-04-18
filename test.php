<?php


// session_start();
    // echo $_SESSION['UserId'];

    // require "eventClass.php";
    //   $obj = new db();

    //   $r = $obj->get_all_events();
    //   echo $r['eventName'];









    // -------------------------success.php code with phpmailer ------------------------------------------------



// require 'vendor/autoload.php';


// \Stripe\Stripe::setApiKey('sk_test_51P5BWqSGjdbQxRsmxAUTdULLeON7Y9s2RGBFSqg9mLBDCESaB3CaNcm61BlCpgb3nEEVsvVpD994W99rcPiDId6g00kz9F3hca');

// if(isset($_GET['session_id'])) {
//     $session_id = $_GET['session_id'];

//     try {
//         // Retrieve the checkout session using the session ID
//         $session = \Stripe\Checkout\Session::retrieve($session_id);
//         $paymentIntentId = $session->payment_intent;
       
//         echo "Payment Intent ID: " . $paymentIntentId;
        
//         // Retrieve transaction details from Stripe using the Payment Intent ID
//         $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);

//         // Extract relevant information from the Payment Intent object
//         $amount = $paymentIntent->amount;
//         $currency = $paymentIntent->currency;
//         $paymentMethod = $paymentIntent->payment_method;

//         // Generate receipt or invoice (this is a simplified example)
//         $receiptContent = "Thank you for your payment!\n\n";
//         $receiptContent .= "Amount: $amount $currency\n";
//         $receiptContent .= "Payment Method: $paymentMethod\n";
//         // Add more details as needed

//         // Send receipt to the user via email (uncomment and configure this part)
//         $customerEmail = "user@example.com"; // Replace with actual customer email
        
//         $mail = new PHPMailer(true);

//         try {
//             //Server settings
//             $mail->isSMTP();
//             $mail->Host       = 'smtp.example.com';
//             $mail->SMTPAuth   = true;
//             $mail->Username   = 'your@example.com';
//             $mail->Password   = 'your_password';
//             $mail->SMTPSecure = 'tls';
//             $mail->Port       = 587;

//             //Recipients
//             $mail->setFrom('your@example.com', 'Your Name');
//             $mail->addAddress($customerEmail); // Add a recipient

//             // Content
//             $mail->isHTML(false);
//             $mail->Subject = 'Payment Receipt';
//             $mail->Body    = $receiptContent;

//             $mail->send();
//             echo 'Receipt sent successfully!';
//         } catch (Exception $e) {
//             echo "Error sending receipt: {$mail->ErrorInfo}";
//         }
        
//     } catch (Exception $e) {
//         // Handle any errors that occur during retrieval
//         echo "Error: " . $e->getMessage();
//     }
// } else {
//     // If the session ID is not provided in the URL
//     echo "Session ID not provided.";
// }

?>