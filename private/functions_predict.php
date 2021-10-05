<?php

require_once('initialize.php');

/******************************************************************************************** Required prediction features */

function prepare_test_and_predict($data)
{
    global $testInputFeatures;
    
    $testInputFeatures = array(
        "row_number"=>$data[0],
        "hacdor"=>$data[1],
        "rooms"=>$data[2],
        "v18q"=>$data[3],
        "r4h1"=>$data[4],
        "r4m1"=>$data[5],
        "r4t1"=>$data[6],
        "escolari"=>$data[7],
        "paredblolad"=>$data[8],
        "paredmad"=>$data[9],
        "pisomoscer"=>$data[10],
        "cielorazo"=>$data[11],
        "energcocinar2"=>$data[12],
        "energcocinar4"=>$data[13],
        "elimbasu1"=>$data[14],
        "hogar_nin"=>$data[15],
        "dependency"=>$data[16],
        "edjefe"=>$data[17],
        "meaneduc"=>$data[18],
        "overcrowding"=>$data[19],
        "computer"=>$data[20],
        "qmobilephone"=>$data[21],
        "lugar1"=>$data[22],
        "wall_condition"=>$data[23],
        "roof_condition"=>$data[24],
        "floor_condition"=>$data[25],
        "Target"=>$data[26]);
    
    $test_prediction_output = predict($testInputFeatures);
    //return $test_prediction_output;
    
    $feedback_data = array(
        "line_number"=>null,
        "actual_poverty_class"=>null,
        "predicted_poverty_class"=>null,
        "score"=>null);
            
    $feedback_data['line_number'] = $testInputFeatures['row_number'];
    $feedback_data['actual_poverty_class'] = interpretPredictionOutput($testInputFeatures['Target']);
    $feedback_data['predicted_poverty_class'] = $test_prediction_output;
    if($feedback_data['actual_poverty_class'] == $feedback_data['predicted_poverty_class'])
    {
        $feedback_data['score'] = "CORRECT";
    }
    else
    {
        $feedback_data['score'] = "WRONG";
    }
    return $feedback_data;
}

function prepareinputs($fullapplicationinfo)
{
    global $inputFeatures;
    
    $inputFeatures = array(
        "v18q"=>0,
        "computer"=>0,
        "qmobilephone"=>0,
        "r4h1"=>0,
        "r4m1"=>0,
        "r4t1"=>0,
        "hogar_nin"=>0,	
        "hacdor"=>0,
        "overcrowding"=>0,
        "rooms"=>0,
        "paredblolad"=>0,
        "paredmad"=>0,
        "pisomoscer"=>0,
        "cielorazo"=>0,
        "wall_condition"=>0,
        "roof_condition"=>0,
        "floor_condition"=>0,
        "elimbasu1"=>0,
        "lugar1"=>0,
        "energcocinar2"=>0,
        "energcocinar4"=>0,
        "escolari"=>0,
        "meaneduc"=>0,
        "dependency"=>0,
        "edjefe"=>0);
        
    $inputFeatures = interpretWallMaterial($fullapplicationinfo['wallMaterial'], $inputFeatures);
    $inputFeatures = interpretFloorMaterial($fullapplicationinfo['floorMaterial'], $inputFeatures);
    $inputFeatures = interpretRoofMaterial($fullapplicationinfo['roofMaterial'], $inputFeatures);
    $inputFeatures = interpretEnergySource($fullapplicationinfo['energySource'], $inputFeatures);
    $inputFeatures = interpretDisposalMethod($fullapplicationinfo['disposalMethod'], $inputFeatures);
    $inputFeatures = interpretHomeRegion($fullapplicationinfo['homeRegion'], $inputFeatures);
    
    $inputFeatures = interpretOrdinal($fullapplicationinfo['wallCondition'], $inputFeatures, "wall_condition");
    $inputFeatures = interpretOrdinal($fullapplicationinfo['floorCondition'], $inputFeatures, "floor_condition");
    $inputFeatures = interpretOrdinal($fullapplicationinfo['roofCondition'], $inputFeatures, "roof_condition");

    $inputFeatures = interpretBinary($fullapplicationinfo['hasTablet'], $inputFeatures, "v18q"); 
    $inputFeatures = interpretBinary($fullapplicationinfo['hasComputer'], $inputFeatures, "computer");
    
    $inputFeatures = interpretNumerical($fullapplicationinfo['mobileQty'], $inputFeatures, "qmobilephone");
    $inputFeatures = interpretNumerical($fullapplicationinfo['youngerMalesQty'], $inputFeatures, "r4h1");
    $inputFeatures = interpretNumerical($fullapplicationinfo['youngerFemalesQty'], $inputFeatures, "r4m1");
    $inputFeatures = interpretNumerical($fullapplicationinfo['youngerPersonsQty'], $inputFeatures, "r4t1");
    $inputFeatures = interpretNumerical($fullapplicationinfo['totalKidsQty'], $inputFeatures, "hogar_nin");
    $inputFeatures = interpretNumerical($fullapplicationinfo['bedroomOvercrowd'], $inputFeatures, "hacdor");
    $inputFeatures = interpretNumerical($fullapplicationinfo['personsPerRoom'], $inputFeatures, "overcrowding");
    $inputFeatures = interpretNumerical($fullapplicationinfo['numberOfRooms'], $inputFeatures, "rooms");
    $inputFeatures = interpretNumerical($fullapplicationinfo['personalEducationYrs'], $inputFeatures, "escolari");
    $inputFeatures = interpretNumerical($fullapplicationinfo['headsEducationYrs'], $inputFeatures, "edjefe");
    $inputFeatures = interpretNumerical($fullapplicationinfo['avgAdultEducationYrs'], $inputFeatures, "meaneduc");
    $inputFeatures = interpretNumerical($fullapplicationinfo['dependencyRate'], $inputFeatures, "dependency");
    
    $prediction_output = predict($inputFeatures);
    
    //return $prediction_output;
    
    $applications = array(
        "application_id"=>null,
        "applicant_region"=>null,
        "application_status"=>null,
        "application_eligibility"=>null);
            
    $applications['application_id'] = $fullapplicationinfo['applicationID'];
    $applications['applicant_region'] = $fullapplicationinfo['homeRegion'];
    $applications['application_status'] = $fullapplicationinfo['applicationstatus'];
    $applications['application_eligibility'] = $prediction_output;
    return $applications;
}

