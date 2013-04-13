<?php

class Forum_Task {
	
    public function help() { $this->run(); }
    public function run()
    {
        echo <<<EOT
\n=============FORUM COMMANDS=============\n        
forum:cleanoldview
\n==================END==================\n        
EOT;
    }

    public function cleanoldview()
    {
		echo "Cleaning table forumview.\n";
		DB::query('DELETE FROM forumviews WHERE updated_at < DATE_SUB(NOW(),INTERVAL 11 DAY);');
		$nb =  DB::query('SELECT ROW_COUNT() as nb;');
		echo "Done. ".$nb[0]->nb." rows affected.\n";
    }

}