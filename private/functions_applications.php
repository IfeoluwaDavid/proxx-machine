<?php

require_once('functions_others.php');

function find_user_with_email($email) 
{
    global $db;
    
    $sql = "SELECT * FROM PMT_userinfo WHERE email = '". db_escape($db, $email) ."'";
    $result = mysqli_query($db, $sql);
    
    if (mysqli_num_rows($result) == 1)
	{
		$user = mysqli_fetch_assoc($result); // find first
		mysqli_free_result($result);
		return $user;
	}
	else
	{
	    return null; 
	}
}

function withdrawApplication($applicationid)
{
    global $db;

	$query = "DELETE FROM `PMT_applications` WHERE `applicationID` = '". db_escape($db, $applicationid) ."'";
    $result = mysqli_query($db, $query);
    
    if(!$result)
    {
        $_SESSION["errorFeedback"] = "Oops! Query failed. Unable to withdraw application!";
    }
    else
    {
        $_SESSION["successFeedback"] = "Application successfully withdrawn! Please refresh page.";
    }
}

function getHeadofHouse($householdid) 
{
    global $db;
    
    $sql = "SELECT * FROM PMT_userinfo WHERE headofhouse = '1' AND householdid = '". db_escape($db, $householdid) ."'";
    $result = mysqli_query($db, $sql);
    
    if (mysqli_num_rows($result) == 1)
	{
		$headofhouse = mysqli_fetch_assoc($result); // find first
		mysqli_free_result($result);
		return $headofhouse;
	}
	else
	{
	    return null; 
	}
}

function getHeadofHouseEducationalLevel($householdid) 
{
    global $db;
    
    $sql = "SELECT highest_education FROM PMT_userinfo WHERE householdid = '". db_escape($db, $householdid) ."' AND headofhouse = 1";
    $result = mysqli_query($db, $sql);
    
    if (mysqli_num_rows($result) == 1)
	{
		$educationallevel = mysqli_fetch_assoc($result); // find first
		mysqli_free_result($result);
		return $educationallevel['highest_education'];
	}
	else
	{
	    return "No Education"; 
	}
}

function getAllApplications() 
{
    global $db;
    
    $allapplications = array();
    
    $sql = "SELECT applicationID, homeRegion, applicationstatus, householdid FROM PMT_applications";
    $result = mysqli_query($db, $sql);
    
    while($applicationrow = mysqli_fetch_assoc($result))
    {
        array_push($allapplications, $applicationrow);   
    }
    
    if(!empty($allapplications))
    {
        mysqli_free_result($result);
        return $allapplications;
    }
    else
    {
        return null;
    }
}

function checkforExistingApplications($householdid) 
{
    global $db;
    
    $sql = "SELECT * FROM PMT_applications WHERE householdid = '". db_escape($db, $householdid) ."'";
    $result = mysqli_query($db, $sql);
    
    if (mysqli_num_rows($result) >= 1)
	{
		return true;
	}
	else
	{
	    return false; 
	}
}

function saveApplication($applicationInfo, $keys) 
{
    global $db;
    
    $sql = "INSERT INTO `PMT_applications` (applicantID) VALUES (".$applicationInfo['applicantID'].")";
    
    if(mysqli_query($db, $sql))
    {
        for ($i = 0; $i< count($applicationInfo);$i++)
        {
            $query = "UPDATE `PMT_applications` SET `".$keys[$i]."` = '".$applicationInfo[$keys[$i]]."' WHERE `applicantID` = ".$applicationInfo['applicantID'];
            $result = mysqli_query($db, $query);
            if(!$result)
            {
                $query = "DELETE FROM `PMT_applications` WHERE `applicantID` = '".$applicationInfo['applicantID']."'";
                mysqli_query($db, $query);
                return false;
            }
        }
        return true;
    }
    else
    {
        return false;
    }
}

