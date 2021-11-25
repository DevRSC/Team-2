<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
	<h1>TESTING: LIST OF USERS!</h1>
	<br>
	<?php $count = 1; ?>
	<?php foreach($userdata as $user): ?>
		User <?php echo $count . " " . $user['firstname'] . " " . $user['lastname'] ?><br>
		<?php $count = $count + 1; ?>
	<?php endforeach?>
</html>