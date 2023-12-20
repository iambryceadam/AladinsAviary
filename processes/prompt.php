<?php  if (count($prompt) > 0) : ?>
	<h6 class="" style="color: red; font-weight: bold; margin-bottom: 0px; font-size: 14px">
		<?php foreach ($prompt as $prompt_alert) : ?>
			<p><?php echo $prompt_alert ?></p>
		<?php endforeach ?>
	</h6>
<?php  endif ?>
