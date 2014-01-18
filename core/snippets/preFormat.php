<?php
			// Limpia el texto entrante para la consulta en la base de datos
			$patron = '/\./';
			$sustitucion = ' .';
			$txt = preg_replace($patron, $sustitucion, $txt);
			
			$patron = '/\'/';
			$sustitucion = ' #1# ';
			$txt = preg_replace($patron, $sustitucion, $txt);
			
			$patron = '/\:/';
			$sustitucion = ' :';
			$txt = preg_replace($patron, $sustitucion, $txt);
			
			$patron = '/\?/';
			$sustitucion = ' ?';
			$txt = preg_replace($patron, $sustitucion, $txt);
			
			$patron = '/\¿/';
			$sustitucion = '¿ ';
			$txt = preg_replace($patron, $sustitucion, $txt);
			
			$patron = '/\!/';
			$sustitucion = ' !';
			$txt = preg_replace($patron, $sustitucion, $txt);
			
			$patron = '/\¡/';
			$sustitucion = '¡ ';
			$txt = preg_replace($patron, $sustitucion, $txt);
			
			$patron = '/\"/';
			$sustitucion = ' #2# ';
			$txt = preg_replace($patron, $sustitucion, $txt);	
			
			$patron = '/\,/';
			$sustitucion = ' , ';
			$txt = preg_replace($patron, $sustitucion, $txt);		
			
			$patron = '/\\n/';
			$sustitucion = '<br/>';
			$txt = preg_replace($patron, $sustitucion, $txt);			
			
			$patron = '/\</';
			$sustitucion = ' < ';
			$txt = preg_replace($patron, $sustitucion, $txt);			
			
			$patron = '/\>/';
			$sustitucion = ' > ';
			$txt = preg_replace($patron, $sustitucion, $txt);		
			
			$patron = '/\t/';
			$sustitucion = ' ';
			$txt = preg_replace($patron, $sustitucion, $txt);
			
?>