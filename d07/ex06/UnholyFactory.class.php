<?php

class UnholyFactory {

	private $_soldat = array();

	public function absorb( $person ) {
		if ( get_parent_class( $person ) ) {
			if ( isset( $this->_soldat[$person->getName()] ) )
				print( "(Factory already absorbed a fighter of type " . $person->getName() . ")" . PHP_EOL );
			else {
				print( "(Factory absorbed a fighter of type " . $person->getName() . ")" . PHP_EOL );
				$this->_soldat[$person->getName()] = $person;
			}
		}
		else
			print( "(Factory can't absorb this, it's not a fighter)" . PHP_EOL );
	}

	public function fabricate( $soldat ) {
		if ( array_key_exists( $soldat, $this->_soldat ) ) {
			print( "(Factory fabricates a fighter of type " . $soldat . ")" . PHP_EOL );
			return ( clone $this->_soldat[$soldat] );
		}
		else {
			print( "(Factory hasn't absorbed any fighter of type " . $soldat . ")" . PHP_EOL );
			return null;
		}
	}
}

?>
