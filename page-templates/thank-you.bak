<?php get_header(); ?>

<?php if (!empty($_POST)) {
    $donor_email      = $_POST['payer_email'];
    $donor_first_name = $_POST['first_name'];
    $donor_last_name  = $_POST['last_name'];

    if($_POST['recurring'] == 1) {
        $donation_type   = "monthly";
        $transaction_id  = $_POST['subscr_id'];
        $donation_amt    = $_POST['amount3'];
        $donation_date   = $_POST['subscr_date'];
        $donation_status = "Subscr Started";
    } else {
        $donation_type    = "one time";
        $transaction_id   = $_POST['txn_id'];
        $donation_amt     = $_POST['payment_gross'];
        $donation_date    = $_POST['payment_date'];
        $donation_status  = $_POST['payment_status'];
    }

    global $wpdb;
    $result = $wpdb->insert(
            $wpdb->prefix . 'ngo_donation_info', // Table name
            array(
                'transaction_id'   => $transaction_id,
                'donor_first_name' => $donor_first_name,
                'donor_last_name'  => $donor_last_name,
                'donor_email'      => $donor_email,
                'donation_amount'  => $donation_amt,
                'time_of_donation' => $donation_date,
                'donation_status'  => $donation_status,
                'donation_type'    => $donation_type,
            )
        );

    $header  = "CC:" . 'donations@kolkatafoundation.org' . "\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";

    $message = <<<MARKER
        <html><head></head><body>
        <p style="color:red">Dear $donor_first_name $donor_last_name,</p>
        <p>Thank you for your generous $donation_type <b>$$donation_amt</b> donation to Kolkata Foundation 
           on <b>$donation_date</b>. The entire donation is sent towards funding projects in Kolkata
           as our board covers administrative expenses, and people like you help spread the word to 
           keep our marketing costs nil. We appreciate you sharing the story of this movement among your friends.</p>

        <p>Please connect with us through <a href="www.kolkatafoundation.org/join-us">our website</a> 
           if you are interested in helping further. You can follow our work on <a href="www.facebook.com/kolkatafoundation">Facebook</a>. 
        </p>
        
        <p>We will be sending you regular reports about our work. You'll know what your donation has helped fund, what accomplishments 
           we have achieved and what our current needs are.</p>

        <p>With gratitude,<br>The Kolkata Foundation team</p>
        </body></html>
MARKER;
    
        $subject = "Thank you from Kolkata Foundation";
        $to = $donor_email;
        $mail_sent = mail ($to, $subject, $message, $header);
    } ?>

<?php while ( have_posts() ) : the_post(); ?>
    <div class="main-container about-us-banner">
         <?php if ( has_post_thumbnail() ) : ?>
              <?php the_post_thumbnail(); ?>
        <?php endif; ?>
    </div>
    <div class="main-container">
        <div class="about-menu">
           <?php wp_nav_menu( array( 'theme_location' => 'about-us-page-menu' ) ); ?>
        </div>
    </div>
    <div class="main-container about-content">
        <div class="row">
            <div class="col-lg-12 text-center">
              <h1 class="main-title"><?php the_title(); ?></h1>
              <?php
                   echo "<h3>Thank you for your " . $donation_type. " contribution of $" . $donation_amt . 
                         ". Your financial support helps us continue in our mission of fighting poverty in Kolkata.</h3>";

                   if( $mail_sent == true ) {
                       echo "<h3>A confirmation mail has been sent to your mail id ".$donor_email."</h3>";
                   }
                   else {
                        echo "<h3>We failed to send a confirmation email to your email. </h3>" . $mail_sent . " --- " . $result;
                   }
              ?>
            </div>
        </div>
    </div>

    <?php  the_content(); ?>
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
