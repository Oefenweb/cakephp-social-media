<?php echo $this->Html->docType('xhtml-trans'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php
		echo $this->Html->charset();
		echo $this->Html->meta(array('property' => 'og:title', 'content' => $options['title']));
		echo $this->Html->meta(array('property' => 'og:type', 'content' => $options['type']));
		echo $this->Html->meta(array('property' => 'og:url', 'content' => $options['url']));
		echo $this->Html->meta(array('property' => 'og:image', 'content' => $options['image']));
		echo $this->Html->meta(array('property' => 'og:description', 'content' => $options['description']));
		echo $this->Html->meta(array('http-equiv' => 'refresh', 'content' => sprintf('0;url=%s', $options['url'])));
		echo $this->fetch('script');
		?>
	</head>
	<body>
		<?php echo $this->fetch('content'); ?>
	</body>
</html>