function getApplications($householdid) 
{
    global $db;
    
    $allapplications = array();
    
    $sql = "SELECT * FROM PMT_applications WHERE householdid = '". db_escape($db, $householdid) ."'";
    $result = mysqli_query($db, $sql);
    
    while($applicationrow = mysqli_fetch_assoc($result))
    {
        array_push($allapplications, $applicationrow);   
    }
    
    if(!empty($allapplications))
    {
        mysqli_free_result($result);
        return $allapplications;
    }
    else
    {
        return null;
    }
}

function displaySubmittedApplications($allapplications)
{
    if(sizeof($allapplications) > 0)
    {
        for ($i=0; $i<sizeof($allapplications); $i++)
        {
            $app_id = $allapplications[$i]['applicationID'];
            $app_region = $allapplications[$i]['homeRegion'];
            $app_householdid = $allapplications[$i]['householdid'];
            $app_status = $allapplications[$i]['applicationstatus'];
            $info = "[ Application ".$app_id." | Household ".$app_householdid." | ".$app_region." ] - ".$app_status;
            echo "<option class='listbox-option' value='$app_id'>".$info."</option>";   
        }
    }
    else
    {
        echo "<option class='listbox-option' disabled>No applications yet</option>";
    }
}

function setApplicationStatus($applicationid, $newApplicationStatus) 
{
    global $db;
    
    $sql = "SELECT * FROM PMT_applications WHERE applicationID = '". db_escape($db, $applicationid) ."'";
    $resultA = mysqli_query($db, $sql);
    
    if (mysqli_num_rows($resultA) == 1)
	{
		$query = "UPDATE `PMT_applications` SET `applicationstatus` = '". db_escape($db, $newApplicationStatus) ."' WHERE `applicationID` = '". db_escape($db, $applicationid) ."'";
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
	else
	{
	    return false;
	}
}

function getFullApplicationData($applicationid) 
{
    global $db;
    
    $sql = "SELECT * FROM PMT_applications WHERE applicationID = '". db_escape($db, $applicationid) ."'";
    $result = mysqli_query($db, $sql);
    
    if (mysqli_num_rows($result) == 1)
	{
		$fullapplicationinfo = mysqli_fetch_assoc($result); // find first
		mysqli_free_result($result);
		return $fullapplicationinfo;
	}
	else
	{
	    return null; 
	}
}

function login_user($user)
{
    //Renerating the ID protects the admin from session fixation.
    session_regenerate_id();
    
    $_SESSION['userid'] = trim($user['userid']);
    $_SESSION['userfirstname'] = $user['firstname'];
    $_SESSION['userlastname'] = $user['lastname'];

    $_SESSION['useremail'] = $user['email'];
    $_SESSION['useraddress'] = $user['address'];
    $_SESSION['userpostalcode'] = $user['postalcode'];
    $_SESSION['userphonenumber'] = $user['phonenumber'];
    
     $_SESSION['userheadofhousestatus'] = $user['headofhouse'];
    
    $_SESSION['usermembertype'] = $user['membertype'];
    $_SESSION['userhouseholdid'] = $user['householdid'];
    $_SESSION['useragencyid'] = $user['agencyid'];
    
    return true;
}

function require_login()
{
    if(!isset($_SESSION['userid']))
    {
        header("Location: ../public/login.php");
    }
    else
    {
        /* Do Nothing */
    }
}

function protect_admin_page()
{
    if(!($_SESSION['usermembertype'] == 1))
    {
        header("Location: errorpage.php");
    }
}

function protect_member_page()
{
    if(!($_SESSION['usermembertype'] == 0))
    {
        header("Location: errorpage.php");
    }
}

function display_errors() 
{
    $output = '<center>';
    if(!empty($_SESSION["errorFeedback"]))
    {
        $output .= "<div class=\"errorFeedback\">";
        $output .= h($_SESSION["errorFeedback"]);
        $output .= "</div></center>";
    }
    return $output;
}

function display_success() 
{
    $output = '<center>';
    if(!empty($_SESSION["successFeedback"]))
    {
        $output .= "<div class=\"successFeedback\">";
        $output .= h($_SESSION["successFeedback"]);
        $output .= "</div></center>";
    }
    return $output;
}

?>
