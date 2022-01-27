<!DOCTYPE html>
<?php date_default_timezone_set('Asia/Manila'); ?>
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
								<?php if( isset($_SERVER['HTTP_SEC_FETCH_DEST']) && $_SERVER['HTTP_SEC_FETCH_DEST'] == 'iframe' ): ?>
									<a class="btn"><img class="avatar-xl" src="images/avatar.jpg" alt="avatar"></a>
								<?php else: ?>
									<a class="btn" href="Landing"><img class="avatar-xl" src="images/avatar.jpg" alt="avatar"></a>
								<?php endif ?>
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
									
								</div>
								<!-- Start of Discussions -->
								<div id="discussions" class="tab-pane fade active show">

									<div class="discussions">
										<h1>Chats 
										<?php if( isset($_SERVER['HTTP_SEC_FETCH_DEST']) && $_SERVER['HTTP_SEC_FETCH_DEST'] == 'iframe' ): ?>
										<?php else: ?>
											<a style="text-decoration: underline; font-size: 16px; cursor: pointer; margin-left: 50px;" href="Landing">Go back</a>
										<?php endif ?>
										
										</h1>
										<div class="list-group lc_summarycontainer" id="chats" role="tablist">

											<?php foreach ($msgsummary as $msgsum): ?>
												<!--per item -->
												<?php if ($msgsum['msg'] != '__blankbro__' && $msgsum['userIndexTo'] != $_SESSION['userid']) : ?>
												<a href="#list-chat_<?php echo $msgsum['userIndexTo']?>" class="filterDiscussions all single lc_summ_<?php echo $msgsum['userIndexTo']?>" id="list-chat-list" data-toggle="list" role="tab">
													<img class="avatar-md" src="images/avatar.jpg" data-toggle="tooltip" data-placement="top" title="<?php echo $msgsum['mainname'] ?>" alt="avatar">
													<div class="status lc_stat_<?php echo $msgsum['userIndexTo']?>" style="display: none;">
														<i class="material-icons online">fiber_manual_record</i>
													</div>
													<!-- <div class="new bg-yellow">
														<span>+7</span>
													</div> -->
													<div class="data">
														<h5><?php echo $msgsum['mainname']; ?></h5>
														<?php
														//php why u gib wrong day of week bro
															$dt = DateTime::createFromFormat('Y-m-d H:i:s', $msgsum['lastmsgdate']);
															$newdt = $dt->format('D g:i a');
														?>
														<span class="lc_lastmsgdate_<?php echo $msgsum['userIndexTo']?>"><?php echo $newdt; ?></span>
														<p class="lc_lastmsg_<?php echo $msgsum['userIndexTo']?>">
														
														<?php 
															if ($msgsum['lastmsg'] == '__blankbro__') {
																echo strlen($msgsum['msg']) > 15 ? substr($msgsum['msg'],0,12) . "..." : $msgsum['msg'] ; 
															} else {
																echo strlen($msgsum['lastmsg']) > 15 ? substr($msgsum['lastmsg'],0,12) . "..." : $msgsum['lastmsg'] ; 
															}
														
														
														?>
														
														</p>
													</div>
												</a>
												<?php endif ?>
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
							<div class="babble tab-pane fade active" id="list-chat_<?php echo $allmsg['ind']?>" role="tabpanel" aria-labelledby="list-chat-list">
								<!-- Start of Chat -->
								<div class="chat" id="chat1">
									<div class="top">
										<div class="container">
											<div class="col-md-12">
												<div class="inside">
													<a href="#"><img class="avatar-md" src="images/avatar.jpg" data-toggle="tooltip" data-placement="top" alt="avatar"></a>
													<div class="status">
														<i class="material-icons online">fiber_manual_record</i>
													</div>
													<div class="data">
														<h5><a href="#" id="lc_name_<?php echo $allmsg['ind']?>"><?php echo $allmsg['nm'] ?></a></h5>
														<span>Active now? idk</span>
													</div>
													<!-- <button class="btn connect d-md-block d-none" name="1"><i class="material-icons md-30">phone_in_talk</i></button>
													<button class="btn connect d-md-block d-none" name="1"><i class="material-icons md-36">videocam</i></button> -->
													
												</div>
											</div>
										</div>
									</div>
									<div class="content lc_conte_<?php echo $allmsg['ind']?>" id="content">
										<div class="container">
											<div class="col-md-12 lc_cont_<?php echo $allmsg['ind']?>">
												<!-- <div class="date">
													<hr>
													<span>Yesterday</span>
													<hr>
												</div> -->
												<?php foreach ($allmsg['data'] as $msg): ?>
													<?php if ($msg['msg'] != '__blankbro__'): ?>
													<div class="message <?php echo $msg['userIndexFrom'] == $_SESSION['userid'] ? "me" : "" ?>">
														<?php if ($msg['userIndexFrom'] != $_SESSION['userid']): ?>
															<img class="avatar-md" src="images/avatar.jpg" data-toggle="tooltip" data-placement="top" alt="avatar">
														<?php endif ?>
														<div class="text-main">
															<div class="text-group <?php echo $msg['userIndexFrom'] == $_SESSION['userid'] ? "me" : "" ?>">
																<div class="text <?php echo $msg['userIndexFrom'] == $_SESSION['userid'] ? "me" : "" ?>">
																	<p><?php echo $msg['msg'] ?></p>
																</div>
															</div>
															<span><?php echo $msg['msgDate'] == "1999-01-01 00:00:00" ? "System generated message" : date("F j Y, g:i a", strtotime($msg['msgDate'])) ; ?></span>
														</div>
													</div>
													<?php endif ?>
												<?php endforeach ?>
											</div>
										</div>
									</div>
									<div class="container">
										<div class="col-md-12">
											<div class="bottom">
												
													<textarea data-userfrom="<?php echo $_SESSION['userid'] ?>" data-userto="<?php echo $allmsg['ind'] ?>" class="form-control lc_replymsg_<?php echo $allmsg['ind'] ?>" name="msgreply" placeholder="Start typing for reply..." rows="1"></textarea>
													<!-- <button class="btn emoticons"><i class="material-icons">insert_emoticon</i></button> -->
													<button onClick="sendMsg('<?php echo $_SESSION['userid'] ?>','<?php echo $allmsg['ind'] ?>')" class="btn send"><i class="material-icons">send</i></button>
												
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
		<script src="js/jquery.min.js"></script>
		<script src="dist/js/vendor/popper.min.js"></script>
		<script src="dist/js/swipe.min.js"></script>
		<script src="dist/js/bootstrap.min.js"></script>
		<script src="js/moment.js"></script>
		
		
		
		<script>
			var globalMe = "<?php echo $_SESSION['userid']; ?>";
			var currentaid = "";
			function sendMsg(f,t) {
				var reps = $('.lc_replymsg_' + t).val();
				var lastmsg_compare1 = $('.lc_lastmsg_' + t).html();
				if (lastmsg_compare1 == reps) {
					alert("Spamming is not allowed! Do not send the same messages twice!");
					var reps = $('.lc_replymsg_' + t).val("");
				} else {
					$.ajax({
							type: "POST",
							url: "<?php echo site_url('Messaging'); ?>",
							data:'mo=1' + '&msgreply=' + encodeURIComponent(reps) + '&userto=' + t,
							beforeSend: function(){
								$('.lc_replymsg_' + t).val("");
							},
							success: function(data){
								if (data == 'thatsbad') {
									alert('Message not sent!');
								} else {
									$('.lc_cont_' + t).append(data);
									moveRecentChatToTop(t);
									setTimeout(function() { 
										$('.lc_conte_' + t).animate({ scrollTop: $('.lc_conte_' + t).prop("scrollHeight")}, 300);
									}, 300);
								}
								
							}
						});
				}
				
			}
			function moveRecentChatToTop(x) {
				$(".lc_summ_" + x).detach().prependTo(".lc_summarycontainer");
			}
			function initChats(idsplit) {
				$.ajax({
							type: "POST",
							url: "<?php echo site_url('Messaging'); ?>",
							data:'mo=2' + '&userto=' + idsplit,
							beforeSend: function(){
								//$("#loadingcomment").show();
								
							},
							success: function(data){
								currentaid = idsplit;
								$('.lc_cont_' + idsplit).empty();
								
								$('.lc_cont_' + idsplit).html(data);
								$('.lc_stat_' + idsplit).css("display", "none");
								
								setTimeout(function() { 
									console.log("SCROLLED");
									$('.lc_conte_' + idsplit).animate({ scrollTop: $('.lc_conte_' + idsplit).prop("scrollHeight")}, 300);
								}, 300);
								
								
							}
						});
			}
			$(document).ready(function(){
				$('textarea').keypress(function(event) {
					if (event.keyCode == 13) {
						event.preventDefault();
						sendMsg($(this).data("userfrom"),$(this).data("userto"));
					}
				});
				var source_second = new EventSource("<?php echo site_url('Messaging'); ?>?mod=2");
				source_second.onmessage = function(event){
					var maindata = event.data;
					if (maindata) {
						var msgs = JSON.parse(maindata);
						for(var i = 0; i<msgs.length; i++) {
							var aid = msgs[i].userIndexTo;
							var aidf = msgs[i].userIndexFrom;
							var lastmsg = msgs[i].lastmsg;

							var finaldate = moment(msgs[i].lastmsgdate).format(("MMMM dd yyyy, hh:mm a"));
							var finaldate2 = moment(msgs[i].lastmsgdate).format(("ddd h:mm a"));
							var lastmsg_compare = $('.lc_lastmsg_' + aid).html();
							var htmldataa = '<div class="message"><img class="avatar-md" src="images/avatar.jpg" data-toggle="tooltip" data-placement="top" alt="avatar">' +
														'<div class="text-main">' +
															'<div class="text-group">' +
																'<div class="text">' +
																	'<p>' + lastmsg + '</p>' +
																'</div>' +
															'</div>' +
															'<span>' + finaldate + '</span>' +
														'</div>' +
													'</div>';
							
							if (lastmsg_compare != lastmsg) {
								$('.lc_lastmsg_' + aid).html(lastmsg);
								$('.lc_lastmsgdate_' + aid).html(finaldate2);
							
								if (currentaid == aid) {
									initChats(aid);
								} else {
									$('.lc_stat_' + aid).css("display", "block");
									moveRecentChatToTop(aid)
								}
								
								setTimeout(function() { 
										console.log("SCROLLED");
										$('.lc_conte_' + aid).animate({ scrollTop: $('.lc_conte_' + aid).prop("scrollHeight")}, 300);
									}, 300);
								
							}
						}
						
					}
				};
				$('a').click(function(event) { 
					var mms = $(this).attr('href');
					if (mms.startsWith("#list-chat_")) {
						var idsplita = mms.split("chat_")[1];
						initChats(idsplita);
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