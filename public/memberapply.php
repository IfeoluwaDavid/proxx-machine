<?php

require_once('../private/initialize.php');
require_login();
protect_member_page();

include(SHARED_PATH . '/header.php');
include(SHARED_PATH . '/navbar.php'); 

?>

<h1>Prepare Your Application</h1>

<div class="container">

<form id="applyForm" method="post" action="../private/backend_memberapply.php">

<!-- *******************************************Individual Information**********************************************  -->
    
<div class="tab">
    
    <div class="row">
    <div class="col-25">
    <label for="housetype">House Type</label>
    </div>
    <div class="col-75">
    <select class="application-input" id="housetype" name="housetype">
    <option value="Apartment">Apartment</option>
    <option value="Townhouse">Townhouse</option>
    <option value="Bungalow">Bungalow</option>
    <option value="Duplex">Duplex</option>
    <option value="Detached">Detached</option>
    <option value="Duplex">Duplex</option>
    <option value="Condominium">Condominium</option>
    </select>
    </div>
    </div>

    <div class="row">
    <div class="col-25">
    <label for="wallMaterial">Wall Material *</label>
    </div>
    <div class="col-75">
    <select class="application-input" id="wallMaterial" name="wallMaterial">
    <option value="Brick">Brick</option>
    <option value="Asbestos">Asbestos</option>
    <option value="Cement">Cement</option>
    <option value="Waste Material">Waste Material</option>
    <option value="Wood">Wood</option>
    <option value="Zinc">Zinc</option>
    <option value="Natural Fibre">Natural Fibre</option>
    <option value="Other">Other</option>
    </select>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="floorMaterial">Floor Material *</label>
    </div>
    <div class="col-75">
    <select class="application-input" id="floorMaterial" name="floorMaterial">
    <option value="Ceramic">Ceramic</option>
    <option value="Cement">Cement</option>
    <option value="Natural Fibre">Natural Fibre</option>
    <option value="Wood">Wood</option>
    <option value="Other">Other</option>
    <option value="No Floors">No Floors</option>
    </select>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="roofMaterial">Roof Material *</label>
    </div>
    <div class="col-75">
    <select class="application-input" id="roofMaterial" name="roofMaterial">
    <option value="Zinc">Zinc</option>
    <option value="Cement">Cement</option>
    <option value="Natural Fibre">Natural Fibre</option>
    <option value="other">Other</option>
    <option value="No Ceiling">No Ceiling</option>
    </select>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="wallCondition">Wall Condition *</label>
    </div>
    <div class="col-75">
    <select class="application-input" id="wallCondition" name="wallCondition">
    <option value="Bad">Bad</option>
    <option value="Regular">Regular</option>
    <option value="Good">Good</option>
    </select>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="floorCondition">Floor Condition *</label>
    </div>
    <div class="col-75">
    <select class="application-input" id="floorCondition" name="floorCondition">
    <option value="Bad">Bad</option>
    <option value="Regular">Regular</option>
    <option value="Good">Good</option>
    </select>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="roofCondition">Roof Condition *</label>
    </div>
    <div class="col-75">
    <select class="application-input" id="roofCondition" name="roofCondition">
    <option value="Bad">Bad</option>
    <option value="Regular">Regular</option>
    <option value="Good">Good</option>
    </select>
    </div>
    </div>


</div>

<!-- *******************************************Materials & Their Condition**********************************************  -->

<div class="tab">

    <div class="row">
    <div class="col-25">
    <label for="homeRegion">Home Region *</label>
    </div>
    <div class="col-75">
    <select class="application-input" id="homeRegion" name="homeRegion">
    <option value="Central Region">Central Region</option>
    <option value="Chorotega Region">Chorotega Region</option>
    <option value="Central Pacific Region">Central Pacific Region</option>
    <option value="Brunca Region">Brunca Region</option>
    <option value="Huetar Atlantica Region">Huetar Atlantica Region</option>
    <option value="Huetar Norte Region">Huetar Norte Region</option>
    </select>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="regionZone">Region Zone</label>
    </div>
    <div class="col-75">
    <select class="application-input" id="regionZone" name="regionZone">
    <option value="Urban">Rural</option>
    <option value="Rural">Urban</option>
    </select>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="disposalMethod">Trash Disposal Method *</label>
    </div>
    <div class="col-75">
    <select class="application-input" id="disposalMethod" name="disposalMethod">
    <option value="Tanker Truck">Tanker Truck</option>
    <option value="Buried Waste">Buried Waste</option>
    <option value="Burnt Waste">Burnt Waste</option>
    <option value="Sea / River Disposal">Sea / River Disposal</option>
    <option value="Land Disposal">Land Disposal</option>
    <option value="Other">Other</option>
    </select>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="drainageMethod">Toilet Drainage Method</label>
    </div>
    <div class="col-75">
    <select class="application-input" id="drainageMethod" name="drainageMethod">
    <option value="Sewer">Sewer</option>
    <option value="Septic Tank">Septic Tank</option>
    <option value="Latrine">Latrine</option>
    <option value="Other">Other</option>
    <option value="No Toilet">No Toilet</option>
    </select>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="energySource">Cooking Energy Source *</label>
    </div>
    <div class="col-75">
    <select class="application-input" id="energySource" name="energySource">
    <option value="Electricity">Electricity</option>
    <option value="Gas">Gas</option>
    <option value="Wood / Charcoal">Wood / Charcoal</option>
    <option value="No Energy Source">No Energy Source</option>
    </select>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="electricitySource">Electricity Source</label>
    </div>
    <div class="col-75">
    <select class="application-input" id="electricitySource" name="electricitySource">
    <option value="Public Plant">Public Plant</option>
    <option value="Private Plant">Private Plant</option>
    <option value="Cooperative">Cooperative</option>
    <option value="No Electricity">No Electricity</option>
    </select>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="waterSource">Water Source</label>
    </div>
    <div class="col-75">
    <select class="application-input" id="waterSource" name="waterSource">
    <option value="Inside the house">Inside the house</option>
    <option value="Outside the house">Outside the house</option>
    <option value="No water provision">No water provision</option>
    </select>
    </div>
    </div>

