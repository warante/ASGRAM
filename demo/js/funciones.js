$(document).ready(function() {
	$('.cambia').click(function() {
		$("#opcion3").html("");		
		$("#opcion4").html("");	
		$("#opcion5").html("");	
		$("#opcion6").html("");	
		$("#opcion7").html("");
	});
});

function adaptar(cont, pal){
	var ad = pal;
	if(cont == 1){ //primera letra en mayusculas
		ad = pal.charAt(0).toUpperCase() + pal.slice(1);}
	else if(cont > 1){ // Texto en mayusculas
		ad = pal.toUpperCase();}
	return ad;
}


function ventana(cod, s1, s2, s3, s4, s5, s6, s7){
	s3 || ( s3 = 'null' );
	s4 || ( s4 = 'null' );
	s5 || ( s5 = 'null' );
	s6 || ( s6 = 'null' );
	s7 || ( s7 = 'null' );

	document.getElementById('valor').value = cod;
	var pal = document.getElementById(cod).innerHTML;// palabra a cambiar
	var letras_mayusculas="ABCDEFGHYJKLMNÑOPQRSTUVWXYZ";
	var cont = 0;
	var i;
	for(i=0; i<pal.length; i++)
	{
		if (letras_mayusculas.indexOf(pal.charAt(i),0)!=-1)
		{
			cont++;
		}		
	}
	
	document.getElementById(cod).className = "visto";
	
	var v, ad, s, masInfo, html, pLinea, op, opcion;
	var vector = new Array(s1, s2, s3, s4, s5, s6, s7);
	s = s1;
	i = 1;
	
	while(s != 'null')
	{		
		v = s.split("#");
		ad = adaptar(cont, v[0]);
		s = s.replace(v[0], "");		
		s = s.replace(v[1], "");			
		s = s.replace("##", "");	
		masInfo = ' <a href="http://lema.rae.es/drae/?val=' + ad.toLowerCase().replace(" ", "+") + '" target="_blank">[más]</a>';
		op = "op" + i;
		opcion = "#opcion" + i;
		var pLinea = '<label class="pLinea" for="' + op + '"><b>' + ad + "</b>.</label><br/>";
		var sLinea = '<label class="sLinea" for="' + op + '">&middot;Exp: ' + v[1] + masInfo + '</label> ';
		if(pal == ad)
		{
			var html = '<input id="' + op + '" checked="checked" type="radio" name="opciones" value="' + ad + '">' + pLinea + '</input>' + sLinea + '<br/><label class="ejemplo" for="' + op + '">&middot;' + s + '</label><hr>';
		}
		else
		{
			var html = '<input id="' + op + '" type="radio" name="opciones" value="' + ad + '">' + pLinea + '</input>' + sLinea + '<br/><label class="ejemplo" for="' + op + '">&middot;' + s + '</label><hr>';
		}
		$(opcion).html(html);	
		s = vector[i];
		i++;		
	}
	document.getElementById('zoom').click();
}

function seleccionado(){
	var sel = "op1", i=2;	
	while(!document.getElementById(sel).checked)
	{
		sel = "op" + i;
		i++;
	}
    return sel;
}

function cambiar(){
	var id = document.getElementById('valor').value;
	document.getElementById(id).innerHTML = document.getElementById(seleccionado()).value;
	document.getElementById('btnNo').click();
}

function seleccion(){
	document.getElementById('cod').value = document.getElementById('sel').value;
}

function tiempo(){
	setTimeout(ocultarMensaje,2000);
}

function ocultarMensaje(){
	$(document).ready(function(){
		$("#alerta").hide("slow");
	});
}

function ventanaCarga()
{
	var ventana = document.getElementById('ventanaCarga'); // Accedemos al contenedor
    ventana.style.marginTop = "100px"; // Definimos su posición vertical. La ponemos fija para simplificar el c�digo
    ventana.style.marginLeft = ((document.body.clientWidth-350) / 2) +  "px"; // Definimos su posición horizontal
    ventana.style.display = 'block'; // Y lo hacemos visible		
	document.getElementById('enviar').click();
}

function modal()
{
	document.getElementById('zoom').click();
}







