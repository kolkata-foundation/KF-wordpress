<?php
/**
 * Template Name: Manual Fundraiser Update
 */                 
                        
get_header(); ?>   

<?php
require_once('vendor/autoload.php');

  global $wp_query;
  global $wpdb;
  $table_name = $wpdb->prefix . 'fundraisers';
  $fundraiser_results = $wpdb->get_results("SELECT fundraiser_id, volunteer_names FROM $table_name");
?>
    <div class="main-container">
      <form method="post" action="https://www.kolkatafoundation.org/cgi-bin/update_db.php" class="main-donation-form"> 
        <section class="user-info">
         <select name="fundraiser-id" id="fundraiser-id">
            <?php foreach ($fundraiser_results as $key => $row) {
                    echo "<option value=" . $row->fundraiser_id . ">" . $row->volunteer_names . "</option>";
                  } 
            ?>
         </select>

          <input type="text" id="donor-name" name="donor-name" placeholder="Donor Name" required>
          <input type="text" id="referred-by" name="referred-by" placeholder="Referred by">
          <input type="text" id="donation-amount" name="donation-amount" placeholder="Amount" pattern="^\d+$">
          <input type="email" id="donor-email" name="donor-email" placeholder="Email">
          <input type="checkbox" id="recurring" name="recurring"> <label for="recurring">Recurring</label>
          <label for="donation-date">Donation Date</label>
          <input type="date" id="donation-date" name="donation-date" value="2022-11-04" min="2022-11-04" max="2025-12-31">
          <input type="submit" name="submit" id="donation" value="Insert">
        </section>
      
      </form>
      <div class="row">
        <?php  while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; // end of the loop. ?>
      </div><!-- row -->
     
    </div><!-- main-container -->
<?php get_footer(); ?>
