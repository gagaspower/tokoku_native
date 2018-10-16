<?php

// membuat fungsi SEO url
	function seotitle($s) {
	    $c = array (' ');
	    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');

	    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
	    
	    $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
	    return $s;
	}


	//fungsi pendek karakter minimal..
	function min_length($str, $val)
	{
		if ( ! is_numeric($val))
		{
			return FALSE;
		}

		return ($val <= mb_strlen($str));
	}



	// fungsi panjang maksimal
	function max_length($str, $val)
	{
		if ( ! is_numeric($val))
		{
			return FALSE;
		}

		return ($val >= mb_strlen($str));
	}




	// fungsi validasi URL
	function valid_url($str)
	{
		if (empty($str))
		{
			return FALSE;
		}
		elseif (preg_match('/^(?:([^:]*)\:)?\/\/(.+)$/', $str, $matches))
		{
			if (empty($matches[2]))
			{
				return FALSE;
			}
			elseif ( ! in_array(strtolower($matches[1]), array('http', 'https'), TRUE))
			{
				return FALSE;
			}

			$str = $matches[2];
		}

		if (preg_match('/^\[([^\]]+)\]/', $str, $matches) && ! is_php('7') && filter_var($matches[1], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== FALSE)
		{
			$str = 'ipv6.host'.substr($str, strlen($matches[1]) + 2);
		}

		return (filter_var('http://'.$str, FILTER_VALIDATE_URL) !== FALSE);
	}


	// fungsi validasi email
	function valid_email($str)
	{
		if (function_exists('idn_to_ascii') && sscanf($str, '%[^@]@%s', $name, $domain) === 2)
		{
			$str = $name.'@'.idn_to_ascii($domain);
		}

		return (bool) filter_var($str, FILTER_VALIDATE_EMAIL);
	}



	// fungsi validasi alphabet
	function alpha($str)
	{
		return ctype_alpha($str);
	}

	// fungsi alphabet numeric
	function alpha_numeric($str)
	{
		return ctype_alnum((string) $str);
	}

	// fungsi alphabet numeric and space
	function alpha_numeric_spaces($str)
	{
		return (bool) preg_match('/^[A-Z0-9 ]+$/i', $str);
	}


	// fungsi numeric

	function numeric($str)
	{
		return (bool) preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', $str);

	}


	// fungsi valid integer
	function integer($str)
	{
		return (bool) preg_match('/^[\-+]?[0-9]+$/', $str);
	}

	//fungsi valid desimal
	function decimal($str)
	{
		return (bool) preg_match('/^[\-+]?[0-9]+\.[0-9]+$/', $str);
	}




?>