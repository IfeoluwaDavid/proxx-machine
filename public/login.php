<?php

require_once('../private/initialize.php');

?>

<?php $page_title = 'Sign in'; ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

    <form action="../private/backend_login.php" method="post">
        
            <h1 class="sign-in-header" > Proxx-Machine </h1>
        	
            <?php echo display_errors($errors); ?>
            
            <div class="inline-container">
            <i class="fa fa-user icon"></i>
            <input class="application-input" name="email" type="email" placeholder="Email" required>
            </div>
            
            <div class="inline-container">
            <i class="fa fa-key icon"></i>
            <input class="application-input" name="password" type="password" placeholder="Password" required>
            </div>
            
            <div class="inline-container">
        	<button name="login" type="submit" class="shortprimary">Sign In</button>
            </div>
            
    </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>