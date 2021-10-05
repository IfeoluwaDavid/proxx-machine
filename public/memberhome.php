<?php 

require_once('../private/initialize.php');
require_login();
protect_member_page();

$householdapplications = getApplications($_SESSION['userhouseholdid']);
$headofhouse = getHeadofHouse($_SESSION['userhouseholdid']);

include(SHARED_PATH . '/header.php');
include(SHARED_PATH . '/navbar.php');

?>

<h1>Your Applications</h1>

<?php echo display_errors(); ?>
<?php echo display_success(); ?>

<div class="container" style="width: auto">

    <form id="applyForm" style="width: auto" method="post" action="../private/backend_memberhome.php">

        <div class="inline-container">
        <select id="country" name="country">
        <option class="listbox-option" value="australia">Search by Application Number</option>
        <option class="listbox-option" value="usa">Search by Application Status</option>
        </select>
        <input class="search-input" type="email" id="email" placeholder="Enter Search" name="email">
        <button class="longprimary"  type="submit">Search</button>
        </div>
        
    </form>
    
    <form id="applyForm" method="post" style="width: auto" action="../private/backend_memberhome.php">
        
        <select class="listbox" name="selectedapplication" size="4">
            
        <?php
        
        if(sizeof($householdapplications) > 0)
        {
            for ($i=0; $i<sizeof($householdapplications); $i++)
            {
                $householdid = $householdapplications[$i]['householdid'];
                $app_id = $householdapplications[$i]['applicationID'];
                $app_status = $householdapplications[$i]['applicationstatus'];
                $info = "[ Application ".$app_id." | Household ".$householdid." ] - Submitted by ".$headofhouse['firstname']." ".$headofhouse['lastname']." [ ".$householdapplications[$i]['applicationstatus']." ]";
                echo "<option class='listbox-option' value='$app_id'>".$info."</option>";
            }
        }
        else
        {
            echo "<option class='listbox-option' value='0' disabled>No applications yet</option>";
        }
        
        ?>
        
        </select>
        
        <button class="shortprimary" name="openapplication" type="submit">Open Application</button>
        <div class="inline-container">
        <button class="shortsecondary" name="newapplication" type="submit">Create New Application</button>
        <button class="shortsecondary" name="withdrawapplication" type="submit">Withdraw Application</button>
        </div>
        
    </form>
    
</div>

<?php include(SHARED_PATH . '/userinfo.php'); ?>
<?php include(SHARED_PATH . '/footer.php'); ?>