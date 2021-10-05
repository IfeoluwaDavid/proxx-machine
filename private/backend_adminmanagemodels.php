<?php

require_once('initialize.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST["selectedfile"]))
{
    if(isset($_POST["deploy"]))
    {
        if(!(deployModel($_POST["selectedfile"])))
        {
            $_SESSION["errorFeedback"] = "Oops! Unable to deploy model!";
        }
        else
        {
            $_SESSION["successFeedback"] = "Deployment Successful! Future Predictions will utilize this model.";
        }
    }
    else if(isset($_POST["remove"]))
    {
        if(!(removeModel($_POST["selectedfile"])))
        {
             $_SESSION['errorFeedback'] = "Something went wrong while deleting model from server!";
        }
        else
        {
            $_SESSION["successFeedback"] = "Model has been deleted successfully!.";
        }
    }
    else
    {
        /*Do nothing just refresh*/
    }
    header("Location: ../public/adminmanagemodels.php");
}
else
{
    /*Do nothing just refresh*/
    header("Location: ../public/adminmanagemodels.php");
}

?>