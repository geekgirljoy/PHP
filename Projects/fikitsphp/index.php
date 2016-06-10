<?php
include("assets/components/SessionComponent.php"); 
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['currlang']; ?>">
<head>
    <?php 
        include("assets/components/HeaderComponent.php"); 
        include("assets/components/JavaScriptComponent.php"); 
    ?>
</head>
<body>
<?php
    /////////////////////////////////////////////////////
    // Nav Bar
    /////////////////////////////////////////////////////
    include("assets/components/NavBarComponent.php");
    
    /////////////////////////////////////////////////////
    // Current Component / Page
    /////////////////////////////////////////////////////
    if(isset($_SESSION["currcomponent"]))
    {
         include("assets/components/" . $_SESSION['currcomponent'] . ".php");
    }
    
    /////////////////////////////////////////////////////
    // Current Page
    /////////////////////////////////////////////////////
    include("assets/components/FooterComponent.php");
?>
</body>
</html>
