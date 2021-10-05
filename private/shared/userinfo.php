<?php

if($_SESSION['usermembertype'] == 1)
{
    $membertype = "(Administrative)";
}
else if($_SESSION['usermembertype'] == 0)
{
    $membertype = "(Household Member)";
}
else
{
    $membertype = "(Unidentified)";
}

echo "<center><p>
[ Currently Logged In ] - ".$_SESSION['userfirstname']." ".$_SESSION['userlastname']." ".$membertype."</p></center>";

?>