<?php

class MultulBB {

	public static function multul_get_link($user_id, $username) {
		global $auth, $user;
		if ($user->data['is_registered'] && $user_id != $user->data['user_id']) {
			return '<a href="javascript:;" onclick="multul.im.openContact(' . $user_id . ',\'' . $username . '\')"><img src="http://multul.ru/media/images/messenger/chats.gif" alt="" /></a><br>';
		} else {
			return '';
		}
	}

	public static function multul_init() {
		global $user, $auth;

		include($phpbb_root_path . 'includes/multulbb/lib/multul_lib.php');
		include($phpbb_root_path . 'includes/multulbb/config');

		$user_id		= $user->data['user_id'];
		$user_name		= $user->data['username'];
		$multul_id		= $config_multul_id;
		$multul_key		= $config_multul_key;

		if ($user->data['is_registered'] && $multul_id && $multul_key) {
			$config = array(
				'app_id'		=> $multul_id,
				'secret_key'	=> $multul_key,
				'uid'			=> $user_id,
				'name'			=> $user_name,
			);
			return Multul::factory($config)->render();
		}
	}
}