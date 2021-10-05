<div id="myNav" class="overlay">
    
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    
    <div class="overlay-content">
    
    <?php
    
    if($_SESSION['usermembertype'] == '1') //If user is administrative
    {
        echo '<a href="/povertyprediction/public/adminhome.php">Home</a>';
        echo '<a href="/povertyprediction/public/adminretrainmodel.php">Analytics</a>';
    }
    else if($_SESSION['usermembertype'] == '0') //If user is NOT administrative
    {
        echo '<a href="/povertyprediction/public/memberhome.php">Home</a>';
    }
    else //If user is unidentified
    {
        header("Location: /povertyprediction/private/backend_logout.php");
    }
    
    ?>

    <a href="#clients">Profile Information</a>
    <a href="#contact">Account Settings</a>
    <a href="/povertyprediction/private/backend_logout.php">Log Out</a>
    
    </div>
  
</div>

<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

<script>
function openNav() {
  document.getElementById("myNav").style.height = "100%";
}

function closeNav() {
  document.getElementById("myNav").style.height = "0%";
}
</script>