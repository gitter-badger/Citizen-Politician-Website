<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $head;?>
</head>
<body>
<?php echo $navbar;?>
<script>$("a[href='<?php echo base_url()?>start_poll.html']").addClass("active");</script>
</body>
</html>