<?php

require_once 'Color.class.php';

Class Vertex {

	public static $verbose = False;
	private $_x;
	private $_y;
	private $_z;
	private $_w;
	private $_c;

	static function doc() {
		return file_get_contents( 'Vertex.doc.txt' );
	}

	public function __get( $attr ) {
		return $this->$attr;
	}

	public function getX() {
		return $this->_x;
	}

	public function getY() {
		return $this->_y;
	}

	public function getZ() {
		return $this->_z;
	}

	public function getW() {
		return $this->_w;
	}

	public function getC() {
		return $this->_c;
	}

	public function setX( $xv ) {
		return ( $this->_x = $xv );
	}

	public function setY( $yv ) {
		return ( $this->_y = $yv );
	}

	public function setZ( $zv ) {
		return ( $this->_z = $zv );
	}

	public function setW( $wv ) {
		return ( $this->_w = $wv );
	}

	public function setC( $cv ) {
		return ( $this->_c = $cv );
	}

	public function __construct( array $kwargs ) {
		$this->_w = 1.00;
		if ( isset( $kwargs['x'] ) && isset( $kwargs['y'] ) && isset( $kwargs['z'] ) ) {
			$this->_x = $kwargs['x'];
			$this->_y = $kwargs['y'];
			$this->_z = $kwargs['z'];
		}
		if ( isset( $kwargs['w'] ) )
			$this->_w = $kwargs['w'];
		if ( isset( $kwargs['color'] ) )
			$this->_c = $kwargs['color'];
		else
			$this->_c = $this->setC( new Color( array( 'red' => 255, 'green' => 255, 'blue' => 255 ) ) );
		if (self::$verbose === True)
			print( 'Vertex( x: ' . sprintf( "%.2f", $this->_x ) . ', y: ' . sprintf( "%.2f", $this->_y ) . ', z:' . sprintf( "%.2f", $this->_z ) . ', w:' . sprintf( "%.2f", $this->_w ) . ', ' . $this->_c . ' ) constructed' . PHP_EOL );
	}

	public function __destruct() {
		if ( self::$verbose === True )
			print( 'Vertex( x: ' . sprintf( "%.2f", $this->_x ) . ', y: ' . sprintf( "%.2f", $this->_y ) . ', z:' . sprintf( "%.2f", $this->_z ) . ', w:' . sprintf( "%.2f", $this->_w ) . ', ' . $this->_c . ' ) destructed' . PHP_EOL );
	}

	public function __toString() {
		if ( self::$verbose === True )
			return 'Vertex( x: ' . sprintf( "%.2f", $this->_x ) . ', y: ' . sprintf( "%.2f", $this->_y ) . ', z:' . sprintf( "%.2f", $this->_z ) . ', w:' . sprintf( "%.2f", $this->_w ) . ', ' . $this->_c . ' )';
		else
			return 'Vertex( x: ' . sprintf( "%.2f", $this->_x ) . ', y: ' . sprintf( "%.2f", $this->_y ) . ', z:' . sprintf( "%.2f", $this->_z ) . ', w:' . sprintf( "%.2f", $this->_w ) . ' )';
	}
}

?>
