<?php
require_once('../vendor/autoload.php');
require_once('thanks_mail.php');

include '../wp-content/themes/kolkatagives/page-templates/credentials.php';

  $stripe = $prod_stripe;

  \Stripe\Stripe::setApiKey($stripe['secret_key']);
  
  $json_str = file_get_contents('php://input');
  $json_obj = json_decode($json_str);
  $data     = (array) $json_obj;

  $token      = $data['stripe-token-id'];
  $donor_email = $data['donor-email'];
  $donor_name  = $data['donor-name'] ?: 'Anonymous';
  $donor_zip  = $data['donor-zipcode'];

  $fundraiser_id   = $data['fundraiser-id'];
  $charged_amount  = $data['charged-amount'];
  $donation_amount = $data['donation-amount'];
  $recurring       = $data['recurring'];

  // Return unless valid email or amount 
  if (empty($token) or empty($donor_email) or empty($donation_amount)) {
    return;
  }

  $customer = \Stripe\Customer::create(array(
      'email' => $donor_email,
      'source'  => $token
  ));

  $recurring_frequency = ""; 
  if ($recurring == 0) {
      $charge = \Stripe\Charge::create(array(
          'customer' => $customer->id,
          'amount'   => $charged_amount,
          'currency' => 'usd',
          'receipt_email' => $donor_email,
          'metadata' => array('donor-name' => $donor_name, 'donor-zipcode' => $donor_zip)
      ));
  } else {
      $recurring_frequency = "monthly"; 
      $lookup_plan = array(
         "10" => "Monthly-10",
         "20" => "Monthly-20",
         "25" => "Monthly-25",
         "50" => "Monthly-50",
         "75" => "Monthly-75",
         "100" => "Monthly-100",
         "150" => "Monthly-150",
         "200" => "Monthly-200",
         "250" => "Monthly-250",
         "300" => "Monthly-300",
         "400" => "Monthly-400",
         "500" => "Monthly-500",
         "750" => "Monthly-750",
         "1000" => "Monthly-1000",
      );
      $plan = $lookup_plan[$donation_amount];

      \Stripe\Subscription::create(array(
          "customer" => $customer->id,
          "items" => array(
              array("plan" => $plan,),
          ),
      ));
  }

  if (!($fundraiser_id > 1)) {
    $fundraiser_id = 1; # Not part of a campaign -- attribute to a general donation
  }
  // wpdb not available outside wordpress.
  require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
  $wpdb = new wpdb( DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);

  // Add entries for tracking volunteer campaign donations
  $wpdb->insert(
           'wp_campaign_donations',
           array (
                  'fundraiser_id'   => $fundraiser_id,
                  'donor_name'      => $donor_name,
                  'donor_email'     => $donor_email,
                  'donation_amount' => $donation_amount,
                  'is_recurring'    => $recurring,
                  'donation_date'   => date('m/d/Y', time()),
                )
  );

  $results = $wpdb->get_results("SELECT * FROM wp_fundraisers WHERE fundraiser_id = " . $fundraiser_id);
  $volunteer_email = $results[0]->email;
  $volunteer_name  = $results[0]->volunteer_names;

  send_thanks($donor_email, $donor_name, $donation_amount, $recurring_frequency, $volunteer_name, $volunteer_email);

?>
