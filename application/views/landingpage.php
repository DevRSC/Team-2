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
<body class="home">
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
					<li class="current-menu-item"><a href="Landing" title="Home"><span>Home</span></a></li>
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
		<!--//wrap-->
	</header>
	<!--//header-->
		
	<!--main-->
	<main class="main" role="main">
		<!--intro-->
		<?php if (empty($_SESSION['userid'])): ?>
		<div class="intro">
			<figure class="bg"><img src="images/intro.jpg" alt="" /></figure>
			
			<!--wrap-->
			<div class="wrap clearfix">
				<!--row-->
				<div class="row">
					<article class="three-fourth text">
						<h1>Welcome to Meals for Makers!</h1>
						<p>Meals for Makers is the ultimate <strong>cooking social community</strong>, where recipes come to life. Wanna know what you will gain by joining us?</p>
						<p>You will learn various recipes, make new friends and share delicious recipes. </p>
						<a href="register" class="button white more medium">Join our community <i class="fa fa-chevron-right"></i></a>
						<p>Already a member? Click <a href="Login">here</a> to login.</p>
					</article>
					
					<!--search recipes widget-->
					<div class="one-fourth">
						<div class="widget container">
							<div class="textwrap">
								<h3>Recipes based on your ingredients</h3>
								<p>No one has all the ingredients around the world!</p>
								<p>With <b>Meals for Makers</b>, you can search recipes that are tailored to what you have on hand!</p>
								<p>There’s sure to be something tempting for you to try.</p> 
								<p>Enjoy!</p>
							</div>
							<div class="f-row bwrap">
								<a class="button big" href="Searchrecipes">Search for recipes now!</a>
							</div>
						</div>
					</div>
					<!--//search recipes widget-->
				</div>
				<!--//row-->
			</div>
			<!--//wrap-->
		</div>
		<?php endif ?>
		<!--//intro-->
		
		<!--wrap-->
		<div class="wrap clearfix">
			<!--row-->
			<div class="row">
				<!--content-->
				<section class="content full-width">
					<div class="icons dynamic-numbers">
						<header class="s-title">
							<h2 class="ribbon large">Meals for Makers in numbers</h2>
						</header>
						
						<!--row-->
						<div class="row">
							<!--item-->
							<div class="one-fourth">
								<div class="container">
									<i class="icon icon-themeenergy_chef-hat"></i>
									<span class="title dynamic-number" data-dnumber="<?php echo $dashdata[0]['usercount'] ?>">0</span>
									<span class="subtitle">members</span>
								</div>
							</div>
							<!--//item-->
							
							<!--item-->
							<div class="one-fourth">
								<div class="container">
									<i class="icon icon-themeenergy_pan"></i>
									<span class="title dynamic-number" data-dnumber="<?php echo $dashdata[0]['recipecount'] ?>">0</span>
									<span class="subtitle">recipes</span>
								</div>
							</div>
							<!--//item-->
							
							<!--item-->
							<div class="one-fourth">
								<div class="container">
									<i class="icon icon-themeenergy_apple2"></i>
									<span class="title dynamic-number" data-dnumber="<?php echo $dashdata[0]['ingcount'] ?>">0</span>
									<span class="subtitle">ingredients</span>
								</div>
							</div>
							<!--//item-->
							
							
							<!--item-->
							<div class="one-fourth">
								<div class="container">
									<i class="icon icon-themeenergy_chat-bubbles"></i>
									<span class="title dynamic-number" data-dnumber="<?php echo $dashdata[0]['commcount'] ?>">0</span>
									<span class="subtitle">comments</span>
								</div>
							</div>
							<!--//item-->
						
							<?php if (empty($_SESSION['userid'])): ?>
								<div class="cta">
									<a href="register" class="button big">Join us!</a>
								</div>
							<?php endif ?>
						</div>
						<!--//row-->
					</div>
				</section>
				<!--//content-->
			
				<!--content-->
				<section class="content three-fourth">
					<!--cwrap-->
					<div class="cwrap">
						<!--entries-->
						<div class="entries row">
							<!--featured recipe-->
							<div class="featured two-third">
								<header class="s-title">
									<h2 class="ribbon">Recipe of the Day</h2>
								</header>
								<article class="entry">
									<figure>
										<img src="<?php echo site_url("static/images") . "/" . $randrecipe[0]['recipeImg']; ?>" alt="" />
										<figcaption><a href="Recipeview?r=<?php echo urlencode($randrecipe[0]['recipeTitle']); ?>"><i class="icon icon-themeenergy_eye2"></i> <span>View recipe</span></a></figcaption>
									</figure>
									<div class="container">
										<h2><a href="Recipeview?r=<?php echo urlencode($randrecipe[0]['recipeTitle']); ?>"><?php echo $randrecipe[0]['recipeTitle']; ?></a></h2>
										<p><?php echo explode("|||", $randrecipe[0]['recipeDesc'])[3] ?></p>
										<div class="actions">
											<div>
												<a href="Recipeview?r=<?php echo urlencode($randrecipe[0]['recipeTitle']); ?>" class="button">See the full recipe</a>
											</div>
										</div>
									</div>
								</article>
							</div>
							<!--//featured recipe-->
							
							<!--featured member-->
							<div class="featured one-third">
								<header class="s-title">
									<h2 class="ribbon">Latest member</h2>
								</header>
								<article class="entry">
									<figure>
										<img src="images/avatar.jpg" alt="" />
										<figcaption><a href="Accountview?a=<?php echo $latestmember[0]['userIndex'] ?>"><i class="icon icon-themeenergy_eye2"></i> <span>View member</span></a></figcaption>
									</figure>
									<div class="container">
										<h2><a href="Accountview?a=<?php echo $latestmember[0]['userIndex'] ?>"><?php echo $latestmember[0]['firstname'] . " " . $latestmember[0]['lastname'] ?></a></h2>
										<blockquote><i class="fa fa-quote-left"></i>
										<?php echo $latestmember[0]['firstname'] ?> is a prolific member back in <?php echo date_format(date_create($latestmember[0]['dte']), "F, Y") ?>, and has posted
										<?php echo $latestmember[0]['recipecount'] ?> recipe(s) ever since. This member also had commented <?php echo $latestmember[0]['commcount'] ?> time(s), and this 
										member's most used ingredient amongst all of this user's recipe is <?php echo $latestmember[0]['freqing'] ?>.
										</blockquote>
										<div class="actions">
											<div>
												<a href="Accountview?a=<?php echo $latestmember[0]['userIndex'] ?>" class="button">Check out this user's recipes</a>
											</div>
										</div>
									</div>
								</article>
							</div>
							<!--//featured member-->
						</div>
						<!--//entries-->
					</div>
					<!--//cwrap-->
				
					<!--cwrap-->
					<div class="cwrap">
						<header class="s-title">
							<h2 class="ribbon bright">Latest recipes</h2>
						</header>
						
						<!--entries-->
						<div class="entries row">
						<?php foreach($sixrecipes as $rec): ?>
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
								<a href="Recipes" class="button">More recipes</a>
								<a href="javascript:void(0)" class="button scroll-to-top">Back to top</a>
							</div>
						</div>
						<!--//entries-->
					</div>
					<!--//cwrap-->
				

				</section>
				<!--//content-->
		
			
				<!--right sidebar-->
				<aside class="sidebar one-fourth">
					<div class="widget">
						<h3>Recipe Categories</h3>
						<ul class="boxed">
							<?php foreach ($cats as $cat): ?>
								<li class="light" style="height: 100px;"><a href="recipes?cat=<?php echo urlencode($cat['catname']) ?>" title="<?php echo $cat['catname'] ?>"><i class="icon <?php echo $cat['iconthemeenergy'] ?>"></i> <span><?php echo $cat['catname'] ?></span></a></li>
							<?php endforeach ?>
							
						</ul>
					</div>

					<div class="widget">
						<h3>Advertisment</h3>
						<a href="#"><img src="images/advertisment.jpg" alt="" /></a>
					</div>
				</aside>
			</div>
			<!--//right sidebar-->
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
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci.</p>
				</article>
				<article class="one-fourth">
					<h5>Need help?</h5>
					<p>Contact us via phone or email</p>
					<p><em>T:</em>  +1 555 555 555<br /><em>E:</em>  <a href="#">mealsformakers@gmail.com</a></p>
				</article>
				<article class="one-fourth">
					<h5>Follow us</h5>
					<ul class="social">
						<li><a href="#" title="facebook"><i class="fa fa-fw fa-facebook"></i></a></li>
						<li><a href="#" title="youtube"><i class="fa  fa-fw fa-youtube"></i></a></li>
						<li><a href="#" title="rss"><i class="fa  fa-fw fa-rss"></i></a></li>
						<li><a href="#" title="gplus"><i class="fa fa-fw fa-google-plus"></i></a></li>
						<li><a href="#" title="linkedin"><i class="fa fa-fw fa-linkedin"></i></a></li>
						<li><a href="#" title="twitter"><i class="fa fa-fw fa-twitter"></i></a></li>
						<li><a href="#" title="pinterest"><i class="fa fa-fw fa-pinterest-p"></i></a></li>
						<li><a href="#" title="vimeo"><i class="fa fa-fw fa-vimeo"></i></a></li>
					</ul>
				</article>
				
				<div class="bottom">
					<p class="copy">Copyright 2021 Meals for Makers. All rights reserved.</p>
					
					<nav class="foot-nav">
						<ul>
							<li><a href="Landing" title="Home">Home</a></li>
							<li><a href="recipes.html" title="Recipes">Recipes</a></li>
							<li><a href="Messaging.html" title="Messaging" target="_blank">Messaging</a></li>
							<li><a href="contact.html" title="Contact">Contact</a></li>    
							<li><a href="find_recipe.html" title="Search for recipes">Search for recipes</a></li>
							<li><a href="login.html" title="Login">Login</a></li>	<li><a href="register.html" title="Register">Register</a></li>													
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
	<script src="js/home.js"></script>	
</body>
</html>


