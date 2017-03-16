# Magic 8 Ball
 
 ![Preview](/Projects/magic-8-ball/Preview.png?raw=true "Preview")

Magic 8 Ball is a browser based implementation of a "<a href="https://en.wikipedia.org/wiki/Magic_8-Ball" target='_blank'>Magic 8 Ball</a>". This project features <a href="http://php.net/manual/en/language.oop5.autoload.php" target='_blank'>autoloading PHP classes</a>, <a href="https://en.wikipedia.org/wiki/HTML" target='_blank'>HTML</a> and <a href="https://en.wikipedia.org/wiki/Cascading_Style_Sheets" target='_blank'>CSS</a> to create a virtual 8 Ball that will soon become your <a href="https://en.wikipedia.org/wiki/Goto" target='_blank'>goto</a> oracle with all important questions in your life!

You can preview a running version of this project here: <a href="https://geekgirljoy.000webhostapp.com/magic-8-ball/index.php" target='_blank'>Magic 8 Ball</a>

Every now and then I like to post a complete project for you all to enjoy and often times that means it's just a simple proof of concept example rather a full featured project. The Magic 8 Ball project is completely functional but there isn't anything really fancy like animation or a <a href="https://en.m.wikipedia.org/wiki/Artificial_neural_network" target='_blank'>neural network</a> at work in this project, however I have a great set of tutorials on neural networks here:  <a href="https://geekgirljoy.wordpress.com/2016/07/12/getting-started-with-neural-networks-using-the-fann-library-php-and-c9-io/" target='_blank'>Getting Started With Neural Networks</a>... if you'd prefer to read about that topic instead. :-)

The origins of this project was I was looking for "spooky" and fun projects or code to work on/blog about during the Halloween 2016 season but ultimately I didn't post this project.

Despite not posting it on my blog at that time, I uploaded it to my github account because liked how this project turned out so recently I thought I would blow the dust off and show it to you.

If you just want to dig in and start playing with the code, you can access everything for this project on my github: <a href="https://github.com/geekgirljoy/PHP/tree/master/Projects/magic-8-ball" target='_blank'>https://github.com/geekgirljoy/PHP/tree/master/Projects/magic-8-ball</a> or copy the code segments below into the correct files.

Otherwise the tutorial starts now 😉

There is a caveate with this project, for simplicity/speed I used <a href="https://getbootstrap.com/">Bootstrap</a> to reduce the CSS I had to write but you could eliminate that from the project very easily if you want to rely entirely on your own grid system and CSS.
<h3>Folder Structure</h3>
<p>Setting up the folders for this project is very straight forward, .css files in the [css] folder and .php files (other than index.php) in the [php] folder.</p>
<p>Inside the [php] folder there is a sub-folder called [classes] where the class files for the project will reside.</p>
<pre><code>
[magic-8-ball]
             ├── index.php
             └── [css]
             │       └── magic-8-ball.css
             └── [php]
                     ├── Magic8Ball.php
                     └── [classes]
                                 └── Magic8Ball.class.php
</code></pre>




<h3>index.php</h3>
<p>Our Index file creates the framework for the Magic 8 Ball. We link to all the CSS used by the project including <a href="https://getbootstrap.com/">Bootstrap</a> and JQuery.</p>

<p>Inside the body of the page we create a form with with a text input field along with a submit input. The form uses GET so the <i>'Question'</i> field will be accessible in the URL however if you would prefer to use the POST method all you need to do is change method attribute on the form from GET to POST as the PHP code uses $_REQUEST['Question'] so it will work however you need for your situation</p>

