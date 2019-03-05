<?php

class Tyrion {
	public function sleepWith( $person ) {
		if ( get_class( $person ) === 'Sansa' )
			print( "Let's do this." . PHP_EOL );
		if ( get_class( $person ) === 'Jaime' )
			print( "Not even if I'm drunk !" . PHP_EOL );
		if ( get_class( $person ) === 'Cersei' )
			print( "Not even if I'm drunk !" . PHP_EOL );
	}
}

?>
