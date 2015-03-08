<?php

Class create_model extends CI_Model
{
	function new_room($slug, $password)
	{
	    $data = array(
	    'slug' => $slug,
	    'password' => md5($password),

// Default channel information panel after =>
	    'showName' => 

	    'Welcome',

	    'showDescription' => '<center>
<h1>'.$slug.'</h1>

<img height="50%" width="50%" src="http://channelcentral.me/resources/images/purple.gif">

This is a Channel. Use it to Share Videos.

<b>
If you are the Owner of this page, <a target="_blank" href="http://channelcentral.me/music/host">Visit your Hosting Center.
</a>
</b>
</center>'
		,
		// End channel information panel after ,
	    'headline' => $slug,
	    'length' => '600',
	    'queue' => '1200',
	    'background' => 'default.jpg',
	    'reload' => '0',
	    'shuffle' => '0',
	    'purple' => '<center><img class="img-circle" style="width: 100%; max-height: 100%" src="resources/images/purple.gif"/></center>',
	    'orange' => '<center><img class="img-circle" style="width: 100%; max-height: 100%" src="resources/images/orange.gif"/></center>',
	    'green' => '<center><img class="img-circle" style="width: 100%; max-height: 100%" src="resources/images/green.gif"/></center>',
	    'started' => time(),
	    'last_login' => time()
	    );
	   $this->db->insert('rooms', $data);
	}

}