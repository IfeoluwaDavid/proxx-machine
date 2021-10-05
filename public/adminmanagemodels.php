<?php

require_once('../private/initialize.php');
require_login();
protect_admin_page();

include(SHARED_PATH . '/header.php');
include(SHARED_PATH . '/navbar.php');

?>

<h1>Analytics - Manage Models</h1>

<?php echo display_errors(); ?>
<?php echo display_success(); ?>

<div class="container" style="width: auto">

    <form id="applyForm" style="width: auto" method="post" action="../private/backend_adminmanagemodels.php">

            <div class="row">
            <div class="col-25">
            <label for="floorMaterial"><b>Currently Deployed Prediction Model</b></label>
            </div>
            <div class="col-75">
            <input class="application-input" type="text" value="<?php echo getDeployedModel(); ?>" disabled>
            </div>
            </div>
        
    </form>
    
    <form id="applyForm" method="post" style="width: auto" action="../private/backend_adminmanagemodels.php">
        
        <select class="listbox" name="selectedfile" size="5">
        
        <?php echo displayPresavedModels(getAllModels()); ?>
        
        </select>
    
        <div class="inline-container" style="margin: -5px 0px 0px 0px">
        <button class="shortprimary" type="submit" name="deploy">Deploy</button>
        <button class="shortsecondary" type="submit" name="remove">Delete</button>
        </div>
        
    </form>
    
</div>

<center><p><a href="http://sharmadese.site/povertyprediction/public/adminmanagemodels.php">Manage Models</a>
<a href="http://sharmadese.site/povertyprediction/public/adminretrainmodel.php">Train Model</a>
<a href="http://sharmadese.site/povertyprediction/public/admintestmodel.php">Test Model</a> </p></center>

<?php include(SHARED_PATH . '/footer.php'); ?>