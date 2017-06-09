<header>
		<ul id="md1" class="dropdown-content">
  			<?php 
  				session_start();
  				if (!isset($_SESSION['ID']) || empty($_SESSION['ID'])) {
  					echo "<li><a href='login.php'>Entrar</a></li>";
  					echo "<li><a href='register.php'>Registrarse</a></li>";
  					if (   $pagename == "Añadir nuevo vehículo" 
  						|| $pagename == "Añadir gasto" 
  						|| $pagename == "Añadir nuevo modelo" 
  						|| $pagename == "Modificar Perfil"
  						|| $pagename == "Modificar Vehículo"
  						|| $pagename == "Modificar Gasto") 	echo "<script>window.location='login.php';</script>";
  				} else {
					echo "<li><a href='profile.php'>Mi Perfil</a></li>";
  			    	echo "<li><a href='closeSession.php'>Cerrar Sesión</a></li>";
  			    	$id_user = $_SESSION['ID'];
  			    }
 			?>
		</ul>

	    <nav>
	      <div class="nav-wrapper">
	        <a class="brand-logo flow-text"><?php echo $pagename ?></a>
	        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
	        <ul id="nav-mobile" class="right hide-on-med-and-down">
	                <li><a class="dropdown-button" href="#!" data-activates="md1"><i class="material-icons right">arrow_drop_down</i></a></li>
	        </ul>
	        <ul class="side-nav" id="mobile-demo">
			<?php 
	        	include 'php/connection.php';
  				session_start();
  				if (!isset($_SESSION['ID']) || empty($_SESSION['ID'])) {
  					echo "<li><a href='login.php'>Entrar</a></li>";
  					echo "<li><a href='register.php'>Registrarse</a></li>";
  					echo "<li><a href='who.php'>Quienes somos</a></li>";
  				} else {
  					$id_userh 	= $_SESSION['ID'];
  					$sqlh		= "SELECT * FROM vehicles WHERE id_user = ".$id_userh;
  					$resulth 	= $con->query($sqlh);
					echo "<li><a href='profile.php'>Mi Perfil</a></li>";
					echo "<li><a href='modProfile.php'>Modificar Perfil</a></li>";
					if (mysqli_num_rows($resulth) != 0) {
						echo "<li class='no-padding'>";
      						echo "<ul class='collapsible collapsible-accordion'>";
        						echo "<li>";
          						echo "<a class='collapsible-header'>Mis coches<i class='mdi-navigation-arrow-drop-down'></i></a>";
          						echo "<div class='collapsible-body'><ul>";
						while ($rowh = mysqli_fetch_array($resulth)) {
							$sql2h 	= "SELECT * FROM models WHERE id_model =".$rowh['id_model'];
							$result2h = $con->query($sql2h);
							$row2h 	= mysqli_fetch_array($result2h);
							echo "<li><a href='vehicle.php?id=".$rowh['id_veh']."'>".$row2h['manufacturer']." ".$row2h['model']."</a></li>";
						}
						echo "</li></ul></div></li></ul></li>";
					}
					echo "<li><a href='newVehicle.php'>Añadir Vehículo</a></li>";
					echo "<li><a href='who.php'>Quienes somos</a></li>";
  			    	echo "<li><a href='closeSession.php'>Cerrar Sesión</a></li>";
  			    }
 			?>
		    </ul>
	      </div>
		</nav>
  	
  	<ul id="slide-out" class="side-nav fixed">
		<li class="logo"><a id="logo-container" href="http://www.llenoporfavor.es" class="brand-logo">
			<img src="media/vaquita.png">
		</a></li>
			<?php 
	        	include 'php/connection.php';
  				session_start();
  				if (!isset($_SESSION['ID']) || empty($_SESSION['ID'])) {
  					echo "<li><a href='login.php'>Entrar</a></li>";
  					echo "<li><a href='register.php'>Registrarse</a></li>";
  					echo "<li><a href='who.php'>Quienes somos</a></li>";
  				} else {
  					$id_user1 	= $_SESSION['ID'];
  					$sqlh1		= "SELECT * FROM vehicles WHERE id_user = ".$id_user1;
  					$resulth1 	= $con->query($sqlh1);
					echo "<li><a href='profile.php'>Mi Perfil</a></li>";
					echo "<li><a href='modProfile.php'>Modificar Perfil</a></li>";
					if (mysqli_num_rows($resulth1) != 0) {
						echo "<li class='no-padding'>";
      						echo "<ul class='collapsible collapsible-accordion'>";
        						echo "<li>";
          						echo "<a class='collapsible-header'>Mis coches<i class='mdi-navigation-arrow-drop-down'></i></a>";
          						echo "<div class='collapsible-body'><ul>";
						while ($rowh = mysqli_fetch_array($resulth1)) {
							$sql2h 	= "SELECT * FROM models WHERE id_model =".$rowh['id_model'];
							$result2h = $con->query($sql2h);
							$row2h 	= mysqli_fetch_array($result2h);
							echo "<li><a href='vehicle.php?id=".$rowh['id_veh']."'>".$row2h['manufacturer']." ".$row2h['model']."</a></li>";
						}
						echo "</li></ul></div></li></ul></li>";
					}
					echo "<li><a href='newVehicle.php'>Añadir Vehículo</a></li>";
					echo "<li><a href='who.php'>Quienes somos</a></li>";
  			    	echo "<li><a href='closeSession.php'>Cerrar Sesión</a></li>";
  			    }
 			?>
	</ul>
</header>