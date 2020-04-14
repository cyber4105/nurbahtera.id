<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="treeflex.css">
	<!-- <link rel="stylesheet" href="https://unpkg.com/treeflex/dist/css/treeflex.css"> -->
	<style type="text/css" media="screen">
	span.tf-nc{
		width: 120px;
		height: 150px;
		padding: 10px;
	}
	.NetworkLabelId{
		color:red;
	}
	.NetworkLabelName{
		font-size: 12px;
	}
	.NetworkAddNewLevel{
		position: absolute;
		bottom: 0px;
		padding: 12px;
	}
</style>
</head>
<body>
	<div class="tf-tree tf-gap-lg">
		<ul>
			<?php 
			include 'dataJson.php';
			
			$lvl0 = json_decode(queryMlm(),TRUE);
			if (isset($_GET['userId'])) {
				$master = json_decode(getMember($_GET['userId']),TRUE);
			}else{
				$master = json_decode(getMember('0001'),TRUE);
			}
			// var_dump($master);
			 ?>
			 <?php foreach ($master as $l0 => $vl0): ?>	
				<li><!-- level 0 -->
					<span class="tf-nc">
						<div class="profile">
							<img src="userAdd.png" width="50">
							<p class="NetworkLabelId"><?= $master[$l0]['userId'] ?></p>
							<p class="NetworkLabelName"><?= $master[$l0]['nama'] ?></p>
						</div>
					</span>
					<ul>
						<!-- == START LEVEL 1 == -->
						<?php if (queryMlmNumRows($master[$l0]['userId']) != 0): ?>
							<?php $lvl1 = json_decode(queryMlm($master[$l0]['userId']),TRUE); 
								foreach ($lvl1 as $l1 => $vl1): ?>
								<li><!-- level 1 -->
									<span class="tf-nc">
										<img src="userAdd.png" width="50">
										<!-- <p class="NetworkAddNewLevel">LEVEL 1</p> -->
										<p class="NetworkLabelId"><?= $lvl1[$l1]['userId'] ?></p>
										<p class="NetworkLabelName"><?= $lvl1[$l1]['nama'] ?></p>
									</span>
											<!-- level 2 -->

									<ul>
										<?php if (queryMlmNumRows($lvl1[$l1]['userId']) != 0): ?>
											<?php $lvl2 = json_decode(queryMlm($lvl1[$l1]['userId']),TRUE); 
											foreach ($lvl2 as $l2 => $vl2): ?>
												<li>
													<span class="tf-nc">  
														<img src="userAdd.png" width="50">
														<!-- <p class="NetworkAddNewLevel">LEVEL 2</p> -->
														<p class="NetworkLabelId"><?= $lvl2[$l2]['userId'] ?></p>
														<p class="NetworkLabelName"><?= $lvl2[$l2]['nama'] ?></p>
													</span>
												</li>
											<?php endforeach ?>
											<li>
													<span class="tf-nc">  
														<img src="userAdd.png" width="50">
														<p class="NetworkAddNewLevel">Add User</p>
													</span>
												</li>
										<?php else: ?>
											<li>
													<span class="tf-nc">  
														<img src="userAdd.png" width="50">
														<p class="NetworkAddNewLevel">Add User</p>
													</span>
												</li>
										<?php endif ?>
									</ul>
								</li>
							<?php endforeach ?>
								<li><!-- level 1 -->
										<span class="tf-nc">
											<img src="userAdd.png" width="50">
											<p class="NetworkAddNewLevel">LEVEL 1</p>
										</span>
								</li>
						<?php else: ?>
							<li><!-- level 1 -->
										<span class="tf-nc">
											<img src="userAdd.png" width="50">
											<p class="NetworkAddNewLevel">LEVEL 1</p>
										</span>
								</li>
						<?php endif ?>
							<!-- == END LEVEL 1 == -->


					</ul>
				</li>
			<?php endforeach ?>
		</ul>
</div>

</body>
</html>