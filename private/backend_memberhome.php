<?php

require_once('initialize.php');

if(isset($_POST["newapplication"]))
{
    if(($_SESSION['userheadofhousestatus'] == 1))
    {
        if(!checkforExistingApplications($_SESSION['userhouseholdid']))
        {
            header("Location: ../public/memberapply.php");
        }
        else
        {
            $_SESSION['errorFeedback'] = "Please withdraw or delete your existing applications first!";
            header("Location: ../public/memberhome.php");
        }
    }
    else
    {
       $_SESSION['errorFeedback'] = "Only the head of house is allowed to create new applications!";
    }
}
else if(isset($_POST["withdrawapplication"]) && !empty($_POST["selectedapplication"]))
{
    withdrawApplication($_POST["selectedapplication"]);
    header("Location: ../public/memberhome.php");
}
else if(isset($_POST["openapplication"]) && !empty($_POST["selectedapplication"]))
{
    $_SESSION['applicationid'] = $_POST["selectedapplication"];
    header("Location: ../public/memberopenapplication.php");
}
else
{
    /* Do nothing just refresh */
    //header("Location: ../public/memberhome.php");
}

?>