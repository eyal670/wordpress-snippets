<?php
global $current_user;
	 $ban_user = false;

		get_currentuserinfo();
		if($post->post_author == $current_user->ID || current_user_can('administrator')){
      // current user is the author
		}else{
			// current user is not the author
			$ban_user = true;
		}
