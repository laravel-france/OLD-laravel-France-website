<?php

return array(
	'messages_per_page' => 15,
	'topics_per_page' => 15,
	'mark_as_read_after' => function() {
		$nbDays = 10;
		return time() - ( $nbDays*24*60*60 );
	}, // days
);