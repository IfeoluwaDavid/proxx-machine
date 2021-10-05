<?php

require_once('../private/initialize.php');
require_login();

$page_title = 'Sign in';

include(SHARED_PATH . '/header.php');
include(SHARED_PATH . '/navbar.php');

?>

<h1>Error 404</h1>

<?php echo display_errors(); ?>
<?php echo display_success(); ?>

<div class="container" style="width: auto">

<h1 style="color:black;">You're not authorized to access this page.</h1>
    
</div>

<p> Try using a different login credential.</p>

<center><p>
    
<?php

if($_SESSION['usermembertype'] == 1)
{
    echo "<a href='http://sharmadese.site/povertyprediction/public/adminhome.php'>Back to Home Page</a>";
}
else
{
    echo "<a href='http://sharmadese.site/povertyprediction/public/memberhome.php'>Back to Home Page</a>";
}

?>
    
</p></center>

<?php include(SHARED_PATH . '/footer.php'); ?>