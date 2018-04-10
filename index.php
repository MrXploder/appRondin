<?php require $_SERVER['DOCUMENT_ROOT'].'/php/functions/versionControll.php'; ?>
<!DOCTYPE html>
<html ng-app="appRondin" ng-controller="appRondinController">
<head>
	<title>Tecnoelectrica Valparaiso S.A.</title>
	<!--META-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<!--NOSCRIPT-->
	<noscript><meta http-equiv="Refresh" content="0; URL=./nojs.html"></noscript>
	<!--<link rel="manifest" href="../manifest.json">-->
	<!--No descuidar el orden de los archivos CCS y JS-->
	<!--CSS DEPENDENCIES-->
	<link rel="stylesheet" href="../css/materialize.css">
	<link rel="stylesheet" href="../css/materialize-stickyfooter.css">
	<link rel='stylesheet' href="../css/loading-bar.css">
	<link rel="stylesheet" href="../css/spinkit.css">
	<link rel="stylesheet" href="../css/fontawesome.css">
	<link rel="stylesheet" href="../css/webfont.css">
	<link rel="stylesheet" href="../css/custom.css">
	<!--JAVASCRIPT DEPENDENCIES-->
	<script src="../js/dependencies/jquery.js"></script>
	<script src="../js/dependencies/angular.js"></script>
	<script src="../js/dependencies/materialize.js"></script>
	<script src="../js/dependencies/angular-html5storage.js"></script>
	<script src="../js/dependencies/angular-loadingBar.js"></script>
	<script src="../js/dependencies/angular-dirPagination.js"></script>
	<script src="../js/dependencies/angular-materialize.js"></script>
	<script src="../js/dependencies/angular-locale_es-419.js"></script>
	<!--ANGULARJS-APP-->
	<!--ANGULAR MODULES-->
	<script src="../js/modules/appRondin.js?v=<?php echo $versionControll ?>"></script>
	<!--ANGULAR RUNS-->
	<script src="../js/runs/navigatorOnline.js?v=<?php echo $versionControll ?>"></script>
	<!--ANGULAR DIRECTIVES-->
	<script src="../js/directives/stringToNumber.js?v=<?php echo $versionControll ?>"></script>
	<!--ANGULAR CONTROLLERS-->
	<script src="../js/controllers/apps.js?v=<?php echo $versionControll ?>"></script>
