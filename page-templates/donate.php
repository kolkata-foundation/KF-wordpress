<?php
/**
 * Template Name: Donate Page Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<?php
require_once('vendor/autoload.php');

/**
 * Including 3rd party credentials to be able to store in github
 */
include 'credentials.php';

$stripe = $prod_stripe;

\Stripe\Stripe::setApiKey($stripe['secret_key']);

global $wp_query;
$fundraiser_id = $wp_query->query_vars['fundraiser_id'] ?: 0; // Find in the URL

if ($fundraiser_id == 0 and isset($_COOKIE['kf_fundraiser_id'])) {
  $fundraiser_id = $_COOKIE['kf_fundraiser_id'];
}

?>
    <script src="https://checkout.stripe.com/checkout.js"></script>

    <div class="main-container donation-form" xmlns="https://www.w3.org/1999/html">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 donation-col text-center">
                <section class="text-center donate-info">
                    <?php  while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; // end of the loop. ?>
                </section>

                <form method="post" action="https://www.kolkatafoundation.org/cgi-bin/charge.php" class="main-donation-form">
                <section class="amt-btns">
                    <input type="hidden" name="currency_code" value="USD">
                    <input type="hidden" id="charged-amount"  name="charged-amount"  value=0>
                    <input type="hidden" id="donation-amount" name="donation-amount" value=0>
                    <input type="hidden" id="fundraiser-id"   name="fundraiser-id"   value=<?php echo $fundraiser_id ?> >

                    <label class="box">
                        <input type="radio" name="amount" class="amt_button" value="10">
                        <span>$10</span>
                    </label>

                    <label class="box">
                        <input type="radio" name="amount" class="amt_button" value="20">
                        <span>$20</span>
                    </label>

                    <label class="box">
                        <input type="radio" name="amount" class="amt_button" value="25" checked>
                        <span>$25</span>
                    </label>

                    <label class="box">
                        <input type="radio" name="amount" class="amt_button" value="50">
                        <span>$50</span>
                    </label>

                    <label class="box">
                        <input type="radio" name="amount" class="amt_button" value="75">
                        <span>$75</span>
                    </label>

                    <label class="box">
                        <input type="radio" name="amount" class="amt_button" value="100">
                        <span>$100</span>
                    </label>

                    <label class="box">
                        <input type="radio" name="amount" class="amt_button" value="150">
                        <span>$150</span>
                    </label>

                    <label class="box">
                        <input type="radio" name="amount" class="amt_button" value="200">
                        <span>$200</span>
                    </label>

                    <label class="box">
                        <input type="radio" name="amount" class="amt_button" value="250">
                        <span>$250</span>
                    </label>

                    <label class="box">
                        <input type="radio" name="amount" class="amt_button" value="300">
                        <span>$300</span>
                    </label>

                    <label class="box">
                        <input type="radio" name="amount" class="amt_button" value="400">
                        <span>$400</span>
                    </label>

                    <label class="box">
                        <input type="radio" name="amount" class="amt_button" value="500">
                        <span>$500</span>
                    </label>

                    <label class="box">
                        <input type="radio" name="amount" class="amt_button" value="750">
                        <span>$750</span>
                    </label>

                    <label class="box">
                        <input type="radio" name="amount" class="amt_button" value="1000">
                        <span>$1000</span>
                    </label>

                    <div class="clear"></div>

                    <label for="donation-type" class="repeat-btn">
                        <input type="checkbox" name="is_monthly" id='is_monthly' class="enable-checkbox">Make this donation monthly
                    </label>

                    <div class="clear"></div>
                </section>

                <section class="user-info">
                  <input type="text" id="donor-name" placeholder="Donor Name" required  pattern="^\S+$">
                  <div style="margin:10px"><center><?php do_action( 'anr_captcha_form_field' ) ?></center></div>
                  <input type="submit" name="submit" id="donation" value="DONATE NOW">
                </section>
			
            </div> 
				
            <script><!-- STRIPE MAGIC -->
            function handleStripeToken(token) {
                var chargedAmount = document.getElementById('charged-amount').value; 
                var donorName     = document.getElementById('donor-name').value; 
                var recurring     = document.getElementById('is_monthly').checked ? 1 : 0;
                var donationAmount = document.getElementById('donation-amount').value;
                var fundraiser_id  = document.getElementById('fundraiser-id').value;
                var tokenId       = token.id;
                var email         = token.email;
                var zipcode       = token.card.address_zip;


                fetch("/cgi-bin/charge.php", {
                    method: "POST",
                    headers: {"Content-Type": "application/json"},
                    body: JSON.stringify({'stripe-token-id': tokenId, 'donor-email': email, 
                                          'charged-amount': chargedAmount, 'donor-name': donorName,
                                          'donation-amount': donationAmount,
                                          'donor-zipcode': zipcode, 'recurring': recurring,
                                          'fundraiser-id': fundraiser_id })
                })
                .then(response => {
                    if (!response.ok) {
                       throw response;
                    }
                    alert('Thank you for your donation. Check your email (including the spam folder) for your tax-deducation receipt.');
                    window.location.replace("https://www.kolkatafoundation.org/");
                    return response.json();
                })
                .then(output => {
                })
                .catch(err => {
                })
            }
            

            var handler = StripeCheckout.configure({
                              key: <?php echo "'" . $stripe['publishable_key'] . "'" ?>,
                              image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
                              locale: 'auto',
                              zipCode: true,
                              description: 'Fight poverty in Kolkata',
                              token: handleStripeToken
                          });
            








            document.getElementById('donation').addEventListener('click', function(e) {
                // seems to change when recurring button pressed
                // var radios = document.getElementsByName('amount'); 

                if (document.getElementById('donor-name').value.trim() == '') {
                  jQuery('<p class="error">Enter donor name').insertAfter($('#donor-name'));
                  return false;
                }

                var radios = document.getElementsByClassName('amt_button');
                var donationAmount = 25;
                for (var i=0,length=radios.length; i < length; i++) {
                    if (radios[i].checked) {
                        donationAmount = radios[i].value;
                        break;
                    }
                }
            

                // Stripe charges 2.2% + $0.30
                // S = (D+S)*0.022 + 30 => D+S = (D + 30)/0.978
                var totalAmount = Math.ceil((parseInt(donationAmount + "")*100 + 30)/0.978); // in cents
                document.getElementById('charged-amount').value = totalAmount;
                document.getElementById('donation-amount').value = donationAmount;
                handler.open({
                    name: 'Kolkata Foundation',
                    amount: totalAmount
                });
                
                e.preventDefault();
            });

        

            // Close Checkout on page navigation:
            window.addEventListener('popstate', function() {
                handler.close();
            });

            </script>

            </form>

        </div>
    </div>

<?php get_footer(); ?>