</div>

<!-- *******************************************Materials & Their Condition**********************************************  -->

<div class="tab">
    
    <div class="row">
    <div class="col-25">
    <label for="homeOwnershipStatus">Home Ownership Status</label>
    </div>
    <div class="col-75">
    <select class="application-input" id="homeOwnershipStatus" name="homeOwnershipStatus">
    <option value="Fully Paid Ownership">Fully Paid Ownership</option>
    <option value="Installmental Payment Ownership">Installmental Payment Ownership</option>
    <option value="Rented">Rented</option>
    <option value="Precarious">Precarious</option>
    <option value="Other (assigned, borrowed etc.)">Other (assigned, borrowed etc.)</option>
    </select>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="hasTablet">Own a tablet *</label>
    </div>
    <div class="col-75">
    <select class="application-input" id="hasTablet" name="hasTablet">
    <option value="Yes">Yes</option>
    <option value="No">No</option>
    </select>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="hasComputer">Own a computer *</label>
    </div>
    <div class="col-75">
    <select class="application-input" id="hasComputer" name="hasComputer">
    <option value="Yes">Yes</option>
    <option value="No">No</option>
    </select>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="hasFridge">Own a refrigerator?</label>
    </div>
    <div class="col-75">
    <select class="application-input" id="hasFridge" name="hasFridge">
    <option value="Yes">Yes</option>
    <option value="No">No</option>
    </select>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="internetAvailability">Internet Availability</label>
    </div>
    <div class="col-75">
    <select class="application-input" id="internetAvailability" name="internetAvailability">
    <option value="Always">Always</option>
    <option value="Occasionally">Occasionally</option>
    <option value="Never">Never</option>
    </select>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="vehiclesOwned">Vehicles Owned</label>
    </div>
    <div class="col-75">
    <select class="application-input" id="vehiclesOwned" name="vehiclesOwned">
    <option value="None">None</option>
    <option value="Single">Single</option>
    <option value="Multiple">Multiple</option>
    <option value="Rented">Rented</option>
    </select>
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="mobileQty">Number of mobile phones *</label>
    </div>
    <div class="col-75">
    <input class="application-input" type="number" min="0" id="mobileQty" name="mobileQty">
    </div>
    </div>
    
</div>

<!-- *******************************************More about the house**********************************************  -->

<div class="tab">
    
    <div class="row">
    <div class="col-25">
    <label for="youngerMalesQty">Boys younger than age 12 *</label>
    </div>
    <div class="col-75">
    <input class="application-input" type="number" min="0" id="youngerMalesQty" name="youngerMalesQty">
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="youngerFemalesQty">Girls younger than age 12 *</label>
    </div>
    <div class="col-75">
    <input class="application-input" type="number" min="0" id="youngerFemalesQty" name="youngerFemalesQty">
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="youngerPersonsQty">Total kids below Age 12 *</label>
    </div>
    <div class="col-75">
    <input class="application-input" type="number" min="0" id="youngerPersonsQty" name="youngerPersonsQty">
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="totalKidsQty">Total kids btw 0 to 19 *</label>
    </div>
    <div class="col-75">
    <input class="application-input" type="number" min="0" id="totalKidsQty" name="totalKidsQty">
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="bedroomOvercrowd">Overcrowding by bedroom *</label>
    </div>
    <div class="col-75">
    <input class="application-input" type="number" min="0" id="bedroomOvercrowd" name="bedroomOvercrowd">
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="personsPerRoom">Max. persons per room *</label>
    </div>
    <div class="col-75">
    <input class="application-input" type="number" min="0" id="personsPerRoom" name="personsPerRoom">
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="numberOfRooms">Number of bedrooms *</label>
    </div>
    <div class="col-75">
    <input class="application-input" type="number" min="0" id="numberOfRooms" name="numberOfRooms">
    </div>
    </div>

</div>

<!-- *******************************************More about the house**********************************************  -->

<div class="tab">
    
    <div class="row">
    <div class="col-25">
    <label for="personalEducationYrs">Personal yrs of education *</label>
    </div>
    <div class="col-75">
    <input class="application-input" type="number" min="0" id="personalEducationYrs" name="personalEducationYrs">
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="headsEducationYrs">Head's yrs of education *</label>
    </div>
    <div class="col-75">
    <input class="application-input" type="number" min="0" id="headsEducationYrs" name="headsEducationYrs">
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="avgAdultEducationYrs">Avg. adult yrs of education *</label>
    </div>
    <div class="col-75">
    <input class="application-input" type="number" min="0" id="avgAdultEducationYrs" name="avgAdultEducationYrs">
    </div>
    </div>
    
    <div class="row">
    <div class="col-25">
    <label for="dependencyRate">Dependency rate *</label>
    </div>
    <div class="col-75">
    <input class="application-input" type="number" min="0" id="dependencyRate" name="dependencyRate">
    </div>
    </div>
    
</div>

<!-- *******************************************More about the house**********************************************  -->
 
  <div style="overflow:auto;">
    <div style="display: flex; justify-content: center;">
      <button class="shortprimary" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button class="shortprimary" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>
  
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:10px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
  
  </div>
</form>
  
<center><p><a href="http://sharmadese.site/povertyprediction/public/memberhome.php">Back to Home Page</a> </p></center>
 
<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("applyForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>

<?php include(SHARED_PATH . '/footer.php'); ?>