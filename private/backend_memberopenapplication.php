<?php

require_once('initialize.php');

if(isset($_POST["edit"]))
{
    
}
else if(isset($_POST["withdraw"]))
{
    withdrawApplication($fullapplicationinfo['applicationID']);
    header("Location: ../public/memberopenapplication.php");
}
else
{
    /*Do nothing*/
}

?>