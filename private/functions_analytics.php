<?php

require_once('initialize.php');

function deployModel($model)
{
    global $db;

	$query = "UPDATE `PMT_analytics` SET `deploy_status` = '0'";
    $resultA = mysqli_query($db, $query);
    if(!$resultA)
    {
        return false;
    }
    else
    {
        $query = "UPDATE `PMT_analytics` SET `deploy_status` = '1' WHERE `model_id` = '". db_escape($db, $model) ."'";
        $resultB = mysqli_query($db, $query);
        if(!$resultB)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}

function getDeployedModel()
{
    global $db;
    
    $sql = "SELECT model_name FROM PMT_analytics WHERE deploy_status = 1";
    $result = mysqli_query($db, $sql);
    
    if (mysqli_num_rows($result) == 1)
	{
		$model_name = mysqli_fetch_assoc($result); // find first
		mysqli_free_result($result);
		return $model_name['model_name'];
	}
	else
	{
	    return "None";
	}
}

function displayPresavedDatasets()
{
    $datasets = getAvailableDatasets();
    for ($i = 0; $i < sizeof($datasets); $i++) 
    {
        echo "<option value=".$datasets[$i].">".$datasets[$i]."</option>";
    }
}

function displayPresavedModels($files)
{
    if(sizeof($files) > 0)
    {
        for ($i=0; $i<sizeof($files); $i++)
        {
            $model_id = $files[$i]['model_id'];
            $model_name = $files[$i]['model_name'];
            $accuracy = $files[$i]['model_accuracy'];
            $time_stamp = $files[$i]['time_created'];
            $algorithm = $files[$i]['algorithm_name'];
            $info = $model_name." (".$accuracy."% ".$algorithm.") - [ ".$time_stamp." ]";
            echo "<option class='listbox-option' value=".$model_id.">".$info."</option>";
        }
    }
    else
    {
        echo "<option class='listbox-option' value='' disabled>No pre-saved models available!</option>";
    }
}

function predict($predictioninputs)
{
    $message = "predict";
    $model_name = getDeployedModel();
    
    $url = "http://35.183.47.96/povertyprediction/PMT_execute.php?message=".$message."&model_name=".$model_name."&hacdor=".$predictioninputs["hacdor"]."&rooms=".$predictioninputs["rooms"]."&v18q=".$predictioninputs["v18q"]."&r4h1=".$predictioninputs["r4h1"]."&r4m1=".$predictioninputs["r4m1"]."&r4t1=".$predictioninputs["r4t1"]."&escolari=".$predictioninputs["escolari"]."&paredblolad=".$predictioninputs["paredblolad"]."&paredmad=".$predictioninputs["paredmad"]."&pisomoscer=".$predictioninputs["pisomoscer"]."&cielorazo=".$predictioninputs["cielorazo"]."&energcocinar2=".$predictioninputs["energcocinar2"]."&energcocinar4=".$predictioninputs["energcocinar4"]."&elimbasu1=".$predictioninputs["elimbasu1"]."&hogar_nin=".$predictioninputs["hogar_nin"]."&dependency=".$predictioninputs["dependency"]."&edjefe=".$predictioninputs["edjefe"]."&meaneduc=".$predictioninputs["meaneduc"]."&overcrowding=".$predictioninputs["overcrowding"]."&computer=".$predictioninputs["computer"]."&qmobilephone=".$predictioninputs["qmobilephone"]."&lugar1=".$predictioninputs["lugar1"]."&wall_condition=".$predictioninputs["wall_condition"]."&roof_condition=".$predictioninputs["roof_condition"]."&floor_condition=".$predictioninputs["floor_condition"];
    
    //Once again, we use file_get_contents to GET the URL in question.
    $predictionoutput = file_get_contents($url);
     
    //If $contents is not a boolean FALSE value.
    if($predictionoutput !== false)
    {
        $interpretedoutput = interpretPredictionOutput($predictionoutput);
        return $interpretedoutput;
        //return $predictionoutput;
    }
    else
    {
        return null;
    }   
}

function interpretPredictionOutput($predictionoutput)
{
    $potentialoutputs = array(
        "1"=>"High-Priority", 
        "2"=>"Mid-Priority",
        "3"=>"Low-Priority",
        "4"=>"INELIGIBLE");
    
    $keys = array_keys($potentialoutputs);
    for ($i = 0; $i < count($potentialoutputs); $i++) 
    {
        if($predictionoutput == $keys[$i])
        {
            return $potentialoutputs[$keys[$i]];
        }
    }
    return "None";
}

function removeModel($model)
{
    global $db;
    
    $sql = "SELECT model_name FROM PMT_analytics WHERE model_id = '". db_escape($db, $model) ."'";
    $result = mysqli_query($db, $sql);
    
    if (mysqli_num_rows($result) == 1)
	{
		$data = mysqli_fetch_assoc($result); // find first
		mysqli_free_result($result);
		$message = "remove";
		$url = "http://35.183.47.96/povertyprediction/PMT_execute.php?message=".$message."&filename=".$data['model_name'];
		
        // Once again, we use file_get_contents to GET the URL in question.
        $feedback = file_get_contents($url);
         
        // If $contents is not a boolean FALSE value.
        if(($feedback !== false) && removeModelFromDatabase($model))
        {
            return true;
        }
        else
        {
            return false;
        }
	}
	else
	{
	    return false;
	}
}

function removeModelFromDatabase($model)
{
    global $db;

	$query = "DELETE FROM `PMT_analytics` WHERE `model_id` = '". db_escape($db, $model) ."'";
    $result = mysqli_query($db, $query);
    
    if($result)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function getAllModels()
{
	global $db;
    
    $files = array();
    
    $sql = "SELECT * FROM PMT_analytics";
    $result = mysqli_query($db, $sql);
    
    while($one_file = mysqli_fetch_assoc($result))
    {
        array_push($files, $one_file);   
    }
    
    if(!empty($files))
    {
        mysqli_free_result($result);
        return $files;
    }
    else
    {
        return null;
    }
}

function interpretAlgorithmNumber($algorithm_number)
{
    $allalgorithms = array(
        "1"=>"Random Forest", 
        "2"=>"Logistic Regression", 
        "3"=>"Support Vector Machine",
        "4"=>"Multi Layer Perceptron",
        "5"=>"Gradient Boosting");
    
    $keys = array_keys($allalgorithms);
    for ($i = 0; $i < count($allalgorithms); $i++) 
    {
        if($algorithm_number == $keys[$i])
        {
            return $allalgorithms[$keys[$i]];
        }
    }
    return "issue";
}

function getAvailableDatasets() 
{
    $message = "csvfilesquantity";
    
    $url = "http://35.183.47.96/povertyprediction/PMT_execute.php?message=".$message;
     
    // Once again, we use file_get_contents to GET the URL in question.
    $datasetqty = file_get_contents($url);
     
    // If $contents is not a boolean FALSE value.
    if($datasetqty !== false)
    {
        $datasets = array();
        for ($i = 0; $i < $datasetqty; $i++) 
        {
            $message = "listofcsvfiles";
            
            $url = "http://35.183.47.96/povertyprediction/PMT_execute.php?message=".$message."&index=".$i;
            
            // Once again, we use file_get_contents to GET the URL in question.
            $feedback = file_get_contents($url);
             
            // If $contents is not a boolean FALSE value.
            if($feedback !== false)
            {
                array_push($datasets, $feedback);
            }
        }
        return $datasets;
    }
    else
    {
        $_SESSION['errorFeedback'] = "Unable to load existing datasets!";
    }
}

function retrainModel($dataset_name, $algorithm_name)
{
    $message = "train";
    
    $url = "http://35.183.47.96/povertyprediction/PMT_execute.php?message=".$message."&dataset_name=".$dataset_name."&algorithm_number=".$algorithm_name;
     
    // Once again, we use file_get_contents to GET the URL in question.
    $feedback = file_get_contents($url);
    $feedback = preg_replace('/\s+/', '', $feedback);
     
    // If $contents is not a boolean FALSE value.
    if(($feedback !== false))
    {
        return $feedback;
    }
    else
    {
        return false;
    }
}

function saveModel($dataset_name, $algorithm_name, $model_name)
{
    $message = "save";
    
    $url = "http://35.183.47.96/povertyprediction/PMT_execute.php?message=".$message."&dataset_name=".$dataset_name."&algorithm_number=".$algorithm_name."&model_name=".$model_name;
     
    // Once again, we use file_get_contents to GET the URL in question.
    $feedback = file_get_contents($url);
     
    // If $contents is not a boolean FALSE value.
    if($feedback !== false)
    {
        $accuracy = $feedback;
        date_default_timezone_set("America/New_York");
        $time = date("l-m-Y (h:i:sa)");
        if(saveModelToDatabase($dataset_name, $algorithm_name, $model_name, $accuracy, $time))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
         return false;
    }
}

function saveModelToDatabase($dataset_name, $algorithm_number, $model_name, $accuracy, $time)
{
    global $db;
    
    $algorithm_name = interpretAlgorithmNumber($algorithm_number);
    
    $sql = "INSERT INTO `PMT_analytics` (model_name, algorithm_name,model_accuracy, time_created, deploy_status) 
    VALUES ('".$model_name.".pkl', '".$algorithm_name."', '".$accuracy."','".$time."', 0)";
    
    if(mysqli_query($db, $sql))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function request_line_number($linenumber)
{
    $message = "getrandomrow";
    
    $url = "http://35.183.47.96/povertyprediction/PMT_execute.php?message=".$message."&linenumber=".$linenumber;
     
    // Once again, we use file_get_contents to GET the URL in question.
    $feedback = file_get_contents($url);
    $feedback = preg_replace('/\s+/', '', $feedback);
     
    // If $contents is not a boolean FALSE value.
    if(($feedback !== false))
    {
        return $feedback;
    }
    else
    {
        return false;
    }
}

function displayPredictionResults()
{
    if(sizeof($_SESSION['predictionoutput']) > 0)
    {
        for ($i=0; $i<sizeof($_SESSION['predictionoutput']); $i++)
        {
            echo "<tr>";
            echo "<td> Application ID. ".$_SESSION['predictionoutput'][$i]['application_id']."</td>";
            echo "<td>".$_SESSION['predictionoutput'][$i]['applicant_region']."</td>";
            echo "<td>".$_SESSION['predictionoutput'][$i]['application_status']."</td>";
            
            if(($_SESSION['predictionoutput'][$i]['application_eligibility'] == "High-Priority") ||
                ($_SESSION['predictionoutput'][$i]['application_eligibility'] == "Mid-Priority") ||
                ($_SESSION['predictionoutput'][$i]['application_eligibility'] == "Low-Priority"))
            {
                echo "<td><font color=green><b>".$_SESSION['predictionoutput'][$i]['application_eligibility']."</b></td>";
            }
            else if ($_SESSION['predictionoutput'][$i]['application_eligibility'] == "INELIGIBLE")
            {
                echo "<td><font color=red><b>".$_SESSION['predictionoutput'][$i]['application_eligibility']."</b></td>";
            }
            else
            {
                echo "<td><font color=red><b>Unidentifed Result</b></td>";
            }
            
            echo "</tr>";
        }
    }
    else
    {
        echo "<tr>";
        echo "<td>-</td>";
        echo "<td>-</td>";
        echo "</tr>";
    }
}

function displayTestModelResults()
{
    if(sizeof($_SESSION['testmodelresults']) > 0)
    {
        for ($i=0; $i<sizeof($_SESSION['testmodelresults']); $i++)
        {
            echo "<tr>";
            echo "<td> Row Number ".$_SESSION['testmodelresults'][$i]['line_number']."</td>";
            echo "<td><b>".$_SESSION['testmodelresults'][$i]['actual_poverty_class']."</b></td>";
            echo "<td><b>".$_SESSION['testmodelresults'][$i]['predicted_poverty_class']."</b></td>";
            if($_SESSION['testmodelresults'][$i]['score'] == "CORRECT")
            {
                echo "<td><font color=green><b>".$_SESSION['testmodelresults'][$i]['score']."</b></td>";
            }
            else if ($_SESSION['testmodelresults'][$i]['score'] == "WRONG")
            {
                echo "<td><font color=red><b>".$_SESSION['testmodelresults'][$i]['score']."</b></td>";
            }
            else
            {
                echo "<td><font color=red><b>Unidentifed Result</b></td>";
            }
            echo "</tr>";
        }
    }
    else
    {
        echo "<tr>";
        echo "<td>-</td>";
        echo "<td>-</td>";
        echo "<td>-</td>";
        echo "</tr>";
    }
}

?>