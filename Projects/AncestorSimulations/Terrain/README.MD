# Ancestor Simulations Generating Planet Terrain
Welcome back, I hope you have been missing me all week! :-P

It's Monday which means that it's time to continue with the second installment of our Ancestor Simulations series.

<a href="https://geekgirljoy.wordpress.com/2017/08/08/ancestor-simulations-and-drakes-equation/" target="_blank" rel="noopener">Last week</a> I introduced the topic of Ancestor Simulations and illustrated how we can implement a version of <a href="https://en.wikipedia.org/wiki/Drake_equation">Drake's Equation</a> ( <em>N = R<sub>*</sub> * f<sub>p</sub> * N<sub>e</sub> * f<sub>l</sub> * f<sub>i</sub> * f<sub>c</sub> * L </em>) so that we can <a href="https://en.wikipedia.org/wiki/Probability_theory" target="_blank" rel="noopener">probabilistically</a> run many different simulations on a hypothetical galaxy (or even universe) and depending on the values we input for the <a href="https://en.wikipedia.org/wiki/Probability_axioms">axioms</a> of equation we get vastly different types of galactic neighborhoods. In some simulations the universe is a vast empty space that is cold &amp; lifeless, yet in others it is teeming with life practically <a href="https://www.merriam-webster.com/dictionary/stone%27s%20throw" target="_blank" rel="noopener">a stones throw</a> outside of our local star group in any direction you care to look. I won't venture to speculate if they really are out there or not but I will give you a quote by <a href="https://en.wikipedia.org/wiki/Carl_Sagan">Carl Sagan</a> that I like:
<p style="text-align: left;"><em>“The universe is a pretty big place. If it's just us, seems like an awful waste of space.”</em></p>
Now that we have an equation for defining and describing the universe that our simulation takes place in we will want to find number ranges we feel comfortable with for our simulation and <a href="https://en.wikipedia.org/wiki/Cache_(computing)" target="_blank" rel="noopener">cache</a> them at some point so we can make use of them in other parts of the simulation but for now I would like to move away from Drake's Equation and move to a more practical challenge.

In order for our "ancestors" to be comfortable and build happy productive lives for themselves they will need a place to live. We have <a href="https://en.wikipedia.org/wiki/Earth" target="_blank" rel="noopener">Earth</a> to call our home sweet chunk of <a href="https://en.wiktionary.org/wiki/terraferma" target="_blank" rel="noopener">terraferma</a> :-P

However I think a kind of a fun aspect to this project is that the so called "ancestors" need not be our ancestors and, hell they need not even be <a href="https://en.wikipedia.org/wiki/Primate" target="_blank" rel="noopener">primates</a>! They could end up being intelligent <a href="https://en.wikipedia.org/wiki/Arthropod">arthropods</a> if we were to build some kind of genetic evolutionary system!

So because it's far more interesting (not to mention more useful) to generate a terrain from scratch than to simply use a pre-rendered picture or mesh of earth (especially if we are not simulating earth)  it becomes evident that we need an algorithm to build a planetary terrain before we can even consider concepts like evolution creating critters.

