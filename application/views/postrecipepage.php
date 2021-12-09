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
	<style>
		.holder {margin: 2px 0px;}
		.ing-list{float:left;list-style:none;margin-top:-3px;padding:0;width:190px;position: absolute;left: 0%; top: 60px; z-index: 6969}
		.ing-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
		.ing-list li:hover{background:#ece3d2;cursor: pointer;}
		.inginput{padding: 10px;}
	</style>

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
					<li><a href="Landing" title="Home">Home</a></li>
					<li>Submit a recipe</li>
				</ul>
			</nav>
			<!--//breadcrumbs-->
			<?php $isEditMode = false; ?>
			<!--row-->
			<div class="row">
				<header class="s-title">
					<?php if (isset($currentRecipe)): ?>
						<h1>Edit your recipe : <?php echo $currentRecipe[0]['recipeTitle'] ?></h1>
						<?php $isEditMode = true; ?>
					<?php else: ?>
						<h1>Post a recipe</h1>
						<?php $isEditMode = false; //trust issues? hahaha ?>
					<?php endif ?>
				</header>
				
				<?php
					function genr($length = 7) {
						$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
						$rand = '';
						for ($i = 0; $i < $length; $i++) {
							$rand .= $characters[rand(0, (strlen($characters)) - 1)];
						}
						return $rand;
					}
				?>
				<!--content-->
				<section class="content full-width">
					<div class="submit_recipe container">
						<form method="post" action="Uploadrecipe" enctype="multipart/form-data">
							<?php if ($isEditMode == true): ?>
								<input type="hidden" name="previndex" value="<?php echo $currentRecipe[0]['recipeIndex']?>" />
								<input type="hidden" name="previmg" value="<?php echo $currentRecipe[0]['recipeImg']?>" />
							<?php endif ?>
							<section>
								<h2>Basics</h2>
								<p>All fields are required.</p>
								<div class="f-row">
									<div class="full">Recipe Title: <input type="text" name="recipetitle" placeholder="Recipe title" value="<?php echo $isEditMode == true ? $currentRecipe[0]['recipeTitle'] : "" ?>" required /></div>
								</div>
								<div class="f-row">
									<div class="third">Prep. Time: <input type="text" name="recipepreptime" placeholder="Preparation time" value="<?php echo $isEditMode == true ? explode("|||", $currentRecipe[0]['recipeDesc'])[0] : "" ?>" required /></div>
									<div class="third">Cooking Time: <input type="text" name="recipecooktime" placeholder="Cooking time" value="<?php echo $isEditMode == true ? explode("|||", $currentRecipe[0]['recipeDesc'])[1] : "" ?>" required /></div>
								</div>
								<div class="f-row">
									<div class="third">Serves how many?<input type="text" name="recipeserveshowmany" placeholder="Serves how many people?" value="<?php echo $isEditMode == true ? explode("|||", $currentRecipe[0]['recipeDesc'])[2] : "" ?>" /></div>
									<div class="third">Category:
										<select name="recipecategory">
											
											<option <?php echo $isEditMode == true ? '' : 'selected="selected"' ?>>Select a category</option>
											<?php foreach ($categories as $cat): ?>
												<option <?php echo $isEditMode == false && $currentRecipe[0]['cat'] == $cat['catname'] ? '' : 'selected="selected"' ?> value="<?php echo urlencode($cat['catname']) ?>"><?php echo $cat['catname'] ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</section>
							
							<section>
								<h2>Description</h2>
								<div class="f-row">
									<div class="full"><textarea placeholder="Recipe description" name="recipedesc" ><?php echo $isEditMode == true ? explode("|||", $currentRecipe[0]['recipeDesc'])[3] : "" ?></textarea></div>
								</div>
							</section>	
							
							<section>
								<h2>Ingredients</h2>
								<div id="inglistmain">
									<?php if ($isEditMode == true): ?>
										<?php $ccc = 0; ?>
										<?php foreach ($currentRecipeIngredients as $ing): ?>
											<div class="f-row ingredient" <?php echo $ccc == 0 ? 'id="firsting"' : '' ?> >
												<?php $xx = genr(); ?>

												<script>
													$(".inginput_<?php echo $xx; ?>").keyup(function(){
														if ($(".inginput_<?php echo $xx; ?>").val().length > 2) {
															$.ajax({
																type: "POST",
																url: searchurlconst,
																data:'i=' + $(".inginput_<?php echo $xx; ?>").val() + '&el=<?php echo $xx; ?>',
																beforeSend: function(){
																	$(".inginput_<?php echo $xx; ?>").css("background","#FFF url(images/gil.gif) no-repeat 255px");
																	$(".inginput_<?php echo $xx; ?>").css("background-size","25px 25px");
																},
																success: function(data){
																	$(".appendedings_<?php echo $xx; ?>").show();
																	$(".appendedings_<?php echo $xx; ?>").html(data);
																	$(".inginput_<?php echo $xx; ?>").css("background","#FFF");
																}
															});
														} else {
															$(".appendedings_<?php echo $xx; ?>").hide();
														}
													}); </script>
												<div class="f-row ingredient" id="ingcontainer_<?php echo $xx; ?>">
													<div class="large holder">Ingredient: <input type="text" name="_ing<?php echo $xx; ?>" class="inginput_<?php echo $xx; ?>" placeholder="Ingredient" value="<?php echo $ing['ingName'] ?>" required /></div>
													<div class="appendedings_<?php echo $xx; ?>"></div>
													<div class="small">Quantity: <input type="text" name="_quan<?php echo $xx; ?>" placeholder="Quantity" value="<?php echo $ing['ingQuantity'] ?>" required /></div>
													<button class="remove" onClick="$('#ingcontainer_<?php echo $xx; ?>').remove()">-</button>
												</div>

											</div>
											<?php $ccc = $ccc + 1; ?>
										<?php endforeach ?>
									<?php else: ?>
										<div class="f-row ingredient" id="firsting">
											<?php $xx = genr(); ?>
											<div class="large holder">Ingredient: <input type="text" name="_ing<?php echo $xx;?>" class="inginput" placeholder="Ingredient" required /></div>
											<div class="appendedings"></div>
											<div class="small">Quantity: <input type="text" name="_quan<?php echo $xx;?>" placeholder="Quantity" required /></div>
											<button class="remove">-</button>
										</div>
									<?php endif ?>
									
									
								</div>
								<div class="f-row full">
									<button class="add">Add an ingredient</button>
								</div>
							</section>	
							
							<section>
								<h2>Instructions</h2>
								<div class="f-row">
									<div class="full"><textarea placeholder="Recipe instructions..." name="recipeinst" id="recipeinst" ><?php echo $currentRecipe[0]['recipeInstructions'] ?></textarea></div>
								</div>
							</section>	

							<section>
								
								
									<?php if ($isEditMode == true): ?>
										<h2>Photo (old image gets retained if you don't upload a new one)</h2>
										<div class="f-row full">
											<input type="file" name="recipeimg" />
										</div>
									<?php else: ?>
										<h2>Photo</h2>
										<div class="f-row full">
											<input type="file" name="recipeimg" required/>
										</div>
									<?php endif ?>
									
								
							</section>	
							
							<section style="display: none;">
								<h2>Status <span>(would you like to further edit this recipe or are you ready to publish it?)</span></h2>
								<div class="f-row full">
									<input type="radio" id="r1" name="radio"/>
									<label for="r1">I am still working on it</label>
								</div>
								<div class="f-row full">
									<input type="radio" id="r2" name="radio"/>
									<label for="r2">I am ready to publish this recipe</label>
								</div>
							</section>
							
							<div class="f-row full">
								<input type="submit" class="button" id="submitRecipe" value="<?php echo $isEditMode == true ? "Update your recipe" : "Post this recipe" ?>" />
							</div>
						</form>
					</div>
				</section>
				<!--//content-->
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
							<li><a href="Messaging.html" title="Messaging">Messaging</a></li>
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
	<script src="js/ckedit/ckeditor.js"></script>
	<script src="js/jquery-3.1.0.min.js"></script>
	<script src="js/jquery.uniform.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/scripts.js"></script>
	<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js" integrity="sha256-xH4q8N0pEzrZMaRmd7gQVcTZiFei+HfRTBPJ1OGXC0k=" crossorigin="anonymous"></script>
	<script>
		var searchurlconst = "<?php echo site_url('Upsimg.php'); ?>";
		class MyUploadAdapter {
			constructor( loader ) {
				// The file loader instance to use during the upload.
				this.loader = loader;
			}

			// Starts the upload process.
			upload() {
				return this.loader.file
					.then( file => new Promise( ( resolve, reject ) => {
						this._initRequest();
						this._initListeners( resolve, reject, file );
						this._sendRequest( file );
					} ) );
			}

			// Aborts the upload process.
			abort() {
				if ( this.xhr ) {
					this.xhr.abort();
				}
			}
			// Initializes the XMLHttpRequest object using the URL passed to the constructor.
			_initRequest() {
				const xhr = this.xhr = new XMLHttpRequest();
				xhr.open( 'POST', searchurlconst, true );
				xhr.responseType = 'json';
			}
			// Initializes XMLHttpRequest listeners.
			_initListeners( resolve, reject, file ) {
				const xhr = this.xhr;
				const loader = this.loader;
				const genericErrorText = `Couldn't upload file: ${ file.name }.`;
				xhr.addEventListener( 'error', () => reject( genericErrorText ) );
				xhr.addEventListener( 'abort', () => reject() );
				xhr.addEventListener( 'load', () => {
					const response = xhr.response;
					if ( !response || response.error ) {
						return reject( response && response.error ? response.error.message : genericErrorText );
					}
					resolve( {
						default: response.url
					} );
				} );
				if ( xhr.upload ) {
					xhr.upload.addEventListener( 'progress', evt => {
						if ( evt.lengthComputable ) {
							loader.uploadTotal = evt.total;
							loader.uploaded = evt.loaded;
						}
					} );
				}
			}
			_sendRequest( file ) {
				const data = new FormData();
				data.append( 'upload', file );
				this.xhr.send( data );
			}
		}

		function MyCustomUploadAdapterPlugin( editor ) {
			editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
				// Configure the URL to the upload script in your back-end here!
				return new MyUploadAdapter( loader );
			};
		}   


			ClassicEditor
    .create( document.querySelector( '#recipeinst' ),{
    extraPlugins: [ MyCustomUploadAdapterPlugin ],
			fontFamily: {
            options: [
				'default',
                'Century Gothic',
                'Arial',
				'Courier New',
				'Georgia',
				'Lucida Sans Unicode',
				'Tahoma',
				'Times New Roman',
				'Trebuchet MS',
				'Verdana',
				'sans-serif'
            ]
        },
	toolbar: {
					items: [
					
						'heading',
						'|',
						'bold',
						'italic',
						'underline',
						'link',
						'alignment',
						'fontFamily',
						'fontSize',
						'bulletedList',
						'numberedList',
						'highlight',
						'fontBackgroundColor',
						'|',
						'indent',
						'outdent',
						'htmlEmbed',
						'imageInsert',
						'todoList',
						'|',
						'imageUpload',
						'blockQuote',
						'insertTable',
						'mediaEmbed',
						'undo',
						'redo'
					]
				},
				language: 'en',
				image: {
					styles: [
                'alignLeft', 'alignCenter', 'alignRight'
            ],
					toolbar: [
					'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight',
                '|',
						'imageTextAlternative',
						'imageStyle:full',
						'imageStyle:side'
					]
				},
				table: {
					contentToolbar: [
						'tableColumn',
						'tableRow',
						'mergeTableCells',
						'tableCellProperties',
						'tableProperties'
					]
				},
				licenseKey: ''
				} 

)

    .then( editor => {

        
    } )
    .catch( error => {
        
    } );
	</script>
	<script>
		var searchurlconst = "<?php echo site_url('Getings'); ?>";
		var firstoneing = "<?php echo $xx;?>";
		//jquery is king, remember that.
		// AJAX call for ingredients autocomplete 
		$(document).ready(function(){
			$(".inginput").keyup(function(){
				if ($(".inginput").val().length > 2) {
					$.ajax({
						type: "POST",
						url: "<?php echo site_url('Getings'); ?>",
						data:'i=' + $(".inginput").val() + '&el=firstiing',
						beforeSend: function(){
							$(".inginput").css("background","#FFF url(images/gil.gif) no-repeat 255px");
							$(".inginput").css("background-size","25px 25px");
						},
						success: function(data){
							$(".appendedings").show();
							$(".appendedings").html(data);
							$(".inginput").css("background","#FFF");
						}
					});
				} else {
					$(".appendedings").hide();
				}
			});

			$(".add").click(function(){
				var genrand = (0|Math.random()*9e6).toString(36); //thank you, MasqueradeCircus
				$("#inglistmain").append(
					`
					<script>
					$(".inginput_` + genrand + `").keyup(function(){
						if ($(".inginput_` + genrand + `").val().length > 2) {
							$.ajax({
								type: "POST",
								url: searchurlconst,
								data:'i=' + $(".inginput_` + genrand + `").val() + '&el=` + genrand + `',
								beforeSend: function(){
									$(".inginput_` + genrand + `").css("background","#FFF url(images/gil.gif) no-repeat 255px");
									$(".inginput_` + genrand + `").css("background-size","25px 25px");
								},
								success: function(data){
									$(".appendedings_` + genrand + `").show();
									$(".appendedings_` + genrand + `").html(data);
									$(".inginput_` + genrand + `").css("background","#FFF");
								}
							});
						} else {
							$(".appendedings_` + genrand + `").hide();
						}
					}); <\/script>` + `
				<div class="f-row ingredient" id="ingcontainer_` + genrand + `">
					<div class="large holder">Ingredient: <input type="text" name="_ing` + genrand + `" class="inginput_`+ genrand + `" placeholder="Ingredient" required /></div>
					<div class="appendedings_` + genrand + `"></div>
					<div class="small">Quantity: <input type="text" name="_quan` + genrand + `" placeholder="Quantity" required /></div>
					<button class="remove" onClick="$('#ingcontainer_` + genrand + `').remove()">-</button>
				</div>
				`);
			}); 
		});
			function selectIng(val,el) {
				if (el == "firstiing") {
					$(".appendedings").hide();
					$(".inginput").val(val);
				} else {
					$(".inginput_" + el).val(val);
				$(".appendedings_" + el).hide();
				}
			}			
	</script>
</body>
</html>


