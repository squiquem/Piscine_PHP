<?php

Class Color {

	public static $verbose = False;
	public $red = 0;
	public $green = 0;
	public $blue = 0;

	public static function doc() {
		return file_get_contents( 'Color.doc.txt' );
	}

	public function __construct( array $kwargs ) {
		if (array_key_exists( 'rgb', $kwargs ) ) {
			$this->red = $kwargs['rgb'] >> 16;
			$this->green = ( $kwargs['rgb'] - ( $this->red << 16 ) ) >> 8;
			$this->blue = $kwargs['rgb'] - ( $this->red << 16 ) - ( $this->green << 8 );
		}
		else if ( isset( $kwargs['red'] ) && isset( $kwargs['green'] ) && isset( $kwargs['blue'] ) ) {
			$this->red = round( $kwargs['red'] );
			$this->green = round( $kwargs['green'] );
			$this->blue = round( $kwargs['blue'] );
		}

		if ( $this->red < 0 )
			$this->red = 0;
		if ( $this->green < 0 )
			$this->green = 0;
		if ( $this->blue < 0 )
			$this->blue = 0;
		if ( $this->red > 255 )
			$this->red = 255;
		if ( $this->green > 255 )
			$this->green = 255;
		if ( $this->blue > 255 )
			$this->blue = 255;

		if ( self::$verbose == True ) {
			print( 'Color( red: ' . sprintf( "%3s", $this->red ) . ', green: ' . sprintf( "%3s", $this->green ) . ', blue: ' . sprintf( "%3s", $this->blue ) . ' ) constructed.' . PHP_EOL );
		}
	}

	public function __destruct() {
		if ( self::$verbose == True ) {
			print( 'Color( red: ' . sprintf( "%3s", $this->red ) . ', green: ' . sprintf( "%3s", $this->green ) . ', blue: ' . sprintf( "%3s", $this->blue ) . ' ) destructed.' . PHP_EOL );
		}
	}

	public function __toString() {
		return 'Color( red: ' . sprintf( "%3s", $this->red ) . ', green: ' . sprintf( "%3s", $this->green ) . ', blue: ' . sprintf( "%3s", $this->blue ) . ' )';
	}

	public function add($color) {
		return new Color( array( 'red' => $this->red + $color->red, 'green' => $this->green + $color->green, 'blue' => $this->blue + $color->blue ) );
	}

	public function sub($color) {
		return new Color( array( 'red' => $this->red - $color->red, 'green' => $this->green - $color->green, 'blue' => $this->blue - $color->blue ) );
	}

	public function mult($f) {
		return new Color( array( 'red' => $this->red * $f, 'green' => $this->green * $f, 'blue' => $this->blue * $f ) );
	}
}

?>
