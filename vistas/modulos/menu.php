<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu">
		<!-- =============================================
		INICIO
		============================================= -->
			<li class="active">
				<a href="inicio">
					<i class="fa fa-home"></i>
					<span>Inicio</span>
				</a>
			</li>

		
	<?php	
	    /*=============================================
		CONFIGURAR POL�0�1TICIAS
		=============================================*/
		if($_SESSION["permisos"]["veradministracionintegradoor"] == "x"){	
			echo '<li class="dropdown user user-menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<i class="fa fa-wrench" aria-hidden="true"></i>
				<span >Administrador Integradoor</span>
			</a>			
				<ul class="dropdown-menu right">
					<li class="user-body">			
						<a href="politicas" class="btn btn-default btn-flat"><i class="" style="color: red;"></i>Pol��ticas</a>
					</li>
					<li class="user-body">	
						<a href="inicio" class="btn btn-default btn-flat"><i class="" style="color: red;"></i>Planes</a>
					</li>
					<li class="user-body">	
						<a href="inicio" class="btn btn-default btn-flat"><i class="" style="color: red;"></i>Contratos</a>
					</li>
					<li class="user-body">	
						<a href="inicio" class="btn btn-default btn-flat"><i class="" style="color: red;"></i>Pagos</a>
					</li>

				</ul>
		</li>';
			}
	
	
		/*=============================================
		ADMINISTRAR COTIZACIONES
		=============================================*/
		if($_SESSION["permisos"]["administracionCotizaciones"] == "x"){	
			echo '<li>
					<a href="adminCoti">
						<i class="fa fa-list-ul"></i>
						<span>Admin Cotizaciones</span>
					</a>
				 </li>';
			}
		/*=============================================
		AUTOGESTION
		=============================================*/	
		if($_SESSION["permisos"]["administracionCotizaciones"] == "x"){	
			echo '<!--<li>
				<a href="autogestion">
					<i class="fa fa-user"></i>
					<span>Autogesti��n</span>
				</a>
			</li>-->';
		}
		
		/*=============================================
		CLIENTES
		=============================================*/
		if($_SESSION["permisos"]["Clientes"] == "x"){	
			echo '<li>
				<a href="clientes">
					<i class="fa fa-user-circle-o"></i>
					<span>Clientes</span>
				</a>
			</li>';
		}
		/*=============================================
		COTIZAR LIVIANO
		=============================================*/
	?>
			<li>
				<a  id = "btnCotizarMenu" >
					<i class="fa fa-car"></i>
					<span>Cotizar Liviano</span>
				</a>
			</li>

			
	<?php	
		/*=============================================
		COTIZACIONES MASIVAS
		=============================================*/
		if($_SESSION["permisos"]["Cotizacionesmasivas"] == "x"){	
			echo  '<li>
				<a href="livianoMasivas">
					<i class="fa fa-file-archive-o"></i>
					<span>Cotizaciones masivas liviano</span>
				</a>
			</li>';
		}
		/*=============================================
		PESADOS
		=============================================*/
		if($_SESSION["permisos"]["Cotizarpesados"] == "x"){	
			echo '<li>
				<a href="pesados">
					<i class="fa fa-truck"></i>
					<span>Cotizar Pesados</span>
				</a>
			</li>';
		}
		/*=============================================
		MOTOS
		=============================================*/
		if($_SESSION["permisos"]["Cotizarmotos"] == "x"){	
			echo '<li>
				<a href="motos">
					<i class="fa fa-motorcycle"></i>
					<span>Cotizar Motos</span>
				</a>
			</li>';
		}
		/*=============================================
		USUARIOS
		=============================================*/
		if($_SESSION["permisos"]["AdministrarUsuarios"] == "x"){	
			echo '<li>
				<a href="usuarios">
					<i class="fa fa-user-plus"></i>
					<span>Usuarios</span>
				</a>
			</li>';
		}
		/*=============================================
		PRODUCTOS
		=============================================*/	
		if($_SESSION["permisos"]["Modificaciondeproductos"] == "x"){	
			echo '<li>
				<a href="Productos">
					<i class="fa fa-folder"></i>
					<span>Productos</span>
				</a>
			</li>';
		}
		/*=============================================
		AYUDA VENTAS
		=============================================*/		
	?>
		<!--<li>-->
		<!--	<a id="ayuda-ventas">-->
		<!--		<i class="fa fa-book"></i>-->
		<!--		<span>Ayuda Ventas</span>-->
		<!--	</a>-->
		<!--</li>-->
	<?php
		/*=============================================
		INTERMEDIARIO
		=============================================*/	
		if($_SESSION["permisos"]["Agregarintermediario"] == "x"){	
			echo '<li>
				<a href="intermediario">
					<i class="fa fa-briefcase"></i>
					<span>Intermediario</span>
				</a>
			</li>';
		}
		/*=============================================
		CONFIGURAR PDF
		=============================================*/	
// 			if($_SESSION["permisos"]["Configuraciondeplantillasdepdf"] == "x"){	
// 			echo '<li>
// 				<a id="configuracion-pdf">
// 					<i class="fa fa-cog" aria-hidden="true"></i>
// 					<span>Configuracion</span>
// 				</a>
// 			</li>';
// 		}
	?>
		
	

	</ul>
	</section>
</aside>