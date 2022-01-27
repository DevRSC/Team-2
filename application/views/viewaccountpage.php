<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="SocialChef - Social Recipe HTML Template" />
	<meta name="description" content="SocialChef - Social Recipe HTML Template">
	<meta name="author" content="themeenergy.com">
	
	<title>Meals for Makers</title>
	
	<link rel="stylesheet" href="css/style.css" />
	
	<link rel="stylesheet" href="css/icons.css" />
	<link href="http://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,800" rel="stylesheet">
	<script src="https://use.fontawesome.com/e808bf9397.js"></script>
	<link rel="shortcut icon" href="images/favicon.ico" />
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	

</head>
<body>
	<!--preloader-->
	<div class="preloader">
		<div class="spinner"></div>
	</div>
	<!--//preloader-->
	
	<!--header-->
	<header class="head" role="banner">
		<!--wrap-->
		<div class="wrap clearfix">
			<a href="Landing" title="Meals for Makers" class="logo"><img src="images/ico/logo2.png" alt="Meals for Makers logo" /></a>
			
			<nav class="main-nav" role="navigation" id="menu">
				<ul>
					<li><a href="Landing" title="Home"><span>Home</span></a></li>
					<li><a href="Recipes" title="Recipes"><span>Recipes</span></a>
					</li>
					<li><a title="Messaging" class="modal-toggle"><span>Messaging</span></a>
					
					<?php if (isset($_SESSION['user'])): ?>
						<li><a href="Logout" title="Messaging"><span>Welcome, <?php echo $_SESSION['userfirstname']; ?>!<br>Click here to Logout.</span></a>
					<?php else: ?>
						<li><a href="Login" title="Messaging"><span>Login</span></a>
					<?php endif ?>

				</ul>
			</nav>
			
			<nav class="user-nav" role="navigation">
				<ul>
					<li class="light"><a href="Searchrecipes" title="Search for recipes"><i class="icon icon-themeenergy_search"></i> <span>Search for recipes</span></a></li>
					<?php if (isset($_SESSION['user'])): ?>
						<li class="medium"><a href="Myaccount" title="My account"><i class="icon icon-themeenergy_chef-hat"></i> <span>My account</span></a></li>
						<li class="dark"><a href="Postrecipe" title="Post a recipe"><i class="icon icon-themeenergy_fork-spoon"></i> <span>Post a recipe</span></a></li>
					<?php endif ?>
					
				</ul>
			</nav>
		</div>
	</header>
	<!--//header-->
		
	<!--main-->
	<main class="main" role="main">
		<!--wrap-->
		<div class="wrap clearfix">
			<!--breadcrumbs-->
			<nav class="breadcrumbs">
				<ul>
					<li><a href="Landing" title="Home">Home</a></li>
					<li><?php echo $userProfile[0]['lastname'] . ", " . $userProfile[0]['firstname'] ?>'s Account</li>
				</ul>
			</nav>
			<!--//breadcrumbs-->
			
		
			<!--content-->
			<section class="content">
				<!--row-->
				<div class="row">
					<!--profile left part-->
					<div class="my_account one-fourth">
						<figure>
							<img src="<?php echo $userProfile[0]['profilePic'] == "weh" || $userProfile[0]['profilePic'] == "null" || strlen($userProfile[0]['profilePic']) <= 0 ? "images/avatar.jpg" : "/static/images/" . $userProfile[0]['profilePic'] ?>" alt="" />
						</figure>
						<div class="container">
							<h2><?php echo $userProfile[0]['firstname'] . " " . $userProfile[0]['lastname'] ?></h2>
							
						</div>
					</div>
					<!--//profile left part-->
					
					<div class="three-fourth">
						<nav class="tabs">
							<ul>
								<li class="active"><a href="#about" title="About me">About me</a></li>
								<li><a href="#recipes" title="My recipes">Account's recipes</a></li>
							</ul>
						</nav>
						
						<!--about-->
						<div class="tab-content" id="about">
							<div class="row">
								<dl class="basic full-width">
									<dt>Name</dt>
									<dd><?php echo $userProfile[0]['firstname'] . " " . $userProfile[0]['lastname'] ?>
									
									</dd>
									
									<dt>Birthdate</dt>
									<dd><?php echo $userProfile[0]['birthdate']?></dd>
									<dt>Age</dt>
									<?php 
										$tz  = new DateTimeZone('Asia/Manila');
										$age = DateTime::createFromFormat('Y-m-d', $userProfile[0]['birthdate'], $tz)
											->diff(new DateTime('now', $tz))
											->y;
									?>
									<dd><?php echo $age ?></dd>
									<dt>Number of Recipes posted</dt>
									<dd><?php echo $userProfile[0]['recipecount']?></dd>
									<dt>Number of Comments posted</dt>
									<dd><?php echo $userProfile[0]['commcount']?></dd>
									<dt>Most frequently used ingredient</dt>
									<dd><?php echo $userProfile[0]['freqing']?></dd>
								</dl>
							
							</div>
						</div>
						<!--//about-->
					
						<!--my recipes-->
						<div class="tab-content" id="recipes">
							<div class="entries row">
							<?php if (!isset($userrecipes['code'])): ?>
								<?php foreach($userrecipes as $rec): ?>
									<!--item-->
									<div class="entry one-third">
										<figure>
											<img src="<?php echo site_url("static/images") . "/" . $rec['recipeImg']; ?>" alt="" />
											<figcaption><a href="Recipeview?r=<?php echo urlencode($rec['recipeTitle']); ?>"><i class="icon icon-themeenergy_eye2"></i> <span>View recipe</span></a></figcaption>
										</figure>
										<div class="container">
											<h2><a href="Recipeview?r=<?php echo urlencode($rec['recipeTitle']); ?>"><?php echo $rec['recipeTitle']; ?></a></h2> 
											<i><?php echo $rec['cat']; ?></i>
											<div class="actions">
												<div>
													<div class="difficulty"><b><?php echo $rec['recipeauthor']; ?></b></div>
													<div class="difficulty"><?php echo date(DATE_RFC822, strtotime($rec['modifyDate'])); ?></div>
													<div class="likes"><i></i><a href="#"></a></div>
													<div class="comments"><i class="fa fa-comment"></i><a href="recipe.html#comments"><?php echo $rec['commcount']; ?></a></div>
												</div>
											</div>
										</div>
									</div>
									<!--item-->
								<?php endforeach ?>

								<div class="quicklinks">
									<!-- <a href="#" class="button">More recipes</a> -->
									<a href="javascript:void(0)" class="button scroll-to-top">Back to top</a>
								</div>
							<?php else: ?>
								<h1>No recipes was posted by this user yet</h1>
							<?php endif ?>
							</div>
						</div>
						<!--//my recipes-->
						
						
						<!--my favorites-->
						<div class="tab-content" id="favorites">
							<div class="entries row">
								<!--item-->
								<div class="entry one-third">
									<figure>
										<img src="images/img.jpg" alt="" />
										<figcaption><a href="recipe.html"><i class="icon icon-themeenergy_eye2"></i> <span>View recipe</span></a></figcaption>
									</figure>
									<div class="container">
										<h2><a href="recipe.html">Thai fried rice with fruit and vegetables</a></h2> 
										<div class="actions">
											<div>
												<div class="difficulty"><i class="ico i-medium"></i><a href="#">medium</a></div>
												<div class="likes"><i class="fa fa-heart"></i><a href="#">10</a></div>
												<div class="comments"><i class="fa fa-comment"></i><a href="recipe.html#comments">27</a></div>
											</div>
										</div>
									</div>
								</div>
								<!--item-->
								
								<!--item-->
								<div class="entry one-third">
									<figure>
										<img src="images/img.jpg" alt="" />
										<figcaption><a href="recipe.html"><i class="icon icon-themeenergy_eye2"></i> <span>View recipe</span></a></figcaption>
									</figure>
									<div class="container">
										<h2><a href="recipe.html">Spicy Morroccan prawns with cherry tomatoes</a></h2> 
										<div class="actions">
											<div>
												<div class="difficulty"><i class="ico i-hard"></i><a href="#">hard</a></div>
												<div class="likes"><i class="fa fa-heart"></i><a href="#">10</a></div>
												<div class="comments"><i class="fa fa-comment"></i><a href="recipe.html#comments">27</a></div>
											</div>
										</div>
									</div>
								</div>
								<!--item-->
								
								<!--item-->
								<div class="entry one-third">
									<figure>
										<img src="images/img.jpg" alt="" />
										<figcaption><a href="recipe.html"><i class="icon icon-themeenergy_eye2"></i> <span>View recipe</span></a></figcaption>
									</figure>
									<div class="container">
										<h2><a href="recipe.html">Super easy blueberry cheesecake</a></h2> 
										<div class="actions">
											<div>
												<div class="difficulty"><i class="ico i-easy"></i><a href="#">easy</a></div>
												<div class="likes"><i class="fa fa-heart"></i><a href="#">10</a></div>
												<div class="comments"><i class="fa fa-comment"></i><a href="recipe.html#comments">27</a></div>
											</div>
										</div>
									</div>
								</div>
								<!--item-->
							</div>
						</div>
						<!--//my favorites-->
						
						<!--my posts-->
						<div class="tab-content" id="posts">
							<!--entries-->
							<div class="entries row">
								<!--item-->
								<div class="entry one-third">
									<figure>
										<img src="images/img.jpg" alt="" />
										<figcaption><a href="blog_single.html"><i class="icon icon-themeenergy_eye2"></i> <span>View post</span></a></figcaption>
									</figure>
									<div class="container">
										<h2><a href="blog_single.html">Barbeque party</a></h2> 
										<div class="actions">
											<div>
												<div class="date"><i class="fa fa-calendar"></i><a href="#">22 Dec 2014</a></div>
												<div class="comments"><i class="fa fa-comment"></i><a href="blog_single.html#comments">27</a></div>
											</div>
										</div>
										<div class="excerpt">
											<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod. Lorem ipsum dolor sit amet . . . </p>
										</div>
									</div>
								</div>
								<!--item-->
								
								<!--item-->
								<div class="entry one-third">
									<figure>
										<img src="images/img.jpg" alt="" />
										<figcaption><a href="blog_single.html"><i class="icon icon-themeenergy_eye2"></i> <span>View post</span></a></figcaption>
									</figure>
									<div class="container">
										<h2><a href="blog_single.html">How to make sushi</a></h2> 
										<div class="actions">
											<div>
												<div class="date"><i class="fa fa-calendar"></i><a href="#">22 Dec 2014</a></div>
												<div class="comments"><i class="fa fa-comment"></i><a href="blog_single.html#comments">27</a></div>
											</div>
										</div>
										<div class="excerpt">
											<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod. Lorem ipsum dolor sit amet . . . </p>
										</div>
									</div>
								</div>
								<!--item-->
								
								<!--item-->
								<div class="entry one-third">
									<figure>
										<img src="images/img.jpg" alt="" />
										<figcaption><a href="blog_single.html"><i class="icon icon-themeenergy_eye2"></i> <span>View post</span></a></figcaption>
									</figure>
									<div class="container">
										<h2><a href="blog_single.html">Make your own bread</a></h2> 
										<div class="actions">
											<div>
												<div class="date"><i class="fa fa-calendar"></i><a href="#">22 Dec 2014</a></div>
												<div class="comments"><i class="fa fa-comment"></i><a href="blog_single.html#comments">27</a></div>
											</div>
										</div>
										<div class="excerpt">
											<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod. Lorem ipsum dolor sit amet . . . </p>
										</div>
									</div>
								</div>
								<!--item-->
							</div>
							<!--//entries-->
						</div>
						<!--//my posts-->
					</div>
				</div>
				<!--//row-->
				
				<div class="row">
					<div class="comment-respond" id="respond"style="margin-top: -50px;">
							<h2>Message this user:</h2>
							<div class="container">
									<p><b id="displaycommentlabel">Enter your message (500 characters left):</b></p>
									<div class="f-row">
										<textarea id="maincommentfield"></textarea>
									</div>
									
									<div class="f-row">
										<div class="third bwrap">
											<img id="loadingcomment" src="images/gil.gif" style="float: right; height: 50px;display: none;">
											<button id="submitcomment" style="float:right">Send message</button>
										</div>
									</div>
							</div>
						</div>
				</div>
			</section>
			<!--//content-->
		</div>
		<!--//wrap-->
	</main>
	<!--//main-->
	
	
	<!--footer-->
	<footer class="foot" role="contentinfo">
		<div class="wrap clearfix">
			<div class="row">
				<article class="one-half">
					<h5>About Meals for Makers</h5>
					A food blogging community that makes cooking fun and simple - a perfect dish every time! Our community offers curated fail-proof recipes that deliver authentic flavors using modern and innovative techniques. </p>
				</article>
				<article class="one-fourth">
					<h5>Need help?</h5>
					<p>Contact us via email</p>
					<p><em>E:</em>  <a href="#">mealsformakers@gmail.com</a></p>
				</article>
				<article class="one-fourth">
					<h5>Follow us</h5>
					<ul class="social">
						<li><a href="#" title="facebook"><i class="fa fa-fw fa-facebook"></i></a></li>
						<li><a href="#" title="instagram"><i class="fa fa-fw fa-instagram"></i></a></li>
						<li><a href="#" title="youtube"><i class="fa  fa-fw fa-youtube"></i></a></li>
						<li><a href="#" title="linkedin"><i class="fa fa-fw fa-linkedin"></i></a></li>
						<li><a href="#" title="twitter"><i class="fa fa-fw fa-twitter"></i></a></li>
						<li><a href="#" title="pinterest"><i class="fa fa-fw fa-pinterest-p"></i></a></li>
					</ul>
				</article>
				
				<div class="bottom">
					<p class="copy">Copyright 2021 Meals for Makers. All rights reserved. Use of this system constitutes acceptance of our <a href="Privacypolicy" title="PrivacyPolicy">Privacy Policy.</a></p>
					
					<nav class="foot-nav">
						<ul>
							<li><a href="Landing" title="Home">Home</a></li>
							<li><a href="Recipes" title="Recipes">Recipes</a></li>
							<li><a href="Messaging" title="Messaging" target="_blank">Messaging</a></li>  
							<li><a href="Searchrecipes" title="Search for recipes">Search for recipes</a></li>
																			
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</footer>
	<!--//footer-->
