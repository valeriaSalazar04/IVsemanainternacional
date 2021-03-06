<?php
// Omitir errores
ini_set("display_errors", false);


// Incluimos nustro script php de funciones y conexi&oacute;n a la base de datos
include('scripts/gets.php');
include('includes/mainFunctions.inc.php');
include('scripts/mySQL.php');

$id_ponencia = substr(str_shuffle("0123456789"), 0, 6);

$i=$_GET['id'];

$fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
$fecha_entrada = strtotime("01-10-2017 11:50:00");
$sqlmenu = mysql_query("SELECT * FROM `menu_usuario` WHERE `nombre_modulo`='ponente'");
$visible = 1;

if ($fila = mysql_fetch_assoc($sqlmenu)){
  $visible =$fila['visible'];    
}


if($errorDbConexion == false){
	// MAnda a llamar la funci&oacute;n para mostrar la lista de usuarios
	$consultaUsuarios = consultaUsers($mysqli,$id_ponencia);
}
else
{
	// Regresa error en la base de datos
	$consultaUsuarios = '
		<tr id="sinDatos">
			<td colspan="8" class="centerTXT">ERROR AL CONECTAR CON LA BASE DE DATOS</td>
	   	</tr>
	';
}

?>
<!DOCTYPE html>
 
<html lang="es">
 
<head>
 	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../assets/img/ufps.ico">

    <title>Vicerrectoria Asistente de Investigaci&oacute;n y Extensi&oacute;n</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet"> 

    <!-- Custom styles for this template -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">

    <link href='../assets/css/owl-carousel/owl.carousel.css' rel='stylesheet'>
    <link href='../assets/css/owl-carousel/owl.theme.css' rel='stylesheet'>
    <link href='../assets/css/owl-carousel/custom.css' rel='stylesheet'>
    <link href='../assets/css/owl-carousel/animate.css' rel='stylesheet'>
    <link href="../assets/css/charisma-app.css" rel="stylesheet">


<link type="text/css" href="css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
<link type="text/css" href="css/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link type="text/css" href="css/master.css" rel="stylesheet" />

<script type="text/javascript" src="js/jquery_ui/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="js/jquery_ui/jquery-ui-1.8.23.custom.min.js"></script>
<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>

<script type="text/javascript" src="js/jquery-validation-1.10.0/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/jquery-validation-1.10.0/lib/jquery.metadata.js"></script>
<script type="text/javascript" src="js/jquery-validation-1.10.0/localization/messages_es.js"></script>

