<?php

	function generate_token ($len = 32)
	{
 
		// Array of potential characters, shuffled.
		$chars = array(
			'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 
			'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
			'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 
			'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
			'0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '1'
		);
		shuffle($chars);
 
		$num_chars = count($chars) - 1;
		$token = '';
 
		// Create random token at the specified length.
		for ($i = 0; $i < $len; $i++)
		{
			$token .= $chars[mt_rand(0, $num_chars)];
		}
 
		return $token;
 
	}
?><!DOCTYPE html>
 
<html>
 
<head lang="en">
 
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
 
	<title>CI encryption key generator</title>		
	
	<meta name="description" content="Generates a random, 32 character string">
 

</head>
 
<body>

	<pre><code><?php echo 'Refresh the browser to generate: '; ?></code></pre>
	<pre><code><?php echo '$config[\'encryption_key\'] = \'<b>' . generate_token(32) . '</b>\';'; ?></code></pre>

 
</body>
 
</html>
