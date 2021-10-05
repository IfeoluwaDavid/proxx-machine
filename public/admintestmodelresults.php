<?php

require_once('../private/initialize.php');
require_login();
protect_admin_page();

include(SHARED_PATH . '/header.php');
include(SHARED_PATH . '/navbar.php');

?>

<h1>Analytics - Model Test Results</h1>

<?php echo display_errors(); ?>
<?php echo display_success(); ?>

<div class="container" style="width: auto; overflow: scroll; height: auto; max-height: 400px;">

    <table id="t01">
        
      <tr>
        <th>Row Number</th>
        <th>Actual Result</th>
        <th>Predicted Result</th>
        <th>Score</th>
      </tr>
     
    <?php echo displayTestModelResults(); ?>
      
    </table>
    
</div>

<center><p> <a href="http://sharmadese.site/povertyprediction/public/admintestmodel.php">Back to Test Model</a> </p></center>

<?php include(SHARED_PATH . '/footer.php'); ?>