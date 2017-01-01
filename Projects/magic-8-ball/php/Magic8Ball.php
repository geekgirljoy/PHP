<?php
    function ClassAutoloader($class) {
        include 'php/classes/' . $class . '.class.php';
    }
    spl_autoload_register('ClassAutoloader');
?>
<div class="black-ball">
                                <div class="white-ball">
                                    <?php
                                    if(isset($_REQUEST['Question'])){
                                        
                                    $answers = array("It is certain",
                                        "It is decidedly so",
                                        "Without a doubt",
                                        "Yes, definitely",
                                       "You may rely on it",
                                        "As I see it, yes",
                                       "Most likely",
                                        "Outlook good",
                                        "Yes",
                                        "Signs point to yes",
                                        "Reply hazy try again",
                                        "Ask again later",
                                        "Better not tell you now",
                                        "Cannot predict now",
                                        "Concentrate and ask again",
                                        "Don't count on it",
                                        "My reply is no",
                                        "My sources say no",
                                        "Outlook not so good",
                                        "Very doubtful");
                                        
                                        /*
                                        *    Invoke the wisdom of the Magic 8 Ball.
                                         *
                                        *    Oh great magic eight ball. We beseach thee to answer our question :-P
                                         *   Display the answer.
                                        */
                                        $EightBall = new Magic8Ball(count($answers)-1);
                                        echo '<span class="answer">' . $answers[ $EightBall->answer ] . '</span>' . PHP_EOL;
                                    }
                                    else{
                                        // Initial value of of the ball
                                        echo'<div id="eight">8</div>' . PHP_EOL;
                                    }
                                    ?>
                                </div>
                            </div>
