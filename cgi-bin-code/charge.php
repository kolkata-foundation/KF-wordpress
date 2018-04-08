<?php
require_once('../vendor/autoload.php');

include '../wp-content/themes/kolkatagives/page-templates/credentials.php';

  $stripe = $prod_stripe;

  \Stripe\Stripe::setApiKey($stripe['secret_key']);
  
  $json_str = file_get_contents('php://input');
  $json_obj = json_decode($json_str);
  $data     = (array) $json_obj;

  $token      = $data['stripe-token-id'];
  $email      = $data['donor-email'];
  $donor_name = $data['donor-name'];
  $donor_zip  = $data['donor-zipcode'];

  $charged_amount  = $data['charged-amount'];
  $donation_amount = $data['donation-amount'];
  $recurring  = $data['recurring'];

  $customer = \Stripe\Customer::create(array(
      'email' => $email,
      'source'  => $token
  ));

  $recurring_frequency = ""; 
  if ($recurring == 0) {
      $charge = \Stripe\Charge::create(array(
          'customer' => $customer->id,
          'amount'   => $charged_amount,
          'currency' => 'usd',
          'receipt_email' => $email,
          'metadata' => array('donor-name' => $donor_name, 'donor-zipcode' => $donor_zip)
      ));
  } else {
      $recurring_frequency = "monthly"; 
      $lookup_plan = array(
         "10" => "Monthly-10",
         "20" => "Monthly-20",
         "25" => "Monthly-25",
         "50" => "Monthly-50",
         "100" => "Monthly-100",
         "250" => "Monthly-250",
      );
      $plan = $lookup_plan[$donation_amount];

      \Stripe\Subscription::create(array(
          "customer" => $customer->id,
          "items" => array(
              array("plan" => $plan,),
          ),
      ));
  }

  $subject = "Thank you from Kolkata Foundation";

  $header  = 'From: donations@kolkatafoundation.org'     . "\r\n";
  $header .= 'Reply-to: donations@kolkatafoundation.org' . "\r\n";

  $message = <<<MARKER

Dear $donor_name,

Thank you for your generous $recurring_frequency donation of $$donation_amount to Kolkata Foundation. 
As a registered 501 c(3) organization, your donation is tax deductible. This email serves as a receipt
for your donation.

Please check if your employer will match your donation. We are already enrolled with Benevity and 
YourCause in order to help this process.

You can follow us at www.facebook.com/kolkatafoundation to learn about our projects and 
the impact of your donations. 100% of our administrative costs are borne by our founders, so 
that your donation can go towards helping those with the greatest need.

Please contact us at info@kolkatafoundation.org if you are interested in getting involved. 
We appreciate you spreading the word amongst your friends -- come join us to build a global
community working together to fight poverty in Kolkata.

With gratitude,
The Kolkata Foundation team

MARKER;

    $mail_sent = mail("$email", "$subject", "$message", "$header");
    return $mail_sent;
?>
