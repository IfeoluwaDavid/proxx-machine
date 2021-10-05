<?php

require_once('initialize.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if(isset($_POST["view"]))
    {
        if(sizeof($_POST["selectedapplications"]) == 1)
        {
            $_SESSION['selectedapplicationid'] = $_POST["selectedapplications"][0];
            header("Location: ../public/adminviewapplication.php");
        }
        else if(sizeof($_POST["selectedapplications"]) > 1)
        {
            $_SESSION['errorFeedback'] = "Only one application can be opened at a time!";
            header("Location: ../public/adminhome.php");
        }
        else
        {
            /*Do nothing just refresh*/
            header("Location: ../public/adminhome.php");  
        }
    }
    else if(isset($_POST["process"]) && !empty($_POST["selectedapplications"]))
    {
        if(sizeof($_POST["selectedapplications"]) >= 1)
        {
            $model_name = getDeployedModel();
            
            if($model_name == "None")
            {
                 $_SESSION['errorFeedback'] = "You have no model deployed at the moment.!";
                 header("Location: ../public/adminhome.php");
            }
            else
            {
                $predictionoutput = array();
                $predictionresults = array();
                
                for($i=0; $i<sizeof($_POST["selectedapplications"]); $i++)
                {
                    $fullapplicationinfo = getFullApplicationData($_POST["selectedapplications"][$i]);
                    $predictionoutput = prepareinputs($fullapplicationinfo);
                    array_push($predictionresults, $predictionoutput);
                }
                
                //var_dump($predictionresults);
                
                $_SESSION['predictionoutput'] = $predictionresults;
                header("Location: ../public/adminpredictionresults.php");
            }
        }
        else
        {
            /*Do nothing just refresh*/
            header("Location: ../public/adminhome.php");  
        }
    }
    else if(isset($_POST["approve"]) && !empty($_POST["selectedapplications"]))
    {
        if(sizeof($_POST["selectedapplications"]) >= 1)
        {
            for($i=0; $i<sizeof($_POST["selectedapplications"]); $i++)
            {
                $fullapplicationinfo = getFullApplicationData($_POST["selectedapplications"][$i]);
                if(setApplicationStatus($fullapplicationinfo['applicationID'], "Approved"))
                {
                    $_SESSION["successFeedback"] = "Application status updated! Refresh Page!";
                }
                else
                {
                    $_SESSION["errorFeedback"] = "Unable to update application status. Please try again!";
                }
            }
        }
        header("Location: ../public/adminhome.php");  
    }
    else if(isset($_POST["disapprove"]) && !empty($_POST["selectedapplications"]))
    {
        if(sizeof($_POST["selectedapplications"]) >= 1)
        {
            for($i=0; $i<sizeof($_POST["selectedapplications"]); $i++)
            {
                $fullapplicationinfo = getFullApplicationData($_POST["selectedapplications"][$i]);
                if(setApplicationStatus($fullapplicationinfo['applicationID'], "Disapproved"))
                {
                    $_SESSION["successFeedback"] = "Application status updated! Refresh Page!";
                }
                else
                {
                    $_SESSION["errorFeedback"] = "Unable to update application status. Please try again!";
                }
            }
        }
        header("Location: ../public/adminhome.php");  
    }
    else if(isset($_POST["pend"]) && !empty($_POST["selectedapplications"]))
    {
        if(sizeof($_POST["selectedapplications"]) >= 1)
        {
            for($i=0; $i<sizeof($_POST["selectedapplications"]); $i++)
            {
                $fullapplicationinfo = getFullApplicationData($_POST["selectedapplications"][$i]);
                if(setApplicationStatus($fullapplicationinfo['applicationID'], "Pending"))
                {
                    $_SESSION["successFeedback"] = "Application status updated! Refresh Page!";
                }
                else
                {
                    $_SESSION["errorFeedback"] = "Unable to update application status. Please try again!";
                }
            }
        }
        header("Location: ../public/adminhome.php");  
    }
    else
    {
        /*Do nothing just refresh*/
        header("Location: ../public/adminhome.php");  
    }
}

?>