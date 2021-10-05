<?php

require_once('../private/initialize.php');
require_login();
protect_member_page();

include(SHARED_PATH . '/header.php');
include(SHARED_PATH . '/navbar.php');

$fullapplicationinfo = getFullApplicationData($_SESSION['applicationid']);

?>

<h1><?php echo "Application ".$fullapplicationinfo['applicationID']." - Full Information" ?></h1>

<?php echo display_errors(); ?>
<?php echo display_success(); ?>

<div class="container" style="width: auto">
    
    <form id="applyForm" style="width: auto; height: 50vh;  overflow: scroll;">  
    
    <h3> ------------------------------------------------------ </h3>
    
    <div class="row">
    <div class="col-25">
    <label for="applicationID">Application ID</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['applicationID'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="applicantID">Applicant ID</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['applicantID'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="householdid">Household ID</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['householdid'] ?> disabled>
    </div>
    </div>
    
    <h3> ------------------------------------------------------ </h3>
    
    <div class="row">
    <div class="col-25">
    <label for="housetype">House Type</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['housetype'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="wallMaterial">Wall Material</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['wallMaterial'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="floorMaterial">Floor Material</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['floorMaterial'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="roofMaterial">Roof Material</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['roofMaterial'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="wallCondition">Wall Condition</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['wallCondition'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="floorCondition">Floor Condition</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['floorCondition'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="roofCondition">Roof Condition</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['roofCondition'] ?> disabled>
    </div>
    </div>
    
    <h3> ------------------------------------------------------ </h3>
    
    <div class="row">
    <div class="col-25">
    <label for="homeRegion">Home region</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['homeRegion'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="regionZone">Region Zone</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['regionZone'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="disposalMethod">Trash Disposal Method</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['disposalMethod'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="drainageMethod">Toilet Drainage Method</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['drainageMethod'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="energySource">Cooking Energy Source</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['energySource'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="electricitySource">Electricity Source</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['electricitySource'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="waterSource">Water Source</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['waterSource'] ?> disabled>
    </div>
    </div>
    
    <h3> ------------------------------------------------------ </h3>
    
    <div class="row">
    <div class="col-25">
    <label for="homeOwnershipStatus">Home Ownership Status</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['homeOwnershipStatus'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="hasTablet">Owns a tablet</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['hasTablet'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="hasComputer">Owns a computer</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['hasComputer'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="hasFridge">Owns a fridge</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['hasFridge'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="hasTablet">Owns a tablet</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['hasTablet'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="internetAvailability">Internet Availability</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['internetAvailability'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="vehiclesOwned">Vehicles Owned</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['vehiclesOwned'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="mobileQty">Number of mobile phones</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['mobileQty'] ?> disabled>
    </div>
    </div>
    
    <h3> ------------------------------------------------------ </h3>
    
    <div class="row">
    <div class="col-25">
    <label for="youngerMalesQty">Males younger than age 12?</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['youngerMalesQty'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="youngerFemalesQty">Girls younger than age 12?</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['youngerFemalesQty'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="youngerPersonsQty">Total persons below Age 12?</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['youngerPersonsQty'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="totalKidsQty">Total no. of kids (0 - 19)</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['totalKidsQty'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="bedroomOvercrowd">Overcrowding by bedroom</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['bedroomOvercrowd'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="personsPerRoom">Max. no of persons per room</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['personsPerRoom'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="numberOfRooms">Number of bedrooms</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['numberOfRooms'] ?> disabled>
    </div>
    </div>
    
    <h3> ------------------------------------------------------ </h3>
    
    <div class="row">
    <div class="col-25">
    <label for="personalEducationYrs">Personal years of education</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['personalEducationYrs'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="headsEducationYrs">Head's years of education</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['headsEducationYrs'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="avgAdultEducationYrs">Avg. adult yrs of education</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['avgAdultEducationYrs'] ?> disabled>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="dependencyRate">Dependency rate</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['dependencyRate'] ?> disabled>
    </div>
    </div>
    
    <h3> ------------------------------------------------------ </h3>
    
    <div class="row">
    <div class="col-25">
    <label for="applicationstatus">Application Status</label>
    </div>
    <div class="col-75">
    <input class="application-input" value=<?php echo $fullapplicationinfo['applicationstatus'] ?> disabled>
    </div>
    </div>
    
    <h3> ------------------------------------------------------ </h3>
    
    </form>
    
    <form method="post" action="memberopenapplication.php"> 
    
    <div style="display: flex; justify-content: center; margin: 0px 10px 0px 10px">
    <button class="shortprimary" name="edit" type="submit">Edit Application</button>
    <button class="shortsecondary" name="withdraw" type="submit">Withdraw Application</button>
    </div>
    
    </form>
    
</div>

<center><p> <a href="http://sharmadese.site/povertyprediction/public/memberhome.php">Back to All Applications</a> </p></center>

<?php include(SHARED_PATH . '/footer.php'); ?>