<script type="text/javascript" src="js/mainJavaScript.js"></script>

	<script language="javascript">
		$(document).ready(function(){
		   $("#comboFacultad").change(function () {
		      $("#comboFacultad option:selected").each(function () {
		      //alert($(this).val());
		        elegido=$(this).val();
		        $.post("script/comboFacultadSemillero.php", { elegido: elegido }, function(data){
		        $("#facul1").html(data);
		        
		      });     
		        });
		   })
		  
		});
	</script>
	 <script type="text/javascript">
				
		function ValidaSoloNumeros() {
		 if ((event.keyCode < 48) || (event.keyCode > 57)) 
		  event.returnValue = false;
		}

		function txNombres() {
		 if ((event.keyCode != 32) && (event.keyCode < 65) || (event.keyCode > 90) && (event.keyCode < 97) || (event.keyCode > 122))
		  event.returnValue = false;
		}

		function comprueba_extension(formulario, archivo) { 
		   extensiones_permitidas = new Array(".ppt", ".pptx"); 
		   mierror = ""; 
		   if (!archivo) { 
		      //Si no tengo archivo, es que no se ha seleccionado un archivo en el formulario 
		      	mierror = "No has seleccionado ningun archivo"; 
		   }else{ 
		      //recupero la extensión de este nombre de archivo 
		      extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
		      //alert (extension); 
		      //compruebo si la extensión está entre las permitidas 
		      permitida = false; 
		      for (var i = 0; i < extensiones_permitidas.length; i++) { 
		         if (extensiones_permitidas[i] == extension) { 
		         permitida = true; 
		         break; 
		         } 
		      } 
		      if (!permitida) { 
		         mierror = "Comprueba la extension del archivo a subir. \nSolo se pueden subir archivo con extension: " + extensiones_permitidas.join(); 
		      	}else{ 
		         	//submito! 
		        // alert ("Todo correcto. Voy a submitir el formulario."); 
		        // formulario.submit(); 
		        formulario.action="controller/encuentro_semilleros.php";
		         return true; 
		      	} 
		   } 
		   //si estoy aqui es que no se ha podido submitir 
		   alert (mierror); 
		   return false; 
		}


	</script>
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">IV SEMANA INTERNACIONAL Y XII SEMANA DE CIENCIA, TECNOLOG&Iacute;A E INNOVACI&Oacute;N</a>
        </div>
        <div class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav">
            <li><a href="../index.html">INICIO</a></li>
	        
             <li><a href="rally.html">RALLY INNOVACI&Oacute;N</a></li>
	        <li><a href="../registro_asistentes/index.php">ASISTENTES</a></li>
            <li><a href="../semilleros.html">CONVOCATORIA SEMILLEROS</a></li>
            <li><a href="../comite.html">COMIT&Eacute; CIENT&Iacute;FICO</a></li>
            <li><a href="../contacto.html">CONTACTO</a></li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">MEMORIAS<b class="caret"></b></a>
	          <ul class="dropdown-menu">
	            <li><a href="http://www.ufps.edu.co/Isemanainternacionalcyt/" target="_blank">2014</a></li>
	            <li><a href="http://www.ufps.edu.co/ufps/IIsemanainternacional_cyt/" target="_blank">2015</a></li>
	            <li><a href="https://ww2.ufps.edu.co/public/archivos/oferta_academica/76c4c5574aeacbb649c348dec13a663e.pdf" target="_blank">2016</a></li>
	          </ul>	            
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

	<!-- *****************************************************************************************************************
	 BLUE WRAP
	 ***************************************************************************************************************** -->
	<div id="blue">
	    <div class="container">
			<div class="row">
				<h3>II ENCUENTRO INSTITUCIONAL DE SEMILLEROS DE INVESTIGACI&Oacute;N</h3>
			</div> 
	    </div>  
	</div> 
	<div class="box-content alerts">
		<?if($i==1){ ?>
			<div class="alert alert-success">
			    <button type="button" class="close" data-dismiss="alert">&times;</button>
			    <strong>Registro Exitoso</strong> 
			  </div>
		<?}?>
		<?if($i==2){ ?>
			<div class="alert alert-info">
			    <button type="button" class="close" data-dismiss="alert">&times;</button>
			    <strong>Error Conexion con la base de datos.</strong> 
			  </div>
		<?}?>
		<?if($i==3){ ?>
			<div class="alert alert-danger">
			    <button type="button" class="close" data-dismiss="alert">&times;</button>
			    <strong>Error. No se registro la ponencia.</strong> 
			  </div>
		<?}?>
	  
	</div>

