<?php
session_start();

$SelectedComponent = isset($_POST['SelectedComponent']) ? $SelectedComponent = $_POST['SelectedComponent'] : $SelectedComponent = $_GET['SelectedComponent'];

if($_SESSION['failedlogin'] == true){$SelectedComponent = "SignInComponent"; }


/*
    If user provided a new page component to load, select that page component.
   
    We could do:
    $_SESSION["currcomponent"] = $SelectedComponent;
    
    But we should not do this, this would be allowing the user to directly
    change the component that is loaded by changing the html. 
    
    While other security methods on the components themselves would prevent
    attack, and should be used in conjunction with security on the components,
    it is a better practice to only serve up the components we want
    to serve rather than allow direct user input to begin changing the system 
    which would allow an attacker to game system by attempting to pullup other 
    components.

*/

// public
if($SelectedComponent == 'IndexComponent' ) { $_SESSION["currcomponent"] = "IndexComponent";}
elseif($SelectedComponent == 'SignInComponent' ) { $_SESSION["currcomponent"] = "SignInComponent";}
elseif($SelectedComponent == 'SignOutComponent' ) { $_SESSION["currcomponent"] = "SignOutComponent";}
elseif($SelectedComponent == 'FeaturesComponent' ) { $_SESSION["currcomponent"] = "FeaturesComponent";}
elseif($SelectedComponent == 'ContactComponent' ) { $_SESSION["currcomponent"] = "ContactComponent";}
elseif($SelectedComponent == 'PricingComponent' ) { $_SESSION["currcomponent"] = "PricingComponent";}

// secure
elseif($SelectedComponent == 'SubmitMaintenanceRequestComponent' ) { $_SESSION["currcomponent"] = "SubmitMaintenanceRequestComponent";}
elseif($SelectedComponent == 'MaintenanceRequestHistoryComponent' ) { $_SESSION["currcomponent"] = "MaintenanceRequestHistoryComponent";}
elseif($SelectedComponent == 'HelpComponent' ) { $_SESSION["currcomponent"] = "HelpComponent";}



// default
else{$_SESSION["currcomponent"] = "IndexComponent";}

//refresh to bring in new component
header('Location: ' . $_SESSION['siteurl']);
?>