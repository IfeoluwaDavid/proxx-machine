<?php

include('initialize.php');

if(request_is_post()) 
{
    $applicantID = $_SESSION['userid'];
    $householdID = $_SESSION['userhouseholdid'];
    
    $housetype = $_POST['housetype'] ?? '';
    $wallMaterial = $_POST['wallMaterial'] ?? '';
    $floorMaterial = $_POST['floorMaterial'] ?? '';
    $roofMaterial = $_POST['roofMaterial'] ?? '';
    $wallCondition = $_POST['wallCondition'] ?? '';
    $floorCondition = $_POST['floorCondition'] ?? '';
    $roofCondition = $_POST['roofCondition'] ?? '';
    
    $homeRegion = $_POST['homeRegion'] ?? '';
    $regionZone = $_POST['regionZone'] ?? '';
    $disposalMethod = $_POST['disposalMethod'] ?? '';
    $drainageMethod = $_POST['drainageMethod'] ?? '';
    $energySource = $_POST['energySource'] ?? '';
    $electricitySource = $_POST['electricitySource'] ?? '';
    $waterSource = $_POST['waterSource'] ?? '';
    
    $homeOwnershipStatus = $_POST['homeOwnershipStatus'] ?? '';
    $hasTablet = $_POST['hasTablet'] ?? '';
    $hasComputer = $_POST['hasComputer'] ?? '';
    $hasFridge = $_POST['hasFridge'] ?? '';
    $internetAvailability = $_POST['internetAvailability'] ?? '';
    $vehiclesOwned = $_POST['vehiclesOwned'] ?? '';
    $mobileQty = $_POST['mobileQty'] ?? '';
    
    $youngerMalesQty = $_POST['youngerMalesQty'] ?? '';
    $youngerFemalesQty = $_POST['youngerFemalesQty'] ?? '';
    $youngerPersonsQty = $_POST['youngerPersonsQty'] ?? '';
    $totalKidsQty = $_POST['totalKidsQty'] ?? '';
    $bedroomOvercrowd = $_POST['bedroomOvercrowd'] ?? '';
    $personsPerRoom = $_POST['personsPerRoom'] ?? '';
    $numberOfRooms = $_POST['numberOfRooms'] ?? '';
    
    $personalEducationYrs = $_POST['personalEducationYrs'] ?? '';
    $headsEducationYrs = $_POST['headsEducationYrs'] ?? '';
    $avgAdultEducationYrs = $_POST['avgAdultEducationYrs'] ?? '';
    $dependencyRate = $_POST['dependencyRate'] ?? '';
    
    $applicationInfo = array
    ("applicantID"=>$applicantID,
    "householdID"=>$householdID,
        
    "housetype"=>$housetype,
    "wallMaterial"=>$wallMaterial,
    "floorMaterial"=>$floorMaterial,
    "roofMaterial"=>$roofMaterial,
    "wallCondition"=>$wallCondition,
    "floorCondition"=>$floorCondition,
    "roofCondition"=>$roofCondition,
    
    "homeRegion"=>$homeRegion,
    "regionZone"=>$regionZone,
    "disposalMethod"=>$disposalMethod,
    "drainageMethod"=>$drainageMethod,
    "energySource"=>$energySource,
    "electricitySource"=>$electricitySource,
    "waterSource"=>$waterSource,
    
    "homeOwnershipStatus"=>$homeOwnershipStatus,
    "hasTablet"=>$hasTablet,
    "hasComputer"=>$hasComputer,
    "hasFridge"=>$hasFridge,
    "internetAvailability"=>$internetAvailability,
    "vehiclesOwned"=>$vehiclesOwned,
    "mobileQty"=>$mobileQty,
    
    "youngerMalesQty"=>$youngerMalesQty,
    "youngerFemalesQty"=>$youngerFemalesQty,
    "youngerPersonsQty"=>$youngerPersonsQty,
    "totalKidsQty"=>$totalKidsQty,
    "bedroomOvercrowd"=>$bedroomOvercrowd,
    "personsPerRoom"=>$personsPerRoom,
    "numberOfRooms"=>$numberOfRooms,
    
    "personalEducationYrs"=>$personalEducationYrs,
    "headsEducationYrs"=>$headsEducationYrs,
    "avgAdultEducationYrs"=>$avgAdultEducationYrs,
    "dependencyRate"=>$dependencyRate);
    
    $keys = array_keys($applicationInfo); 
    for ($i = 0; $i < count($applicationInfo); $i++) 
    {
        if(is_null($applicationInfo[$keys[$i]]))
        {
            $_SESSION["errorFeedback"] = "Incomplete Application Form!";
            header("Location: ../public/memberhome.php");
        }
    }
    
    $applicationSubmitted = saveApplication($applicationInfo, $keys);
    
    //var_dump($applicationInfo);
    //var_dump($applicationSubmitted);
    
    if(!$applicationSubmitted)
    {
        $_SESSION["errorFeedback"] = "Unable to submit your application!";
        header("Location: ../public/memberhome.php");
    }
    else
    {
        $_SESSION["successFeedback"] = "Application Successfully Submitted!";
        header("Location: ../public/memberhome.php");
    }
}

?>