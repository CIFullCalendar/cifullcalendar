<?php
	function url_title($str, $separator = 'dash', $lowercase = FALSE)
	{		
		if ($separator == 'dash')
		{
			$search		= '_';
			$replace	= '-';
		}
		else
		{
			$search		= '-';
			$replace	= '_';
		}

		$trans = array(
		        '&\#\d+?;'                    => '',
		        '&\S+?;'                    => '',
		        '\s+|/+'                    => $separator,
		        '[^\p{L}\p{Nd}0-9\-\._]'            => '',
		        $separator.'+'                => $separator,
		        '^[-_]+|[-_]+$'                => '',
		        '\.+$'                        => ''
		);  
		$str = strip_tags($str);
		foreach ($trans as $key => $val)
		{
			$str = preg_replace("#".$key."#iu", $val, $str);
		}
		if ($lowercase === TRUE)
		{
			$str = strtolower($str);
		}
		return trim(stripslashes($str));
	}
