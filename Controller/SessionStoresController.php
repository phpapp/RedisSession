<?php

class SessionStoresController extends AppController {

	public $uses = array('RedisSession.SessionStore');

	public function admin_index() {
		$userMaps = $this->SessionStore->userMap();
		$userSessions = array();
		if ($userMaps) {
			foreach ($userMaps as $userMap) {
				$data = $this->SessionStore->sessionData($userMap);
				$userSessions[$userMap] = $data;
			}
		}
		$totalSessions = $this->SessionStore->total();
		$this->set(compact('totalSessions', 'userMaps', 'userSessions'));
	}

	public function admin_disconnect($id) {
		$this->SessionStore->disconnect($id);
		$this->redirect($this->referer());
	}

}