/******************************************************************************************** Nominal Interpretation Functions */

function interpretWallMaterial($selectedWallMaterial, $inputFeatures)
{
    if($selectedWallMaterial == "Brick")
    {
        $inputFeatures['paredblolad'] = '1.0';
    }
    else if($selectedWallMaterial == "Wood")
    {
        $inputFeatures['paredmad'] = '1.0';
    }
    else
    {
        /* Do nothing - Let both values remain 0 */
    }
    return $inputFeatures;
}

function interpretFloorMaterial($selectedFloorMaterial, $inputFeatures)
{
    if($selectedFloorMaterial == "Ceramic")
    {
        $inputFeatures['pisomoscer'] = '1.0';
    }
    return $inputFeatures;
}

function interpretRoofMaterial($selectedRoofMaterial, $inputFeatures)
{
    if($selectedRoofMaterial == "No Ceiling")
    {
        $inputFeatures['cielorazo'] = '1.0';
    }
    return $inputFeatures;
}

function interpretEnergySource($selectedEnergySource, $inputFeatures)
{
    if($selectedEnergySource == "Electricity")
    {
        $inputFeatures['energcocinar2'] = '1.0';
    }
    else if($selectedEnergySource == "Wood / Charcoal")
    {
        $inputFeatures['energcocinar4'] = '1.0';
    }
    else
    {
        /* Do nothing - Let both values remain 0 */
    }
    return $inputFeatures;
}

function interpretDisposalMethod($selectedDisposalMethod, $inputFeatures)
{
    if($selectedDisposalMethod == "Tanker Truck")
    {
        $inputFeatures['elimbasu1'] = '1.0';
    }
    return $inputFeatures;
}

function interpretHomeRegion($selectedHomeRegion, $inputFeatures)
{
    if($selectedHomeRegion == "Central Region")
    {
        $inputFeatures['lugar1'] = '1.0';
    }
    return $inputFeatures;
}

/******************************************************************************************** Ordinal Interpretation Functions */

function interpretOrdinal($ordinalInput, $inputFeatures, $featurecodename)
{
    if($ordinalInput == "Bad")
    {
        $inputFeatures[$featurecodename] = '1.0';
    }
    else if($ordinalInput == "Regular")
    {
        $inputFeatures[$featurecodename] = '2.0';
    }
    else if($ordinalInput == "Good")
    {
        $inputFeatures[$featurecodename] = '3.0';
    }
    else
    {
        /* Do Nothing */
    }
    return $inputFeatures;
}

/******************************************************************************************** Binary Interpretation Functions */

function interpretBinary($binaryInput, $inputFeatures, $featurecodename)
{
    if($binaryInput == "Yes")
    {
        $inputFeatures[$featurecodename] = '1.0';
    }
    else if($binaryInput == "No")
    {
        $inputFeatures[$featurecodename] = '0.0';
    }
    else
    {
        /* Do Nothing */
    }
    return $inputFeatures;
}

/******************************************************************************************** Numerical Interpretation Functions */

function interpretNumerical($numericalInput, $inputFeatures, $featurecodename)
{
    $inputFeatures[$featurecodename] = $numericalInput;
    return $inputFeatures;
}

/******************************************************************************************** The End */

?>