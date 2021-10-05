<?php

require_once('initialize.php');

if(isset($_POST["process"]))
{
    $_SESSION['predictionoutput'] = array();
    $predictionoutput = prepareinputs($_SESSION['fullapplicationinfo']);
    array_push($_SESSION['predictionoutput'], $predictionoutput);
    header("Location: ../public/adminpredictionresults.php");
}
else if(isset($_POST["approve"]))
{
    if(setApplicationStatus($_SESSION['fullapplicationinfo']['applicationID'], "Approved"))
    {
        $_SESSION["successFeedback"] = "Application status updated! Refresh Page!";
    }
    else
    {
        $_SESSION["errorFeedback"] = "Unable to update application status. Please try again!";
    }
    header("Location: ../public/adminviewapplication.php");
}
else if(isset($_POST["disapprove"]))
{
    if(setApplicationStatus($_SESSION['fullapplicationinfo']['applicationID'], "Disapproved"))
    {
        $_SESSION["successFeedback"] = "Application status updated! Refresh Page!";
    }
    else
    {
        $_SESSION["errorFeedback"] = "Unable to update application status. Please try again!";
    }
    header("Location: ../public/adminviewapplication.php");
}
else if(isset($_POST["pend"]))
{
    if(setApplicationStatus($_SESSION['fullapplicationinfo']['applicationID'], "Pending"))
    {
        $_SESSION["successFeedback"] = "Application status updated! Refresh Page!";
    }
    else
    {
        $_SESSION["errorFeedback"] = "Unable to update application status. Please try again!";
    }
    header("Location: ../public/adminviewapplication.php");
}
else
{
    /*Do nothing just refresh*/
    header("Location: ../public/adminviewapplication.php");
}

?>