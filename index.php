<?php
require_once('ctrl/config/main_page_config.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<?php $contentHandler->make_head_section(); ?>
	</head>
<body>
	<?php include('./theme/'.$contentHandler->get_layout())?>
</body>

</html>