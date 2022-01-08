<!DOCTYPE html>
<html lang="en">

<head>
		<meta charset="utf-8">
		<title>Meals for Makers - Messaging</title>
		<meta name="description" content="#">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap core CSS -->
		<link href="dist/css/lib/bootstrap.min.css" type="text/css" rel="stylesheet">
		<!-- Swipe core CSS -->
		<link href="dist/css/swipe.min.css" type="text/css" rel="stylesheet">
		<!-- Meals for makers Icon -->
		<link rel="shortcut icon" href="../HTML/dist/img/Mr sludgy.png">
	</head>
	<body>
		<main>
			<div class="layout">
				<!-- Start of Navigation -->
				<div class="navigation">
					<div class="container">
						<div class="inside">
							<div class="nav nav-tab menu">
								<a class="btn"><img class="avatar-xl" src="images/avatar.jpg" alt="avatar"></a>
								<!-- <a href="#members" data-toggle="tab"><i class="material-icons">account_circle</i></a> -->
								<a href="#discussions" data-toggle="tab" class="active"><i class="material-icons active">chat_bubble_outline</i></a>
								<!-- <a href="#notifications" data-toggle="tab" class="f-grow1"><i class="material-icons">notifications_none</i></a> -->
								<!-- <a href="#settings" data-toggle="tab"><i class="material-icons">settings</i></a> -->
							</div>
						</div>
					</div>
				</div>
				<!-- End of Navigation -->
				<!-- Start of Sidebar -->
				<div class="sidebar" id="sidebar">
					<div class="container">
						<div class="col-md-12">
							<div class="tab-content">
								<!-- Start of Contacts -->
								<div class="tab-pane fade" id="members">
									<div class="search">
										<form class="form-inline position-relative">
											<input type="search" class="form-control" id="people" placeholder="Search for people...">
											<button type="button" class="btn btn-link loop"><i class="material-icons">search</i></button>
										</form>
										<button class="btn create" data-toggle="modal" data-target="#exampleModalCenter"><i class="material-icons">person_add</i></button>
									</div>
									<div class="list-group sort">
										<button class="btn filterMembersBtn active show" data-toggle="list" data-filter="all">All</button>
										<button class="btn filterMembersBtn" data-toggle="list" data-filter="online">Online</button>
										<button class="btn filterMembersBtn" data-toggle="list" data-filter="offline">Offline</button>
									</div>						
									<!-- <div class="contacts">
										<h1>Contacts</h1>
										<div class="list-group" id="contacts" role="tablist">
											<a href="#" class="filterMembers all online contact" data-toggle="list">
												<img class="avatar-md" src="dist/img/avatars/avatar-female-1.jpg" data-toggle="tooltip" data-placement="top" title="Janette" alt="avatar">
												<div class="status">
													<i class="material-icons online">fiber_manual_record</i>
												</div>
												<div class="data">
													<h5>Janette Dalton</h5>
													<p>Sofia, Bulgaria</p>
												</div>
												<div class="person-add">
													<i class="material-icons">person</i>
												</div>
											</a>
											<a href="#" class="filterMembers all online contact" data-toggle="list">
												<img class="avatar-md" src="dist/img/avatars/avatar-male-1.jpg" data-toggle="tooltip" data-placement="top" title="Michael" alt="avatar">
												<div class="status">
													<i class="material-icons online">fiber_manual_record</i>
												</div>
												<div class="data">
													<h5>Michael Knudsen</h5>
													<p>Washington, USA</p>
												</div>
												<div class="person-add">
													<i class="material-icons">person</i>
												</div>
											</a>
											<a href="#" class="filterMembers all online contact" data-toggle="list">
												<img class="avatar-md" src="dist/img/avatars/avatar-female-2.jpg" data-toggle="tooltip" data-placement="top" title="Lean" alt="avatar">
												<div class="status">
													<i class="material-icons online">fiber_manual_record</i>
												</div>
												<div class="data">
													<h5>Lean Avent</h5>
													<p>Shanghai, China</p>
												</div>
												<div class="person-add">
													<i class="material-icons">person</i>
												</div>
											</a>
											<a href="#" class="filterMembers all online contact" data-toggle="list">
												<img class="avatar-md" src="dist/img/avatars/avatar-male-2.jpg" data-toggle="tooltip" data-placement="top" title="Mariette" alt="avatar">
												<div class="status">
													<i class="material-icons online">fiber_manual_record</i>
												</div>
												<div class="data">
													<h5>Mariette Toles</h5>
													<p>Helena, Montana</p>
												</div>
												<div class="person-add">
													<i class="material-icons">person</i>
												</div>
											</a>
											<a href="#" class="filterMembers all online contact" data-toggle="list">
												<img class="avatar-md" src="dist/img/avatars/avatar-female-3.jpg" data-toggle="tooltip" data-placement="top" title="Harmony" alt="avatar">
												<div class="status">
													<i class="material-icons online">fiber_manual_record</i>
												</div>
												<div class="data">
													<h5>Harmony Otero</h5>
													<p>Indore, India</p>
												</div>
												<div class="person-add">
													<i class="material-icons">person</i>
												</div>
											</a>
											<a href="#" class="filterMembers all offline contact" data-toggle="list">
												<img class="avatar-md" src="dist/img/avatars/avatar-female-5.jpg" data-toggle="tooltip" data-placement="top" title="Keith" alt="avatar">
												<div class="status">
													<i class="material-icons offline">fiber_manual_record</i>
												</div>
												<div class="data">
													<h5>Keith Morris</h5>
													<p>Chisinau, Moldova</p>
												</div>
												<div class="person-add">
													<i class="material-icons">person</i>
												</div>
											</a>
											<a href="#" class="filterMembers all offline contact" data-toggle="list">
												<img class="avatar-md" src="dist/img/avatars/avatar-female-6.jpg" data-toggle="tooltip" data-placement="top" title="Louis" alt="avatar">
												<div class="status">
													<i class="material-icons offline">fiber_manual_record</i>
												</div>
												<div class="data">
													<h5>Louis Martinez</h5>
													<p>Vienna, Austria</p>
												</div>
												<div class="person-add">
													<i class="material-icons">person</i>
												</div>
											</a>
											<a href="#" class="filterMembers all offline contact" data-toggle="list">
												<img class="avatar-md" src="dist/img/avatars/avatar-male-3.jpg" data-toggle="tooltip" data-placement="top" title="Ryan" alt="avatar">
												<div class="status">
													<i class="material-icons offline">fiber_manual_record</i>
												</div>
												<div class="data">
													<h5>Ryan Foster</h5>
													<p>Oslo, Norway</p>
												</div>
												<div class="person-add">
													<i class="material-icons">person</i>
												</div>
											</a>
											<a href="#" class="filterMembers all offline contact" data-toggle="list">
												<img class="avatar-md" src="dist/img/avatars/avatar-male-4.jpg" data-toggle="tooltip" data-placement="top" title="Mildred" alt="avatar">
												<div class="status">
													<i class="material-icons offline">fiber_manual_record</i>
												</div>
												<div class="data">
													<h5>Mildred Bennett</h5>
													<p>London, United Kingdom</p>
												</div>
												<div class="person-add">
													<i class="material-icons">person</i>
												</div>
											</a>
										</div>
									</div> -->
								</div>
								<!-- End of Contacts -->
								<!-- Start of Discussions -->
								<div id="discussions" class="tab-pane fade active show">

									<div class="discussions">
										<h1>Chats</h1>
										<div class="list-group" id="chats" role="tablist">

											<?php foreach ($msgsummary as $msgsum): ?>
												<!--per item -->
												<a href="#list-chat_<?php echo $msgsum['userIndexTo']?>" class="filterDiscussions all single" id="list-chat-list" data-toggle="list" role="tab">
													<img class="avatar-md" src="images/avatar.jpg" data-toggle="tooltip" data-placement="top" title="<?php echo $msgsum['mainname'] ?>" alt="avatar">
													<div class="status">
														<i class="material-icons online">fiber_manual_record</i>
													</div>
													<!-- <div class="new bg-yellow">
														<span>+7</span>
													</div> -->
													<div class="data">
														<h5><?php echo $msgsum['mainname']; ?></h5>
														<span><?php echo date("D g:i a", strtotime($msgsum['msgDate'])); ?></span>
														<p><?php echo substr($msgsum['msg'],0,23) . "..."; ?></p>
													</div>
												</a>
												<!--per item -->
											<?php endforeach ?>
										

											
										</div>
									</div>

									


								</div>

							</div>
						</div>
					</div>
				</div>
				<!-- End of Sidebar -->
				<div class="main">
					<div class="tab-content" id="nav-tabContent">

						<?php foreach ($allmsgdata as $allmsg): ?>
						<!-- Start of Babble -->
							<div class="babble tab-pane fade active show" id="list-chat_<?php echo $allmsg['ind']?>" role="tabpanel" aria-labelledby="list-chat-list">
								<!-- Start of Chat -->
								<div class="chat" id="chat1">
									<div class="top">
										<div class="container">
											<div class="col-md-12">
												<div class="inside">
													<a href="#"><img class="avatar-md" src="images/avatar.jpg" data-toggle="tooltip" data-placement="top" title="Keith" alt="avatar"></a>
													<div class="status">
														<i class="material-icons online">fiber_manual_record</i>
													</div>
													<div class="data">
														<h5><a href="#"><?php echo $allmsg['nm'] ?></a></h5>
														<span>Active now? idk</span>
													</div>
													<!-- <button class="btn connect d-md-block d-none" name="1"><i class="material-icons md-30">phone_in_talk</i></button>
													<button class="btn connect d-md-block d-none" name="1"><i class="material-icons md-36">videocam</i></button> -->
													<button class="btn d-md-block d-none"><i class="material-icons md-30">info</i></button>
													<div class="dropdown">
														<button class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons md-30">more_vert</i></button>
														<div class="dropdown-menu dropdown-menu-right">
															<!-- <button class="dropdown-item"><i class="material-icons">block</i>Block Contact</button> -->
															<button class="dropdown-item"><i class="material-icons">delete</i>Delete Contact</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="content" id="content">
										<div class="container">
											<div class="col-md-12">
												<!-- <div class="date">
													<hr>
													<span>Yesterday</span>
													<hr>
												</div> -->
												<?php foreach ($allmsg['data'] as $msg): ?>
													<div class="message <?php echo $msg['userIndexFrom'] == $_SESSION['userid'] ? "me" : "" ?>">
														<?php if ($msg['userIndexFrom'] != $_SESSION['userid']): ?>
															<img class="avatar-md" src="images/avatar.jpg" data-toggle="tooltip" data-placement="top" title="Keith" alt="avatar">
														<?php endif ?>
														<div class="text-main">
															<div class="text-group <?php echo $msg['userIndexFrom'] == $_SESSION['userid'] ? "me" : "" ?>">
																<div class="text <?php echo $msg['userIndexFrom'] == $_SESSION['userid'] ? "me" : "" ?>">
																	<p><?php echo $msg['msg'] ?></p>
																</div>
															</div>
															<span><?php echo date("F j Y, g:i a", strtotime($msg['msgDate'])); ?></span>
														</div>
													</div>
												<?php endforeach ?>
											</div>
										</div>
									</div>
									<div class="container">
										<div class="col-md-12">
											<div class="bottom">
												<form action="Messaging" method="post" class="position-relative w-100">
													<textarea class="form-control" name="msgreply" placeholder="Start typing for reply..." rows="1"></textarea>
													<input type="hidden" name="userfrom" value="<?php echo $_SESSION['userid'] ?>" />
													<input type="hidden" name="userto" value="<?php echo $allmsg['ind'] ?>" />
													<!-- <button class="btn emoticons"><i class="material-icons">insert_emoticon</i></button> -->
													<button type="submit" class="btn send"><i class="material-icons">send</i></button>
												</form>
												<!-- <label>
													<input type="file">
													<span class="btn attach d-sm-block d-none"><i class="material-icons">attach_file</i></span>
												</label>  -->
											</div>
										</div>
									</div>
								</div>
								<!-- End of Chat -->

							</div>
							<?php endforeach ?>
							<!-- End of Babble -->
						
						
					</div>
				</div>
			</div> <!-- Layout -->
		</main>
		<!-- Bootstrap/Swipe core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="dist/js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script>window.jQuery || document.write('<script src="dist/js/vendor/jquery-slim.min.js"><\/script>')</script>
		<script src="dist/js/vendor/popper.min.js"></script>
		<script src="dist/js/swipe.min.js"></script>
		<script src="dist/js/bootstrap.min.js"></script>
		<script>
			function scrollToBottom(el) { el.scrollTop = el.scrollHeight; }
			scrollToBottom(document.getElementById('content'));
		</script>
		
		<script>
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