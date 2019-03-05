<?php

class NightsWatch {
	private $_fighters = array();
	public function recruit( $person ) {
		$this->_fighters[] = $person;
	}
	public function fight() {
		foreach( $this->_fighters as $fighter )
			if ( method_exists( get_class( $fighter ), 'fight') )
				$fighter->fight();
	}
}

?>
