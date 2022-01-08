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
<body class="recipePage">
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
					<li><a href="landing" title="Home"><span>Home</span></a></li>
					<li><a href="Recipes" title="Recipes"><span>Recipes</span></a>
					</li>
					<li><a href="Messaging" title="Messaging"><span>Messaging</span></a>
					
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
					<li><a href="landing" title="Home">Home</a></li>
					<li><a href="Recipes" title="Recipes">Recipes</a></li>
					<li><?php echo $currentRecipe[0]['recipeTitle']; ?></li>
				</ul>
			</nav>
			<!--//breadcrumbs-->
			
			<!--row-->
			<div class="row">
			
				<header class="s-title">
					<h1><?php echo $currentRecipe[0]['recipeTitle']; ?></h1>
				</header>
				
				<!--content-->
				<section class="content two-fourth">
					<?php if ($_SESSION['userid'] == $currentRecipe[0]['userIndex']): ?>
						<a href="Editrecipe?r=<?php echo $currentRecipe[0]['recipeIndex']; ?>" class="button">Edit this recipe</a>
						<a href="Removerecipe?r=<?php echo $currentRecipe[0]['recipeIndex']; ?>" id="remrecipe" data-ask="Are you sure you remove this recipe?" class="button">Remove this recipe</a>
					<?php endif ?>
					<!--recipe-->
						<div class="recipe">
							<div class="row">
								<!--two-third-->
								<article class="two-third">
									<div class="image"><a href="#"><img  style="max-width: 100%; max-height: 100%; width: 100%;" src="<?php echo site_url("static/images") . "/" . $currentRecipe[0]['recipeImg']; ?>" alt="" /></a></div>
									<div class="intro"><p><?php echo explode("|||", $currentRecipe[0]['recipeDesc'])[3]; ?></p></div>
									<h3>Instructions:</h3>
									<div class="instructions">
										<div style="background: #fff;color: #666;font-size:14px;padding:15px 20px 18px;min-height:50px;-webkit-box-shadow:0 0 1px rgba(0,0,0,.2);-moz-box-shadow:0 0 1px rgba(0,0,0,.2);box-shadow:0 0 1px rgba(0,0,0,.2);">
											<?php echo $currentRecipe[0]['recipeInstructions']; ?>
										</div>
												
										
									</div>
								</article>
								<!--//two-third-->
								
								<!--one-third-->
								<article class="one-third">
									<dl class="basic">
										<dt>Preparation time</dt>
										<dd><?php echo explode("|||", $currentRecipe[0]['recipeDesc'])[0]; ?></dd>
										<dt>Cooking time</dt>
										<dd><?php echo explode("|||", $currentRecipe[0]['recipeDesc'])[1]; ?></dd>
										<dt>Serves</dt>
										<dd><?php echo explode("|||", $currentRecipe[0]['recipeDesc'])[2]; ?></dd>
									</dl>
									
									<dl class="user">
										<dt>Category</dt>
										<dd><?php echo $currentRecipe[0]['cat']; ?></dd>
										<dt>Posted by</dt>
										<dd style="height: 100px;"><?php echo $currentRecipe[0]['recipeauthor']; ?></dd>
									</dl>
									
									<h3>Ingredients:</h3>
									<dl class="ingredients">
									<?php foreach ($currentRecipeIngredients as $ing): ?>
										<dt><?php echo $ing['ingQuantity']; ?></dt>
										<dd><?php echo $ing['ingName']; ?></dd>
									<?php endforeach ?>
									</dl>
								</article>
								<!--//one-third-->
							</div>
						</div>
						<!--//recipe-->
						<?php
						//thank you,  Vicky Salunkhe
							//return current date time
							function getCurrentDateTime(){
								date_default_timezone_set("Asia/Manila");
								return date("Y-m-d H:i:s");
							}
							function getDateString($date){
								$dateArray = date_parse_from_format('Y/m/d', $date);
								$monthName = DateTime::createFromFormat('!m', $dateArray['month'])->format('F');
								return $dateArray['day'] . " " . $monthName  . " " . $dateArray['year'];
							}

							function getDateTimeDifferenceString($datetime){
								$currentDateTime = new DateTime(getCurrentDateTime());
								$passedDateTime = new DateTime($datetime);
								$interval = $currentDateTime->diff($passedDateTime);
								//$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
								$day = $interval->format('%a');
								$hour = $interval->format('%h');
								$min = $interval->format('%i');
								$seconds = $interval->format('%s');

								if($day > 7)
									return getDateString($datetime);
								else if($day >= 1 && $day <= 7 ){
									if($day == 1) return $day . " day ago";
									return $day . " days ago";
								}else if($hour >= 1 && $hour <= 24){
									if($hour == 1) return $hour . " hour ago";
									return $hour . " hours ago";
								}else if($min >= 1 && $min <= 60){
									if($min == 1) return $min . " minute ago";
									return $min . " minutes ago";
								}else if($seconds >= 1 && $seconds <= 60){
									if($seconds == 1) return $seconds . " second ago";
									return $seconds . " seconds ago";
								}
							}
						?>
						<!--comments-->
						<div class="comments" id="comments">
							<?php if (!isset($currentComments['code'])): ?>
								<h2 id="commentcount">Comments section</h2>
							<?php else: ?>
								<h2 id="commentcount">No comments yet.</h2>
							<?php endif ?>
							<ol class="comment-list">
							
							</ol>
						</div>
						<!--//comments-->
						
						<!--respond-->
						<div class="comment-respond" id="respond">
							<h2>Leave a comment</h2>
							<div class="container">
									<p><b>Enter your comment (5 to 500 characters only):</b></p>
									<div class="f-row">
										<textarea id="maincommentfield"></textarea>
									</div>
									
									<div class="f-row">
										<div class="third bwrap">
											<img id="loadingcomment" src="images/gil.gif" style="float: right; height: 50px;display: none;">
											<button id="submitcomment" style="float:right">Submit comment</button>
										</div>
									</div>
							</div>
						</div>
						<!--//respond-->
				</section>
				<!--//content-->
				
				<!--right sidebar-->
				<aside class="sidebar one-fourth">

					<!-- <div class="widget share">
						<ul class="boxed">
							<li class="light"><a href="#" title="Facebook"><i class="fa fa-facebook"></i> <span>Share on Facebook</span></a></li>
							<li class="medium"><a href="#" title="Twitter"><i class="fa fa-twitter"></i> <span>Share on Twitter</span></a></li>
							<li class="dark"><a href="#" title="Favourites"><i class="fa fa-heart"></i> <span>Add to Favourites</span></a></li>
						</ul>
					</div> -->

				</aside>
				<!--//right sidebar-->
			</div>
			<!--//row-->
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
							<li><a href="Login" title="Login">Login</a></li>	<li><a href="Register" title="Register">Register</a></li>													
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</footer>
	<!--//footer-->
	
	<script src="js/jquery-3.1.0.min.js"></script>
	<script src="js/jquery.uniform.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/scripts.js"></script>
		
	<script>
		var mRecIndex = "<?php echo $currentRecipe[0]['recipeIndex']; ?>";

		function refreshCommentList() {
					$.ajax({
						type: "POST",
						url: "<?php echo site_url('Getcommentslist'); ?>",
						data:'ind=' + mRecIndex,
						beforeSend: function(){ 
							$('.comment-list').empty()
						},
						success: function(data){
							$('.comment-list').html(data);
						}
					});
		}
		function toggleUpvote(x) {
					$.ajax({
						type: "POST",
						url: "<?php echo site_url('Toggupv'); ?>",
						data:'ind=' + x,
						beforeSend: function(){
							$("#loadingupv_" + x).show();
						},
						success: function(data){
							var dta = JSON.parse(data);
							var upvoteCount = parseInt(dta.upvc);
							$("#commspan_" + x).html(upvoteCount);
							$("#loadingupv_" + x).hide();
							var ssstat = dta.sstat;
							if (ssstat == "disliked") {
								$("#likedimg_" + x).attr('src','<?php echo site_url('/images/like.png'); ?>');
							} else {
								$("#likedimg_" + x).attr('src','<?php echo site_url('/images/likeselected.png'); ?>');
							}
						}
					});
		}
		$(document).ready(function(){
			refreshCommentList();
			$("#submitcomment").click(function(){
				var comm = $("#maincommentfield").val();
				if (comm.length > 3) {
					$.ajax({
						type: "POST",
						url: "<?php echo site_url('Submitcomm'); ?>",
						data:'comm=' + comm + '&ind=' + mRecIndex,
						beforeSend: function(){
							$("#loadingcomment").show();
						},
						success: function(data){
							$("#loadingcomment").hide();
							$("#maincommentfield").val("");
							refreshCommentList();
							
						}
					});
				} else {
					alert('Enter a proper comment!');
				}
				
			});
			$(document).on('click', ':not(form)[data-ask]', function(e){
				if(!confirm($(this).data('ask'))){
					e.stopImmediatePropagation();
					e.preventDefault();
				}
			});
			
		});
	</script>
</body>
</html>


