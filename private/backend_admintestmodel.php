<?php

require_once('initialize.php');

if(isset($_POST["test"]))
{
    $linenumbers = preg_replace('/\s+/', '', $_POST['linenumbers']);
    
    if(empty($linenumbers))
    {
        $_SESSION['errorFeedback'] = "The required information is incomplete!";
    }
    else
    {
        $results_array = array();
        $linenumbers_array = array();
        $linenumbers_array = explode(',', $linenumbers);

        for ($i = 0; $i < count($linenumbers_array); $i++) 
        {
            if(!(($linenumbers_array[$i] >= 1) && ($linenumbers_array[$i] <= 9557)))
            {
                $_SESSION['errorFeedback'] = "One of your inputs is out of the specified range!";
                header("Location: ../public/admintestmodel.php");
                exit();
            }
            $line_number_data = request_line_number($linenumbers_array[$i]);
            array_push($results_array, $line_number_data);
        }
        
        $feedbacks = array();
        for ($i = 0; $i < count($results_array); $i++)
        {
            $line_number_data = explode(',', $results_array[$i]);
            $output = prepare_test_and_predict($line_number_data);
            array_push($feedbacks, $output);
        }
        //var_dump($feedbacks);
        $_SESSION['testmodelresults'] = $feedbacks;
    }
    header("Location: ../public/admintestmodelresults.php");
}
else
{
    /* Do nothing */
    header("Location: ../public/admintestmodel.php");
}

?>