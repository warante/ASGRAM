<?php
			// Vuelve a poner el texto como estaba originalmente
			$patron = '/ \./';
			$sustitucion = '.';
			$txtmod = preg_replace($patron, $sustitucion, $txtmod);
			
			$patron = '/ \:/';
			$sustitucion = ':';
			$txtmod = preg_replace($patron, $sustitucion, $txtmod);
			
			$patron = '/ \?/';
			$sustitucion = '?';
			$txtmod = preg_replace($patron, $sustitucion, $txtmod);
			
			$patron = '/\¿ /';
			$sustitucion = '¿';
			$txtmod = preg_replace($patron, $sustitucion, $txtmod);
			
			$patron = '/ \!/';
			$sustitucion = '!';
			$txtmod = preg_replace($patron, $sustitucion, $txtmod);
			
			$patron = '/\¡ /';
			$sustitucion = '¡';
			$txtmod = preg_replace($patron, $sustitucion, $txtmod);
			
			$patron = '/ #2# /';
			$sustitucion = '"';
			$txtmod = preg_replace($patron, $sustitucion, $txtmod);
			
			$patron = '/ \, /';
			$sustitucion = ',';
			$txtmod = preg_replace($patron, $sustitucion, $txtmod);
			
			$patron = '/ \< /';
			$sustitucion = '<';
			$txtmod = preg_replace($patron, $sustitucion, $txtmod);
			
			$patron = '/ \> /';
			$sustitucion = '>';
			$txtmod = preg_replace($patron, $sustitucion, $txtmod);			
			
			$patron = '/ #1# /';
			$sustitucion = '\'';
			$txtmod = preg_replace($patron, $sustitucion, $txtmod);
?>