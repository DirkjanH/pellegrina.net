<?php 	

function generatePassword($plength,$include_letters,$include_capitals,$include_numbers,$include_punctuation)
	{

		// First we need to validate the argument that was given to this function
		// If need be, we will change it to a more appropriate value.
		if(!is_numeric($plength) || $plength <= 0)
		{
			$plength = 8;
		}
		if($plength > 32)
		{
			$plength = 32;
		}

		// This is the array of allowable characters.
		$chars = "";

		if ($include_letters == true) { $chars .= 'abcdefghijklmnopqrstuvwxyz'; }
		if ($include_capitals == true) { $chars .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; }
		if ($include_numbers == true) { $chars .= '0123456789'; }
		if ($include_punctuation == true) { $chars .= '`��$%^&*()-_=+[{]};:@#~,<.>/?'; }

		// If nothing selected just display 0's
		if ($include_letters == false AND $include_capitals == false AND $include_numbers == false AND $include_punctuation == false) {
			$chars .= '0';
		}

		// This is important:  we need to seed the random number generator
		mt_srand(microtime() * 1000000);

		// Now we simply generate a random string based on the length that was
		// requested in the function argument
		for($i = 0; $i < $plength; $i++)
		{
			$key = mt_rand(0,strlen($chars)-1);
			$pwd = $pwd . $chars[$key];
		}

		// Finally to make it a bit more random, we switch some characters around
		for($i = 0; $i < $plength; $i++)
		{
			$key1 = mt_rand(0,strlen($pwd)-1);
			$key2 = mt_rand(0,strlen($pwd)-1);

			$tmp = $pwd[$key1];
			$pwd[$key1] = $pwd[$key2];
			$pwd[$key2] = $tmp;
		}

		// Convert into HTML
		$pwd = htmlentities($pwd, ENT_QUOTES);

		return $pwd;
	}
?>