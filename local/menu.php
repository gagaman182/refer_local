<div id="wrapper" class="animate">
    <nav class="py-3 navbar header-top fixed-top navbar-expand-lg navbar-dark bg-navbar">
		<span class="navbar-toggler-icon leftmenutrigger"></span>
		<p class="h3 my-0 mr-md-auto font-weight-normal text-white"><i class="far fa-hospital"></i> ระบบนัดผู้ป่วยส่งต่อ โรงพยาบาลหาดใหญ่</p>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarText" role="tablist" aria-orientation="vertical">
			<!-- <ul class="navbar-nav animate side-nav"> -->
			<ul class="navbar-nav animate side-nav nav nav-pills" id="pills-tab" role="tablist">
				<li class="nav-item">
					 <a class="nav-link active" id="m-refer-tab" data-toggle="pill" href="#m-refer" role="tab" aria-controls="m-refer" aria-selected="true"><i class="fas fa-ambulance"></i> รอทำบัตร <i class="fas fa-ambulance shortmenu animate"></i></a>					
				</li>
				<li class="nav-item">
					 <a class="nav-link" id="m-history-tab" data-toggle="pill" href="#m-history" role="tab" aria-controls="m-history" aria-selected="false"><i class="fas fa-user-circle"></i> รอลงนัด<i class="fas fa-user-circle shortmenu animate"></i></a>
				</li>
				<li class="nav-item">
					 <a class="nav-link" id="m-calendar-tab" data-toggle="pill" href="#m-calendar" role="tab" aria-controls="m-calendar" aria-selected="false"><i class="fas fa-calendar-alt"></i> ปฏิทิน<i class="fas fa-calendar-alt shortmenu animate"></i></a>
				</li>	
				<li class="nav-item">
					 <a class="nav-link" id="m-report-tab" data-toggle="pill" href="#m-report" role="tab" aria-controls="m-report" aria-selected="false"><i class="fas fa-chart-bar"></i> สถิติ<i class="fas fa-chart-bar shortmenu animate"></i></a>
				</li>	
				<li class="nav-item">
					<a class="nav-link" href="login/logout.php" title="Logout"><i class="fas fa-sign-out-alt fa-2x"></i> Logout <i class="fas fa-sign-out-alt fa-2x shortmenu animate"></i></a>
				</li>				
			</ul>
		
			<ul class="navbar-nav ml-md-auto d-md-flex">				
				<?php 					
					if(!isset($_SESSION['hospname']) || $_SESSION['hospname']==""){
						echo '<li class="nav-item">';
						echo '<a class="nav-link" href="login/index.php"><i class="fas fa-sign-in-alt"></i> Login</a>';
						echo '</li>';
					}else{
						echo '<li class="h5 nav-item">';
						echo '<i class="fas fa-home"></i> '.$_SESSION['hospname'];
						echo '</li>';
						
					}
				?>
			</ul>
		</div>
    </nav>