<?
	if( ($visible==0) && ($fecha_actual > $fecha_entrada)){?>
    <br />
    <br />
     Estimado usuario, la convocatoria al II Encuentro Institucional de Semilleros de Investigaci&oacute;n
     que se desarrollar&aacute; el 27 de octubre del 2016, finaliz&oacute; 
     su proceso de inscripci&oacute;n el 7 de octubre a las 11:50 am.
    <br /><br />

 <?
}else{ ?>

	    <div class="hide" id="agregarUser" Title="Agregar Ponente">
	    	<form action="" method="post" id="formUsers" name="formUsers">
	    		<fieldset id="ocultos">
	    			<input type="hidden" id="accion" name="accion" class="{required:true}"/>
	    			<input type="hidden" id="id_user" name="id_user" class="{required:true}" value="0"/>
	    			<input type="hidden" id="id_ponencia" name="id_ponencia" class="{required:true}" value="<?echo $id_ponencia?>"/>	    		</fieldset>
				<fieldset id="datosUser">
					<p>Nombre</p>
					<span></span>
					<input type="text" onkeypress="txNombres()" class="form-control {required:true} span3" id="nombre" name="nombre" placeholder="Nombre Completo" />
					<p>N&uacute;mero de Identificaci&oacute;n</p>
					<span></span>
					<input type="text" onkeypress="ValidaSoloNumeros()" class="form-control {required:true} span3" id="identificacion" name="identificacion" placeholder="N&uacute;mero de Identificaci&oacute;n" />
					<p>Email</p>
					<span></span>
					<input type="text" class="form-control {required:true} span3" id="email" name="email" placeholder="Correo Electronico"/>
					<p>Semestre</p>
					<span></span>
					<select name="semestre" required class="form-control {required:true} span3">	
				        <option value=""> Seleccione </option>
				        <option value="1"> 1 </option>
				        <option value="2"> 2 </option>
				        <option value="3"> 3 </option>
				        <option value="4"> 4 </option>
				        <option value="5"> 5 </option>
				        <option value="6"> 6 </option>
				        <option value="7"> 7 </option>
				        <option value="8"> 8 </option>
				        <option value="9"> 9 </option>
				        <option value="10"> 10 </option>
			        </select>
					<br><br>
				</fieldset>
				<fieldset id="btnAgregar" style="text-align:center;">
					<input class="btn btn-inverse btn-small" type="submit" id="continuar" value="Guardar" />
					<br>
				</fieldset>

				<fieldset id="ajaxLoader" class="ajaxLoader hide">
					<img src="images/default-loader.gif">
					<p>Espere un momento...</p>
				</fieldset>
			</form>
	    </div>
	
	    <div id="dialog-borrar" title="Eliminar registro" class="hide">
			<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Este registro se borrar&aacute; de forma permanente. ¿Esta seguro?</p>
		</div>
		
		<div class="container">
			<h4>Datos de los Ponentes</h4>
		    <section id="content" style="overflow-x: scroll;">
		    	<div id="btnAddUser" class="center addUser">
		    		<button id="goNuevoUser" class="btn btn-inverse btn-small"><i class="icon-plus"></i> Agregar Ponente</button>
		    	</div>
				<div id="listaOrganizadores">
					<table id="listadoUsers" class="table table-striped table-bordered table-hover table-condensed">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>N° de Identificaci&oacute;n</th>
								<th>Email</th>
								<th>Semestre</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="listaUsuariosOK">
							<?php echo $consultaUsuarios ?>
						</tbody>
					</table>
				</div>

		    </section>
 		</div>

	<div class="container mtb" style="margin-top: 10px;">
	 	<div class="row">
	 		<div class="col-lg-8">	 			
		 		<form role="form" method="post" enctype="multipart/form-data" target="_parent"  name="fcontacto" >
					  <div class="form-group">
					  	<input type="hidden" id="id_ponencia" name="id_ponencia" class="{required:true}" value="<?echo $id_ponencia?>"/>
					    
					  	<label for="InputName1">&Aacute;rea de Conocimiento : <span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span></label><!-- -->
					    <select name="facultad" required class="form-control" id="comboFacultad">	
			        	   <option value=""> Seleccione </option>
			               <? echo getFacultad(); ?>   
			            </select>
					  </div>
			            
					   <div id="facul1">
					  
					     <label>Semillero de Investigaci&oacute;n:<span title="Campo Obligatorio" style="color: red; font-size: 13pt;">*</span> </label>
					     <select required class="form-control" name="semillero"> 
					        <option value=""> Seleccione </option>
					        <? echo getSemillero(); ?>
					     </select>         
					  </div>	
					  <br/>  
					  <div class="form-group">
					  	<label>Anexo Presentaci&oacute;n del Semillero(M&aacute;ximo 7MB):<span title="Campo Obligatorio" style="color: red; font-size: 9pt;">*Solo se permite extensi&oacute;n .ppt, .pptx</span></label>
					  	<input class="form-control" name="archivo1" type="file" required/>    
					  </div>
					                         
					  <br>
					  <button type="submit" class="btn btn-theme" onclick="comprueba_extension(this.form, this.form.archivo1.value)">Registrar</button><br><br>
				</form>
			</div> 
	 		
	 	</div> 
	 </div> 

<? 
  }?>


	<!-- *****************************************************************************************************************
	 FOOTER
	 ***************************************************************************************************************** -->
	<div class="row">
    <div class="owl-clients-v1 wow fadeInUp animated owl-carousel owl-theme animated" style="text-align:center;padding: 5px; opacity: 1; display: block; visibility: visible; animation-name: fadeInUp; background-color: rgb(238, 238, 238);">
      <div class="owl-wrapper-outer">
            <a href="http://www.mineducacion.gov.co"><img src="../assets/img/organismos/mineducacion.png" class="hover-shadow" alt=""></a>         
            <a href="http://www.gobiernoenlinea.gov.co"><img src="../assets/img/organismos/gobiernoenlinea.png" class="hover-shadow" alt=""></a>          
            <a href="http://www.icfes.gov.co/"><img src="../assets/img/organismos/icfes.png" class="hover-shadow" alt=""></a>         
            <a href="http://www.colombiaaprende.edu.co"><img src="../assets/img/organismos/colombiaaprende.png" class="hover-shadow" alt=""></a>          
            <a href="http://www.renata.edu.co"><img src="../assets/img/organismos/renata-logo.png" class="hover-shadow" alt=""></a>          
            <a href="http://www.colciencias.gov.co"><img src="../assets/img/organismos/COLCIENCIAS.png" class="hover-shadow" alt=""></a>  
       </div>
    </div>
