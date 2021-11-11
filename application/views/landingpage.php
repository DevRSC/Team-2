<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
	<h1>TESTING: LIST OF USERS!</h1>
	<br>

	<?php foreach($userdata as $user): ?>
		User: <?php echo $user['firstname'] . " " . $user['lastname'] ?>
	<?php endforeach?>
</html>