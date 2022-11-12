<?php
require_once('../vendor/autoload.php');
require_once('thanks_mail.php');
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fundraiser_id   = $_POST['fundraiser-id'];
  $donor_name      = $_POST['donor-name'] ?: 'Anonymous';
  $donor_email     = $_POST['donor-email'];
  $referred_by     = $_POST['referred-by'] ?: '';
  $donation_amount = $_POST['donation-amount'];
  $recurring       = $_POST['recurring'] ?: 0;
  $pledge          = $_POST['pledge'];
  $donation_date   = $_POST['donation-date'];
  $secret_key      = $_POST['secret'];
  $thank_donor     = $_POST['thank-donor'];
  
  if ($secret_key != "SecretCode!") { // Prevent bots
     return;
  }
 
  // wpdb not available outside wordpress.
  require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
  $wpdb = new wpdb( DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
 
  if ($pledge) {
    $donor_name = "*" . $donor_name;
  }
  // Add entries for tracking volunteer campaign donations
  $wpdb->insert(
           'wp3q_campaign_donations',
           array (
                  'fundraiser_id'   => $fundraiser_id,
                  'donor_name'      => $donor_name,
                  'donor_email'     => $donor_email,
                  'donation_amount' => $donation_amount,
                  'is_recurring'    => $recurring,
                  'referral'        => $referred_by,
                  'donation_date'   => $donation_date,
                )
  );

  $results = $wpdb->get_results("SELECT * FROM wp3q_fundraisers WHERE fundraiser_id = " . $fundraiser_id);
  $volunteer_email = $results[0]->email;
  $volunteer_name  = $results[0]->volunteer_names;
  $slug            = $results[0]->volunteer;

  if (!$pledge && $thank_donor) {
    send_thanks($donor_email, $donor_name, $donation_amount, $recurring_frequency, $volunteer_name, $volunteer_email);
  }
  header('Location: https://www.kolkatafoundation.org/fundraiser-3/?campaign=' . $slug);
  exit();
}
?>