</div>

<div>
    <footer class="row">
        <div class="col-xs-9">
            <br>
            <p style="text-align: center;color:#eee;"> 
             Avenida Gran Colombia No. 12E-96B Colsag. San Jos&eacute; de C&uacute;cuta - Colombia.
            </p>
            <p style="text-align: center;color:#eee;">
                Vicerrector&iacute;a Asistente de Investigaci&oacute;n y Extensi&oacute;n
            </p>
            <p style="text-align: center;color:#eee;">
                Edificio Vicerrectoría Asistente de Investigación y Extensión - Tel&eacute;fono (057)(7) 5776655 Ext 172.
            </p>
        </div>
        <center>
        <div class="col-xs-3">
            <div class="footer-main">
                <a href="http://www.ufps.edu.co/"> 
                <img src="../assets/img/logoufpsvertical.png" class="img-responsive" alt="">
                </a>
            </div>
        </div>
    </center>
    </footer>
    <div class="row">
        <div class="footer2">             
            <div class"col-md-8">
                <p style="margin-left:20px;color:#eee;"> 2017 &copy; Derechos Reservados. 
                <a href="http://www.ufps.edu.co/ufpsnuevo/modulos/contenido/view_contenido.php?item=22" target="_blank"> 
                    Vicerrector&iacute;a Asistente de Investigaci&oacute;n y Extensi&oacute;n</a>
                 | Desarrollado por: Valeria Salazar-VAIE </p>
            </div>
        </div>
    </div>
</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
 <!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
    <script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/retina-1.1.0.js"></script>
	<script src="../assets/js/jquery.hoverdir.js"></script>
	<script src="../assets/js/jquery.hoverex.min.js"></script>
	<script src="../assets/js/jquery.prettyPhoto.js"></script>
  	<script src="../assets/js/jquery.isotope.min.js"></script>
  	<script src="../assets/js/custom.js"></script>
</body>
</html>


