<?php

require_once('../private/initialize.php');
require_login();
protect_admin_page();

include(SHARED_PATH . '/header.php');
include(SHARED_PATH . '/navbar.php');

?>

<h1>Submitted Applications</h1>

<?php echo display_errors(); ?>
<?php echo display_success(); ?>

<div class="container" style="width: auto">

    <form id="applyForm" style="width: auto" method="post" action="../private/backend_adminhome.php">

        <div class="inline-container">
        <select id="country" name="country">
        <option class="listbox-option" value="australia">Search by Application ID</option>
        <option class="listbox-option" value="canada">Search by Applicant Region</option>
        <option class="listbox-option" value="usa">Search by Application Status</option>
        </select>
        <input class="search-input" type="email" id="email" placeholder="Enter Search" name="email">
        <button class="longprimary"  type="submit">Search</button>
        </div>
        
    </form>
    
    <form id="applyForm" method="post" style="width: auto" action="../private/backend_adminhome.php">
        
        <select class="listbox" name="selectedapplications[]" size="4" multiple>
            
        <?php $allapplications = getAllApplications(); ?>
        <?php displaySubmittedApplications($allapplications); ?>
        
        </select>
        
        <div class="inline-container">
        <button class="shortprimary" name="view" type="submit">Open Application</button>
        <button class="shortprimary" name="process" type="submit">Check Eligibility</button>
        </div>
        <div class="inline-container">
        <button class="shortsecondary" name="approve" type="submit">Approve</button>
        <button class="shortsecondary" name="pend" type="submit">Pend</button>
        <button class="shortsecondary" name="disapprove" type="submit">Disapprove</button>
        </div>
   
    </form>
    
</div>

<?php include(SHARED_PATH . '/userinfo.php'); ?>
<?php include(SHARED_PATH . '/footer.php'); ?>