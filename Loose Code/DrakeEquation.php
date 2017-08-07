<?php

// Reference the Drake Equation: https://en.wikipedia.org/wiki/Drake_equation

function DrakeEquation($Rs = 0, $Fp = 0, $Ne = 0, $Fl = 0, $Fi = 0, $Fc = 0, $L = 0){

	// The average rate of star formation in our galaxy.
	// Per the aforementioned Wiki Article:
	/*
	Latest calculations from NASA and the European Space Agency indicate that the current rate of star formation in our galaxy is about 0.68–1.45 M☉ of material per year.[26][27] To get the number of stars per year, this must account for the initial mass function (IMF) for stars, where the average new star mass is about 0.5 M☉.[28] This gives a star formation rate of about 1.5–3 stars per year.
	*/
	if(empty($Rs)){
	    $Rs = mt_rand(0,3) . '.' . mt_rand(0,99);
	}

	// Fraction of stars with so called "Habitable planets".
	// Per the aforementioned Wiki Article:
	/*
	Recent analysis of microlensing surveys has found that fp may approach 1—that is, stars are orbited by planets as a rule, rather than the exception; and that there are one or more bound planets per Milky Way star.[29][30]
	*/
	if(empty($Fp)){
		$Fp_decimal = mt_rand(0,99); 
		if($Fp_decimal == 0)
		{
			$Fp_decimal = mt_rand(0,9); // this may not be absolute 0
			                            // so if it is we will set it to 1/100th - 9/100th
		}
	    $Fp = "0.$Fp_decimal";
    }
	
	
	

	// Average number of planets that can potentially support life per star that has planets
	// Per the aforementioned Wiki Article:
	/*
	In November 2013, astronomers reported, based on Kepler space mission data, that there could be as many as 40 billion Earth-sized planets orbiting in the habitable zones of sun-like stars and red dwarf stars within the Milky Way Galaxy.[31][32] 11 billion of these estimated planets may be orbiting sun-like stars.[33] Since there are about 100 billion stars in the galaxy, this implies fp · ne is roughly 0.4. The nearest planet in the habitable zone may be as little as 12 light-years away, according to the scientists.[31][32]
	*/
	if(empty($Ne)){
		$Ne_decimal = mt_rand(0,99); 
		if($Ne_decimal == 0)
		{
			$Ne_decimal = mt_rand(0,9); // this may not be absolute 0 since were here
			                            // so if it is we will set it to 1/100th - 9/100th
		}
	    $Ne = mt_rand(0,1) . '.' . $Ne_decimal;
    }

	// Fraction of habitable planets that actually develop life.
	/* 
	We're here (humans) so it can't be 0.00 and we don't know that it's 1.00 because then it would mean that wherever life evolves, intelligent live WILL ALWAYS evolve EVENTUALLY... and we don't know that is the case, so we'll set this as such:
	*/
	if(empty($Fl)){
		$Fl_decimal = mt_rand(0,99); 
		if($Fl_decimal == 0)
		{
			$Fl_decimal = mt_rand(0,9); // this may not be absolute 0
			                            // so if it is we will set it to 1/100th - 9/100th
		}
		$Fl = "0.$Fl_decimal";
    }

	// Fraction of habitable planets with life on them that also evolve intelligent life
	/*
	Defined using the "short scale" https://en.wikipedia.org/wiki/Long_and_short_scales
	0.001 one of one thousand planets with life, will evolve intelligent life.
	0.0001 one out of ten thousand planets with life, will evolve intelligent life.
	0.00001 one out of one hundred thousand planets with life, will evolve intelligent life.
	0.000001 one out of one million planets with life, will evolve intelligent life.
	0.0000001 one out of ten million planets with life, will evolve intelligent life.
	0.00000001 one out of one hundred million planets with life, will evolve intelligent life.
	0.000000001 one out of one billion planets with life, will evolve intelligent life.
	0.0000000001 one out of ten billion planets with life, will evolve intelligent life.
	0.00000000001 one out of one hundred billion planets with life, will evolve intelligent life.
	0.000000000001 one  out of one trillion planets with life, will evolve intelligent life.
	*/
	$Fi = '0.00' . str_repeat('0', mt_rand(0,9)) . '1';

	// Fraction that survive long enough to sufficiently develop long range communications technology (wireless transmissions)
	if(empty($Fc)){
		$Fc_decimal = mt_rand(0,99); 
		if($Fc_decimal == 0)
		{
			$Fc_decimal = mt_rand(0,9); // this may not be absolute 0
			                            // so if it is we will set it to 1/100th - 9/100th
		}
		$Fc = "0.$Fc_decimal";
    }

	
	// How long those civilizations last
	$L = mt_rand(500,25000); // Anyone's guess could be indefinite
	                         // So lets have it max at 25K years

	return $Rs * $Fp * $Ne * $Fl * $Fi * $Fc * $L;

}

// the number of planets with detectable signs of life
echo DrakeEquation();

?>
