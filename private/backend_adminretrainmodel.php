<?php

require_once('initialize.php');

if(isset($_POST["retrain"]))
{
    $dataset_name = $_POST['datasetname'];
    $algorithm_name = $_POST['algorithmname'];
    
    if(empty($dataset_name) || empty($algorithm_name))
    {
        $_SESSION['errorFeedback'] = "The required information is incomplete!";
    }
    else
    {
        $accuracyfeedback = retrainModel($dataset_name, $algorithm_name);
        if(is_numeric($accuracyfeedback))
        {
            $_SESSION['successFeedback'] = "Training Complete (Model Accuracy - ".$accuracyfeedback."%)";
        }
        else
        {
            $_SESSION['errorFeedback'] = "Training Failed on Remote Server! (Unknown Reason)";
        }
    }
    header("Location: ../public/adminretrainmodel.php");
}
else if(isset($_POST["save"]))
{
    $model_name = $_POST['modelname'];
    $dataset_name = $_POST['datasetname'];
    $algorithm_name = $_POST['algorithmname'];
    
    if(empty($model_name) || empty($dataset_name) || empty($algorithm_name))
    {
        $_SESSION['errorFeedback'] = "The required information is incomplete!";
    }
    else
    {
        if(saveModel($dataset_name, $algorithm_name, $model_name))
        {
            $_SESSION['successFeedback'] = "Model has been successfully saved!";
        }
        else
        {
            $_SESSION['errorFeedback'] = "Model Training Failed! (Unknown Reason)";
        }
    }
    header("Location: ../public/adminretrainmodel.php");
}
else
{
    /* Do nothing */
    header("Location: ../public/adminretrainmodel.php");
}

?>