</head>
<body>
	<header>
		<div class="navbar">
			<nav class="white">
				<div class="nav-wrapper">
					<a href="#"><img src="../img/tecnoelectrica-logo.png" class="vMiddle" style="width: 100px; height: 50px; margin-left: 15px;"></img></a>
				</div>
			</nav>
		</div>
	</header>
	<main ng-init="isRouteLoading = true">
		<div class="screenCentered" ng-show="isRouteLoading">
			<div class='sk-folding-cube'>
				<div class='sk-cube1 sk-cube'></div>
				<div class='sk-cube2 sk-cube'></div>
				<div class='sk-cube4 sk-cube'></div>
				<div class='sk-cube3 sk-cube'></div>
			</div>   
		</div>
		<div id="preloaderScreen" class="modal modalLikeLoader vMiddle hCenter" ng-cloak>
			<br><br><br><br>
			<div class="preloader-wrapper big active">
				<div class="spinner-layer spinner-blue">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div><div class="gap-patch">
						<div class="circle"></div>
					</div><div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
				<div class="spinner-layer spinner-red">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div><div class="gap-patch">
						<div class="circle"></div>
					</div><div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
				<div class="spinner-layer spinner-yellow">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div><div class="gap-patch">
						<div class="circle"></div>
					</div><div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
				<div class="spinner-layer spinner-green">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div><div class="gap-patch">
						<div class="circle"></div>
					</div><div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
			</div>
			<br><br><br><br>
		</div>
		<!-- START - APPCONTAINER -->
		<div id="contentScreen" ng-show="!isRouteLoading" ng-cloak>
			<div class="container">
				<div class="row">
					<ul class="collapsible popout" data-collapsible="accordion">
						<!-- START - ENCABEZADO ACORDEON -->
						<li ng-show="rondin_isAdmin.status">
							<div style="display: block" class="collapsible-header" ng-class="online ? 'green':'red'">
								<div ng-class="online ? 'white-text':'black-text'">
									<p style="text-align: left; font-size: 2.28rem;">{{rondin_isAdmin.status ? rondin_isAdmin.name : ''}}<span style="float:right;"><i class="fas fa-times" ng-if="rondin_isAdmin.status" ng-click="logOut()"></i></span>
									</p>
								</div>
							</div>
						</li>
						<!-- END - ENCABEZADO ACORDEON -->

						<!-- START - VER LOG-->
						<li ng-show="rondin_isAdmin.status">
							<div class="collapsible-header" ng-class="online ? 'amber':'white'"><i class="fas fa-map-signs"></i>Revisar Información</div>
							<div class="collapsible-body">
								<div class="row">
									<table class="responsive-table colored-table">
										<thead>
											<tr>
												<th class="vMiddle hCenter">#</th>
												<th class="vMiddle hCenter">Lugar</th>
												<th class="vMiddle hCenter">Fecha</th>
												<th class="vMiddle hCenter">Hora</th>
											</tr>
										</thead>
										<tbody>
											<tr dir-paginate="log in rondin_logs | itemsPerPage: 10" pagination-id="logsPaginationControll">
												<td class="vMiddle hCenter">{{log.id_log}}</td>
												<td class="vMiddle hCenter">{{log.name ? log.name : log.uidreadedtag | uppercase}}</td>
												<td class="vMiddle hCenter">{{log.timestamp * 1000 | date: 'EEE dd-MM-yyyy'}}</td>
												<td class="vMiddle hCenter">{{log.timestamp * 1000 | date: 'HH:mm:ss'}}</td>
											</tr>
										</tbody>
										<tr></tr>
									</table>
								</div>
								<div class="row">
									<dir-pagination-controls boundary-links="true" template-url="dirPagination.tpl.html" pagination-id="logsPaginationControll"></dir-pagination-controls>
								</div>
							</div>
						</li>
						<!-- END - ADMINISTRAR TICKETS -->

						<!-- START - -->
						<li ng-show="rondin_isAdmin.status && rondin_isAdmin.access_level == 'administrador'">
							<div class="collapsible-header" ng-class="online ? 'red':'white'"><i class="fas fa-database"></i>Administrar TAG's NFC</div>
							<div class="collapsible-body">
								<div class="container">
									<div class="row">
										<table class="responsive-table colored-table">
											<thead>
												<tr><th colspan="2">Agregar TAG</th></tr>
												<tr>
													<th>UID</th>
													<th>Nombre</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><input type="text" ng-model="newTag.uid"></td>
													<td><input type="text" ng-model="newTag.name"></td>
												</tr>
												<tr><td colspan="2"><a class="btn btnForTable waves-effect waves-light blue" ng-click="saveNewTag()"><i class="fas fa-plus"></i></a></td></tr>
											</tbody>
										</table>
									</div>
									<div class="row"><div class="divider"></div></div>
									<div class="row">
										<table class="responsive-table colored-table">
											<thead>
												<tr>
													<th class="vMiddle hCenter">#</th>
													<th class="vMiddle hCenter">UID</th>
													<th class="vMiddle hCenter">Nombre</th>
													<th class="vMiddle hCenter">Editar</th>
												</tr>
											</thead>
											<tbody>
												<tr ng-repeat="tag in rondin_tags">
													<td class="vMiddle hCenter">{{tag.id_tags}}</td>
													<td class="vMiddle hCenter">{{tag.uid | uppercase}}</td>
													<td class="vMiddle hCenter" ng-if="!editTagName">{{tag.name | uppercase}}</td>
													<td class="vMiddle hCenter" ng-if="editTagName"><input type="text" ng-model="tag.name"></td>
													<td class="vMiddle hCenter">
														<a class="btn btnForTable waves-effect waves-light blue" ng-click="enableEditTagNameInPlace()" ng-if="!editTagName"><i class="fas fa-pencil-alt"></i></a>
														<a class="btn btnForTable waves-effect waves-light green" ng-click="saveEditedTagName(tag)" ng-if="editTagName"><i class="fas fa-check"></i></a>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</li>
						<!-- END -->

						<!-- START - SUPERADMINISTRADOR -->
						<li ng-show="!rondin_isAdmin.status">
							<div class="collapsible-header blue-grey"><i class="fab fa-hotjar"></i>Menu de SuperAdministrador</div>
							<div class="collapsible-body">
								<div class="container">
									<ng-form name="ra_form">
										<div class="row"><h5 class="underlined">Ingresar</h5></div>
										<div class="row">
											<div class="input-field">
												<input id="superadmin_pass" type="password"  class="validate" ng-model="newAdministrator.superadmin_pass" required="required">
												<label for="superadmin_pass">Contraseña</label>
											</div>
										</div>
										<div class="row">
											<div class="col l5 s6">
												<button class="btn waves-effect waves-light green" type="submit" ng-disabled="ra_form.$invalid" ng-click="formSubmit('registrarAdministrador')">Enviar<i class="fas fa-share right"></i></button>
											</div>
											<div class="col l5 offset-l2 s6">
												<button class="btn waves-effect waves-light red" type="reset" ng-click="formReset('registrarAdministrador')">Reset<i class="fas fa-eraser right"></i></button>
											</div>
										</div>
									</ng-form>
								</div>
							</div>
						</li>
						<!-- END - SUPERADMINISTRADOR -->
					</ul>
				</div>
				<!-- END - APPCONTAINER -->	
			</div>
		</main>

		<footer class="page-footer footer grey darken-3">
			<div class="container">
				<div class="footer-copyright grey darken-3">
					<div class="container">
						© 2018 Mixtura SpA.<br>
						© 2018 Tecnoelectrica Valparaiso S.A.<br>
						<a href="mailto: l.arancibiaf@gmail.com">© MrXploder AngularJS Dev</a>
						<a class="grey-text text-lighten-4 right" href="#!">Compilación: <?php echo $versionControll ?></a>
					</div>
				</div>
			</div>
		</footer>
	</body>
	</html>