<p>Beneath the form we include Magic8Ball.php on the page by doing <strong>&lt;?php include(&#039;php&#047;Magic8Ball.php&#039;); ?&gt;</strong>.</p>

<pre><code>
&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;meta charset=&quot;utf-8&quot;&gt;
        &lt;meta name=&quot;viewport&quot; content=&quot;width=device-width&quot;&gt;
        &lt;title&gt;Magic 8 Ball&lt;&#047;title&gt;
        &lt;script src=&quot;https:&#047;&#047;code.jquery.com&#047;jquery.min.js&quot;&gt;&lt;&#047;script&gt;
        &lt;link href=&quot;https:&#047;&#047;maxcdn.bootstrapcdn.com&#047;bootstrap&#047;3.3.6&#047;css&#047;bootstrap.min.css&quot; rel=&quot;stylesheet&quot; type=&quot;text&#047;css&quot; &#047;&gt;
        &lt;script src=&quot;https:&#047;&#047;maxcdn.bootstrapcdn.com&#047;bootstrap&#047;3.3.6&#047;js&#047;bootstrap.min.js&quot;&gt;&lt;&#047;script&gt;
        &lt;link href=&quot;https:&#047;&#047;fonts.googleapis.com&#047;css?family=Creepster&quot; rel=&quot;stylesheet&quot;&gt;
        &lt;link href=&quot;css&#047;magic-8-ball.css&quot; rel=&quot;stylesheet&quot; type=&quot;text&#047;css&quot; &#047;&gt;
    &lt;&#047;head&gt;
    &lt;body&gt;
        &lt;div class=&quot;container-fluid&quot;&gt;
            &lt;div class=&quot;row&quot;&gt;
                &lt;div class=&quot;col-md-12 text-center&quot;&gt;
                &lt;h1&gt;Magic 8 Ball&lt;&#047;h1&gt;
                &lt;&#047;div&gt;
            &lt;&#047;div&gt;
            &lt;div class=&quot;row&quot;&gt;
                &lt;div class=&quot;col-md-12&quot;&gt;
                    &lt;div class=&quot;row&quot;&gt;
                        &lt;div class=&quot;col-md-12 text-center&quot;&gt;        
                            &lt;form action=&#039;#&#039; method=&#039;get&#039;&gt;
                                &lt;input name=&#039;Question&#039; placeholder=&quot;Ask a question...&quot; &#047;&gt;
                                &lt;input class=&#039;btn btn-success&#039; type=&#039;submit&#039; value=&#039;Ask&#039; &#047;&gt;
                            &lt;&#047;form&gt;
                        &lt;&#047;div&gt;
                    &lt;&#047;div&gt;
                    &lt;br&gt;
                    &lt;div class=&quot;row&quot;&gt;
                        &lt;div class=&quot;col-sm-4 col-md-4 col-lg-5&quot;&gt;&lt;&#047;div&gt;
                            &lt;div class=&quot;col-sm-4 col-md-4 col-lg-4&quot;&gt;
                            
                                &lt;?php include(&#039;php&#047;Magic8Ball.php&#039;); ?&gt;
                            
                            &lt;&#047;div&gt;
                        &lt;div class=&quot;col-sm-4 col-md-4 col-lg-3&quot;&gt;&lt;&#047;div&gt;
                    &lt;&#047;div&gt;
                &lt;&#047;div&gt;
            &lt;&#047;div&gt;
        &lt;&#047;div&gt;
    &lt;&#047;body&gt;
&lt;&#047;html&gt;

</code></pre>


&nbsp;

<h3>magic-8-ball.css</h3>
<p>The CSS is all pretty straight forward, nothing unusual here. :-)</p>
<pre><code>
body{ 
    background-color:#444444; 
} 

h1{ 
    font-family: 'Creepster', cursive; 
    color:#00bb00; 
} 

#eight{ 
    font-size:400%; 
    color: #000000; 
}
 
.black-ball{
    border-radius: 50%; 
    background-color: #000; 
    width: 200px; 
    height: 200px; 
    display:table; 
    text-align:center; 
    padding: 50px; 
    box-shadow: 5px 5px 5px #333333; 
} 

.white-ball{ 
    border-radius: 50%; 
    background-color: #fff; 
    width: 22%; 
    height: 22%; 
    display:table-cell; 
    vertical-align:middle; 
    font-family: 'Creepster', cursive; 
}

.answer{ 
    color: #bb0000; 
}

</code></pre>

&nbsp;

<h3>Magic8Ball.php</h3>

<p>The PHP code that generates the 8 Ball is pretty simple. We start by setting up an auto-loader to auto include all classes we put in our classes subfolder.</p> <p><em><strong>Note:</strong> In order for your classes to get auto loaded by the code as written you will need to name the class file using this naming convention: &lt;Class or File Name&gt;.class.php If you would prefer not to use that naming convention you can modify the auto-loader to meet your needs.</em></p>

<p>We follow that up with the Div tags that become the body of the 8 Ball when styled with our CSS.</p>

<p>After that we use $_REQUEST['Question'] to check if the user has asked a question. If no question was asked the #8 placeholder is used.</p>

<p>Once the user asks a question we create an array of strings containing of all possible responses which we call $answers.</p>

