<?php

/* fungsi ini digunakan untuk mencegah sql injection dan xss atau cross site scripting */
  
class Valid{
	function __construct(){}
	
	function validasi($str, $tipe){
     switch($tipe){
			default:
			case'sql':
				$d = array('-','/','\\',',','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','%','$','^','&','*','=','?','+');
				$str = str_replace($d, '', $str);
				$str = stripcslashes($str);	
				$str = htmlspecialchars($str);				
				$str = preg_replace('/[^A-Za-z0-9]/','',$str);				
				return intval($str);
			break;
			case'xss':
				$d = array ('\\','#',';','\'','"','[',']','{','}',')','(','|','`','~','!','%','$','^','*','=','?','+');
				$str = str_replace($d, '', $str);
				$str = stripcslashes($str);	
				$str = htmlspecialchars($str);
				return $str;
			break;
		}
	}	
}
?>
