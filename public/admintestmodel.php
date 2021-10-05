<?php

require_once('../private/initialize.php');
require_login();
protect_admin_page();

include(SHARED_PATH . '/header.php');
include(SHARED_PATH . '/navbar.php');

?>

<h1> Analytics - Test Model</h1>

<?php echo display_errors(); ?>
<?php echo display_success(); ?>

<div class="container" style="width: auto">
    
    <form id="applyForm" method="post" action="../private/backend_admintestmodel.php" style="max-width: 500px; width: auto; height: auto;">
        
        <label for="linenumbers">Enter comma separated numbers between 1 and 9557</label>
        <input style="margin-top: 10px;" class="application-input" placeholder="(e.g. 10, 34, 3, 11, 504, 78)" type="text" id="linenumbers" name="linenumbers">
        
        <button class="shortprimary" type="submit" name="test">Test Model</button>
        
    </form>
    
</div>

<center><p><a href="http://sharmadese.site/povertyprediction/public/adminmanagemodels.php">Manage Models</a>
<a href="http://sharmadese.site/povertyprediction/public/adminretrainmodel.php">Train Model</a>
<a href="http://sharmadese.site/povertyprediction/public/admintestmodel.php">Test Model</a> </p></center>

<?php include(SHARED_PATH . '/footer.php'); ?>