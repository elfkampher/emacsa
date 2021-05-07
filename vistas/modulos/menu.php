<?php
$deshabilitar = "";
$admin = "";
if($_SESSION["id_perfil"]==10){
	$deshabilitar = 'hidden';
}
if($_SESSION["id_perfil"]<>9){
	$admin = 'hidden';
}
?>
<aside class="main-sidebar">

	<section class="sidebar">

		<ul class="sidebar-menu">
			
			<li class="active">
				
				<a href="inicio">
					
					<i class="fa fa-home"></i>
					<span>Inicio</span>

				</a>

			</li>

			<li <?php echo $admin;?>>
				
				<a href="usuarios">
					
					<i class="fa fa-user"></i>
					<span>Usuarios</span>

				</a>

			</li>

			<li <?php echo $admin;?>>
				
				<a href="clientes">
					
					<i class="fa fa-id-card-o"></i>
					<span>Clientes</span>

				</a>

			</li>

			<li <?php echo $deshabilitar; echo $admin;?>>
				
				<a href="obras">
					
					<i class="fa fa-building"></i>
					<span>Obras</span>

				</a>

			</li>

<!-- 			<li >
				
				<a href="categorias">
					
					<i class="fa fa-th"></i>
					<span>Categorias</span>

				</a>

			</li>-->

			<li > 
				
				<a href="productos">
					
					<i class="fa fa-product-hunt"></i>
					<span>Productos</span>

				</a>

			</li>

			<li <?php echo $deshabilitar; ?>>
				
				<a href="escaneo">
					
					<i class="fa fa-camera"></i>
					<span>Escaneo</span>

				</a>

			</li>

			
			<li class="treeview" <?php echo $deshabilitar; ?>>
				
				<a href="#">
					
					<i class="fa fa-file"></i>
					<span>Remisiones</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>

				</a>

				 <ul class="treeview-menu">
					
					<li>

						<a href="remisiones">

							<i class="fa fa-circle-o"></i>
							<span>Administrar Remisiones</span>

						</a>

					</li>

					<li>
						
						<a href="crear-remision">
							
							<i class="fa fa-circle-o"></i>
							<span>Nueva Remision</span>								

						</a>

					</li>					

				</ul> 

			</li>

		</ul>
		

	</section>
	


</aside>