The algorithm I selected is sometimes called the 'Plasma fractal' (which goes hand in hand with the post I did not that long ago about Sierpinski Triangle's called <a href="https://geekgirljoy.wordpress.com/2017/07/07/a-chaos-game/">A Chaos Game</a> ) though most people probably better know this algorithm as the '<a href="https://en.wikipedia.org/wiki/Diamond-square_algorithm" target="_blank" rel="noopener">Diamond Square Algorithm</a>'.
<h2><span id="The_Algorithm" class="mw-headline">The Plasma Fractal Algorithm</span></h2>
The plasma 'diamond-square' algorithm begins with a 2D square array of width and height 2<sup>n</sup> +1.

<strong>That looks like this in code</strong>
<pre><code>$size = pow(2, $exponent);</code></pre>
Basically this says take the number 2 and multiply it by n (the <a href="https://en.wikipedia.org/wiki/Exponentiation">Exponent</a>). In my implementation I start the grid count in the top left corner as row: 0  col: 0 (as opposed to (1,1)) therefore I do not have to add 1 to the $size variable.

<strong>We then create our 2D array:</strong>
<pre><code>$terrain = array_fill(0, $size+1, array_fill(0, $size+1, NULL));</code></pre>
Basically this says create and array of arrays $size+1 wide and $size+1 high and fill the spaces with <a href="http://php.net/manual/en/language.types.null.php">NULL</a> characters.

<strong>Now we start creating the terrain</strong>

The four corner points of the array are assigned initial random values within a range (lets say -4 through 4).
<pre><code>
$a = $terrain[0][0] = mt_rand($min_roughness, $max_roughness);
$b = $terrain[0][$size] = mt_rand($min_roughness, $max_roughness);
$c = $terrain[$size][0] = mt_rand($min_roughness, $max_roughness);
$d = $terrain[$size][$size] = mt_rand($min_roughness, $max_roughness);
</code></pre>
&nbsp;

<strong>Find the center and compute the average</strong>

Next you compute the average of the 4 outer squares, find the center square and set it's value to be the average of the 4 outer square positions + random value within a range.
<pre><code>
$average = $a + $b + $c + $d;

$row = $size/2;
$col = $size/2;
$e = $terrain[$row][$col] = ( $average + mt_rand($min_roughness, $max_roughness)) / 5;
</code></pre>
&nbsp;

<strong>Divide, Rinse, Repeat</strong>

Now all that is left to do is to iterate through the array and perform the  square &amp; diamond steps until all positions in the array have been set. Each time you iterate through the array you divide the array into smaller and smaller "chunks" of equal size and step through each chunk of the array doing the diamond and square walks.

That looks like this:
<pre><code>
$chunk_size = $size;
for($level = 1; ($chunk_size / $level) &gt; 0.1; $level++){
	for($row_offset = 0; $row_offset &lt;= $size; $row_offset+=$chunk_size){
		for($col_offset = 0; $col_offset &lt;= $size; $col_offset+=$chunk_size){
			
			// Do (Square Step)
			// if the position is not already set then set it
			if(!isset($terrain[$row_offset - $chunk_size/2][$col_offset])){
				$terrain[$row_offset - $chunk_size/2][$col_offset] = ($average + mt_rand($min_roughness, $max_roughness)) / 5;
			}
			$a = $terrain[$row_offset - $chunk_size/2][$col_offset];
			
                        // if the position is not already set then set it
			if(!isset($terrain[$row_offset][$col_offset - $chunk_size/2])){
				$terrain[$row_offset][$col_offset - $chunk_size/2] = ($average + mt_rand($min_roughness, $max_roughness)) / 5;
			}
			$b = $terrain[$row_offset][$col_offset - $chunk_size/2];
			
			// if the position is not already set then set it
			if(!isset($terrain[$row_offset][$col_offset + $chunk_size/2])){
				$terrain[$row_offset][$col_offset + $chunk_size/2] = ($average + mt_rand($min_roughness, $max_roughness)) / 5;
			}
			$c = $terrain[$row_offset][$col_offset + $chunk_size/2];
			
			// if the position is not already set then set it
			if(!isset($terrain[$row_offset + $chunk_size/2][$col_offset])){
				$terrain[$row_offset + $chunk_size/2][$col_offset] = ($average + mt_rand($min_roughness, $max_roughness)) / 5;
			}
			$d = $terrain[$row_offset + $chunk_size/2][$col_offset];
			
			// Computer the average height of $a + $b + $c + $d
			$average = $a + $b + $c + $d;
						
			// Set Center (Diamond Step)
			// if the position is not already set then set it
			if(!isset($terrain[$row_offset + $chunk_size/2][$col_offset + $chunk_size/2])){
				$terrain[$row_offset + $chunk_size/2][$col_offset + $chunk_size/2] = ($average + mt_rand($min_roughness, $max_roughness)) / 5;
			}
			$e = $terrain[$row_offset + $chunk_size/2][$col_offset + $chunk_size/2];
		}
	}

	// Reduce the chunk size
	$chunk_size = $chunk_size/2;
}
</code></pre>
&nbsp;

After which you simply create an image that is the same size of the array and use the array values as the colors. Lower values should be darker and higher values should be lighter. Water is added by declaring a constant water level and anything below a given level is water and colored the same but as shades of blue.

<strong>Putting it all together</strong>

And with that all you have to do is create an HTML interface!

Preview a running version of this project <a href="https://geekgirljoy.000webhostapp.com/ancestorsimulations/generatingterrain/index.php" target="_blank" rel="noopener">here</a> and get your copy of the entire project over on GitHub <a href="https://github.com/geekgirljoy/PHP/tree/master/Projects/AncestorSimulations/Terrain" target="_blank" rel="noopener">here</a>.
<p style="text-align: center;"><em>Click for Full Size Images</em></p>
<p style="text-align: center;"><strong>Small Lush Islands<br><a href="https://geekgirljoy.files.wordpress.com/2017/08/small-islands.png"><img class="aligncenter size-medium wp-image-2440" src="https://geekgirljoy.files.wordpress.com/2017/08/small-islands.png?w=300" alt="" width="300" height="184" /></a></strong></p>
&nbsp;
<p style="text-align: center;"><strong>Desert</strong><br><a href="https://geekgirljoy.files.wordpress.com/2017/08/desert.png"><img class="aligncenter size-medium wp-image-2437" src="https://geekgirljoy.files.wordpress.com/2017/08/desert.png?w=300" alt="" width="300" height="185" /></a></p>
&nbsp;
<p style="text-align: center;"><strong>Lush Landmass with Large Lakes</strong><br><a href="https://geekgirljoy.files.wordpress.com/2017/08/lush-lakes.png"><img class="aligncenter size-medium wp-image-2438" src="https://geekgirljoy.files.wordpress.com/2017/08/lush-lakes.png?w=300" alt="" width="300" height="185" /></a></p>
&nbsp;
<p style="text-align: center;"><strong>Lunar Like Surface</strong><br><a href="https://geekgirljoy.files.wordpress.com/2017/08/moon.png"><img class="aligncenter size-medium wp-image-2439" src="https://geekgirljoy.files.wordpress.com/2017/08/moon.png?w=300" alt="" width="300" height="184" /></a></p>
Obviously more can be added to the generator however this is a great jumping off point to get you started! If you have any thoughts or ideas on improvements or you simply like these kinds of posts go ahead and leave a comment below.

Please Like,  Share my posts with your friends and followers on social media.

If you would like to suggest a topic or project for an upcoming post feel free to <a href="https://geekgirljoy.wordpress.com/contact/" target="_blank" rel="noopener">contact me</a>.

If you found this article useful or want to help me grow consider supporting me over on <a href="https://www.patreon.com/GeekGirlJoy" target="_blank" rel="noopener">Patreon.</a>

With that, have a great week &amp; I will see you all in the next post!

Much Love,

~Joy
