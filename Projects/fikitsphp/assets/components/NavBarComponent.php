
 <!-- Nav Bar Component -->
 <nav class="navbar navbar-default">
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="assets/api/PageManager.php?SelectedComponent=IndexComponent">Fikits</a>
    </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php
        if($_SESSION['authenticated'] == false) {
        echo <<<UNSECURE
<li><a href="assets/api/PageManager.php?SelectedComponent=FeaturesComponent">Features</a> </li>
<li><a href="assets/api/PageManager.php?SelectedComponent=PricingComponent">Pricing</a> </li>
UNSECURE;
}
?>
        <li><a href="assets/api/PageManager.php?SelectedComponent=ContactComponent">Contact</a> </li>
        
        
<?php
// secure links
// use heredoc 
if($_SESSION['authenticated'] == true) {
echo <<<SECURE

        <li><a href="assets/api/PageManager.php?SelectedComponent=SubmitMaintenanceRequestComponent">Submit a Maintenance Request</a> </li>
        <li><a href="assets/api/PageManager.php?SelectedComponent=MaintenanceRequestHistoryComponent">Get Status</a> </li>
        <li><a href="assets/api/PageManager.php?SelectedComponent=HelpComponent">Get Help</a> </li>
SECURE;
}

?>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true"> <span class="glyphicon glyphicon-cog"></span> Profile <span class="caret"></span></a>
          <ul class="dropdown-menu">

              <?php 
              if($_SESSION['authenticated'] == false)
              {
echo <<<UNSECURE
<li><a href="assets/api/PageManager.php?SelectedComponent=SignInComponent"><span class="glyphicon glyphicon-log-in"></span> Sign In</a></li>
UNSECURE;
                }
              else
              {
                
echo <<<SECURE
            <li><a href="#"><span class="glyphicon glyphicon-cog"></span> Settings</a> </li>
            <li role="separator" class="divider"></li>
<li><a href="assets/api/PageManager.php?SelectedComponent=SignOutComponent"><span class="glyphicon glyphicon-log-out"></span> Sign Out</a></li>
SECURE;
              }
              ?>
              
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav> 
<!-- / Nav Bar Component -->