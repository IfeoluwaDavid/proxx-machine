<?php

require_once('../private/initialize.php');
require_login();
protect_admin_page();

include(SHARED_PATH . '/header.php');
include(SHARED_PATH . '/navbar.php');

?>

<h1>Prediction Results</h1>

<?php echo display_errors(); ?>
<?php echo display_success(); ?>

<div class="container" style="width: auto; overflow: scroll; height: auto;">

    <table id="t01">
        
      <tr>
        <th>Application ID</th>
        <th>Household Region</th>
        <th>Status</th>
        <th>Eligibility</th>
      </tr>
     
    <?php echo displayPredictionResults(); ?>
      
    </table>
    
</div>

<center><p> <a href="http://sharmadese.site/povertyprediction/public/adminhome.php">Back to All Applications</a> </p></center>

<?php include(SHARED_PATH . '/footer.php'); ?>