<?php

class MultulBB {

        private function get_config() {
    	  include ($phpbb_root_path . 'includes/multulbb/config');
          
          $config = array(
              'multul_status'   =>  $config_multul_status,
              'multul_id'       =>  $config_multul_id,
              'multul_key'      =>  $config_multul_key,
          );
          return $config;
        }

	public static function multul_get_link($user_id, $username) {
		global $auth, $user;
                $config = self::get_config();

		if ($user->data['is_registered'] && $user_id != $user->data['user_id'] && $config['multul_status']) {
			return '<a href="javascript:;" onclick="multul.im.openContact(' . $user_id . ',\'' . $username . '\')"><img src="http://cdn.multul.ru/v1/images/messenger/send_msg.png" alt="" /></a><br>';
		} else {
			return '';
		}
	}

	public static function multul_init() {
		global $user, $auth;
		include($phpbb_root_path . 'includes/multulbb/lib/multul_lib.php');
                $config = self::get_config();

		$user_id		= $user->data['user_id'];
		$user_name		= $user->data['username'];
		$multul_id		= $config['multul_id'];
		$multul_key		= $config['multul_key'];

		if ($user->data['is_registered'] && $multul_id && $multul_key && $config['multul_status']) {
			$config = array(
				'app_id'		=> $multul_id,
				'secret_key'            => $multul_key,
				'uid'			=> $user_id,
				'name'			=> $user_name,
			);
			return Multul::factory($config)->render();
		}
	}
}