<link rel="stylesheet" href="css/modalstyle.css" />
	<div class="modal">
    <div class="modal-overlay modal-toggle"></div>
    <div class="modal-wrapper modal-transition">
      <div class="modal-header">
        <button class="modal-close modal-toggle"><i class="fa fa-times fa-lg"></i></button>
        <h2 class="modal-heading">Messaging</h2>
      </div>
      
      <div class="modal-body">
        <div class="modal-content">
          <iframe src="Messaging" id="msgiframe" title="Messaging" style="width: 100%;height: 600px;"></iframe>
          <!--<button class="modal-toggle">Update</button>-->
        </div>
      </div>
    </div>
  </div>
  <script src="js/jquery-3.1.0.min.js"></script>
  <script>
  $('.modal-toggle').on('click', function(e) {
	  e.preventDefault();
	  $('.modal').toggleClass('is-visible');
	  document.getElementById("msgiframe").contentDocument.location.reload(true);
	});
	</script>
	
	<script src="js/jquery.uniform.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/scripts.js"></script>
	
	<script>
	
	var mRecIndex = "<?php echo $_GET['a']; ?>";
	$(document).ready(function(){
		$('body').on('keyup paste', 'textarea', function () {
				var maxchars = 500;
				$(this).val($(this).val().substring(0, maxchars));
				var tlength = $(this).val().length;
				remain = maxchars - parseInt(tlength);
				$('#displaycommentlabel').html("Enter your message (" + remain + " characters left):");
			});
			$("#submitcomment").click(function(){
				var comm = $("#maincommentfield").val();
				if (comm.length > 0 && comm.length <= 500) {
					$.ajax({
						type: "POST",
						url: "<?php echo site_url('Sendmsg'); ?>",
						data:'comm=' + comm + '&ind=' + mRecIndex,
						beforeSend: function(){
							$("#loadingcomment").show();
						},
						success: function(data){
							$("#loadingcomment").hide();
							$("#maincommentfield").val("");
							$('.modal').toggleClass('is-visible');
							document.getElementById("msgiframe").contentDocument.location.reload(true);
							
							
						}
					});
				} else {
					alert('Enter a proper comment!');
				}
				
			});
			
		});
	</script>
	
</body>
</html>


