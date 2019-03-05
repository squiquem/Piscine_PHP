<?php

class House {

	public function introduce() {
		print( "House " . static::getHousename() . " of " . static::getHouseSeat() . " : \"" . static::getHouseMotto() . "\"" . PHP_EOL);
	}
}

?>
