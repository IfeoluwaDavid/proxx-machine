<?php

require_once('../private/initialize.php');
require_login();
protect_admin_page();

include(SHARED_PATH . '/header.php');
include(SHARED_PATH . '/navbar.php');

?>

<h1> Analytics - Train Model</h1>

<?php echo display_errors(); ?>
<?php echo display_success(); ?>

<div class="container" style="width: auto">
    
    <form id="applyForm" method="post" action="../private/backend_adminretrainmodel.php" style="width: auto; height: auto;">
        
        <div class="row">
        <div class="col-25">
        <label for="modelname">Enter a new model name here</label>
        </div>
        <div class="col-75">
        <input class="application-input" placeholder="(without extension)" type="text" id="modelname" name="modelname">
        </div>
        </div>
        
        <div class="row">
        <div class="col-25">
        <label for="datasetname">Select Pre-Saved Dataset</label>
        </div>
        <div class="col-75">
        <select class="application-input" id="datasetname" name="datasetname">
            
        <?php echo displayPresavedDatasets(); ?>
        
        </select>
        </div>
        </div>
    
        <div class="row">
        <div class="col-25">
        <label for="algorithmname">Select Prediction Algorithm</label>
        </div>
        <div class="col-75">
        <select class="application-input" id="algorithmname" name="algorithmname">
        <option value="1">Random Forest</option>
        <option value="2">Logistic Regression</option>
        <option value="3">Support Vector Machine</option>
        </select>
        </div>
        </div>
        
        <button class="shortprimary" type="submit" name="retrain">Train Model</button>
        <button class="shortsecondary" type="submit" name="save">Save Model</button>
        
    </form>
    
</div>

<center><p><a href="http://sharmadese.site/povertyprediction/public/adminmanagemodels.php">Manage Models</a>
<a href="http://sharmadese.site/povertyprediction/public/adminretrainmodel.php">Train Model</a>
<a href="http://sharmadese.site/povertyprediction/public/admintestmodel.php">Test Model</a> </p></center>

<?php include(SHARED_PATH . '/footer.php'); ?>