<p>After that we instantiate the Eight Ball object by passing the class the count of how many items are in our $answers array using: <strong>$EightBall = new Magic8Ball(count($answers)-1);</strong>. The class will return a number as it's answer.</p>

<p>Once we have the $EightBall answer all we need to do is echo the the result in a span assigned the 'answer' class: <strong> echo '&lt;span class="answer"&gt;' . $answers[ $EightBall&gt;answer ] . '&lt;/span&gt;' . PHP_EOL;</strong>.</p>

<pre><code>

&lt;?php
    function ClassAutoloader($class) {
        include &#039;php&#047;classes&#047;&#039; . $class . &#039;.class.php&#039;;
    }
    spl_autoload_register(&#039;ClassAutoloader&#039;);
?&gt;
&lt;div class=&quot;black-ball&quot;&gt;
                                &lt;div class=&quot;white-ball&quot;&gt;
                                    &lt;?php
                                    if(isset($_REQUEST[&#039;Question&#039;])){
                                        
                                    $answers = array(&quot;It is certain&quot;,
                                        &quot;It is decidedly so&quot;,
                                        &quot;Without a doubt&quot;,
                                        &quot;Yes, definitely&quot;,
                                        &quot;You may rely on it&quot;,
                                        &quot;As I see it, yes&quot;,
                                        &quot;Most likely&quot;,
                                        &quot;Outlook good&quot;,
                                        &quot;Yes&quot;,
                                        &quot;Signs point to yes&quot;,
                                        &quot;Reply hazy try again&quot;,
                                        &quot;Ask again later&quot;,
                                        &quot;Better not tell you now&quot;,
                                        &quot;Cannot predict now&quot;,
                                        &quot;Concentrate and ask again&quot;,
                                        &quot;Don&#039;t count on it&quot;,
                                        &quot;My reply is no&quot;,
                                        &quot;My sources say no&quot;,
                                        &quot;Outlook not so good&quot;,
                                        &quot;Very doubtful&quot;);
                                        
                                        &#047;*
                                        *    Invoke the wisdom of the Magic 8 Ball.
                                         *
                                        *    Oh great magic eight ball. We beseach thee to answer our question :-P
                                         *   Display the answer.
                                        *&#047;
                                        $EightBall = new Magic8Ball(count($answers)-1);
                                        echo &#039;&lt;span class=&quot;answer&quot;&gt;&#039; . $answers[ $EightBall-&gt;answer ] . &#039;&lt;&#047;span&gt;&#039; . PHP_EOL;
                                    }
                                    else{
                                        &#047;&#047; Initial value of of the ball
                                        echo&#039;&lt;div id=&quot;eight&quot;&gt;8&lt;&#047;div&gt;&#039; . PHP_EOL;
                                    }
                                    ?&gt;
                                &lt;&#047;div&gt;
&lt;&#047;div&gt;

</code></pre>

&nbsp;

<h3>Magic8Ball.class.php</h3>

<p>The class file defines the Magic 8 Ball. It has a single property <i>'$answer'</i> and a single method (the constructor). When the class is instantiated, it takes a single argument ($total) which it uses as the $max value for <a href="http://php.net/manual/en/function.mt-rand.php" target="_blank">mt_rand()</a>. </p>

<pre><code>

&lt;?php
&#047;*
*    Magic8Ball.class.php
 *
*    Joy Harvel
 *
*    09&#047;18&#047;2016
 *
*&#047;
class Magic8Ball{
	public $answer;
    function __construct($total) {
        $this-&gt;answer = mt_rand( 0 , $total);
    }
}
?&gt;

</code></pre>

<p>If you have gotten this far all that is left to do is test the code and get top notch advice on all your tough questions! :-P<br>

<strong>Live Preview: </strong> <a href="https://geekgirljoy.000webhostapp.com/magic-8-ball/index.php" target='_blank'>Magic 8 Ball</a><br>

<strong>View Source: </strong> <a href="https://github.com/geekgirljoy/PHP/tree/master/Projects/magic-8-ball" target='_blank'>Magic 8 Ball on Github</a><br>
</p>

As always I hope you found this post and project both interesting and informative. Please share this post with your friends and followers on your social media platforms and don't forget to click the follow button over on the top right of this page. 

<p><strong>Notice:</strong> I am seeking paid sponsors for my content so if you would like to sponsor my work please <a href="https://geekgirljoy.wordpress.com/contact/">contact me</a>.</p>

Much Love,
~Joy
