<?php

// DNA Pairing

/*

The DNA strand is missing the pairing 
element. Take each character, get its pair, 
and return the results as a 2d array.

Base pairs are a pair of AT and CG. 
Match the missing element to the provided 
character.

Return the provided character as the 
first element in each array.

For example, for the input GCG, return:
[["G", "C"], ["C","G"],["G", "C"]]

The character and its pair are paired up in an
array, and all the arrays are grouped into one
encapsulating array.

*/
function pair($str) 
{
	$arr = [];

	for ($i = 0; $i < strlen($str); $i++)
	{		
		if($str[$i] =='A'){ $arr.push(['A', 'T']); }
		else if($str[$i] =='T'){ array_push($arr, ['T', 'A']); }
		else if($str[$i] =='C'){ array_push($arr, ['C', 'G']); }
		else if($str[$i] =='G'){ array_push($arr, ['G', 'C']); }
	}

  return $arr;
}

// Use
// pair("GCG");
print_r( pair("GCG") );


?>