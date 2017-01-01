<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Magic 8 Ball</title>
        <script src="https://code.jquery.com/jquery.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Creepster" rel="stylesheet">
        <link href="css/magic-8-ball.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                <h1>Magic 8 Ball</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 text-center">        
                            <form action='#' method='get'>
                                <input name='Question' placeholder="Ask a question..." />
                                <input class='btn btn-success' type='submit' value='Ask' />
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4 col-md-4 col-lg-5"></div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            
                            <?php include('php/Magic8Ball.php'); ?>
                            
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
