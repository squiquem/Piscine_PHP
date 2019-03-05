<?php

Class Vector {

	public static $verbose = False;
	private $_x;
	private $_y;
	private $_z;
	private $_w;

	 static function doc() {
		return file_get_contents( 'Vector.doc.txt' );
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

	public function __construct( array $kwargs ) {
		if ( !isset($kwargs['orig'] ) )
			$kwargs['orig'] = new Vertex( array( 'x' => 0.0, 'y' => 0.0, 'z' => 0.0 ) );
		if (isset( $kwargs['dest'] ) && isset( $kwargs['orig'] ) ) {
			$this->_x = $kwargs['dest']->getX() - $kwargs['orig']->getX();
			$this->_y = $kwargs['dest']->getY() - $kwargs['orig']->getY();
			$this->_z = $kwargs['dest']->getZ() - $kwargs['orig']->getZ();
			$this->_w = 0.0;
		}
		if ( self::$verbose === True )
			print( 'Vector( x: ' . sprintf( "%.2f", $this->_x ) . ', y: ' . sprintf( "%.2f", $this->_y ) . ', z:' . sprintf( "%.2f", $this->_z ) . ', w:' . sprintf( "%.2f", $this->_w ) . ' ) constructed' . PHP_EOL );
	}

	public function __destruct() {
		if ( self::$verbose === True )
			print( 'Vector( x: ' . sprintf( "%.2f", $this->_x ) . ', y: ' . sprintf( "%.2f", $this->_y ) . ', z:' . sprintf( "%.2f", $this->_z ) . ', w:' . sprintf( "%.2f", $this->_w ) . ' ) destructed' . PHP_EOL );
	}

	public function __toString() {
		return 'Vector( x: ' . sprintf( "%.2f", $this->_x ) . ', y: ' . sprintf( "%.2f", $this->_y ) . ', z:' . sprintf( "%.2f", $this->_z ) . ', w:' . sprintf( "%.2f", $this->_w ) . ' )';
	}

	public function magnitude() {
		return sqrt( pow( $this->_x, 2 ) + pow( $this->_y, 2 ) + pow( $this->_z, 2 ) );
	}

	public function normalize() {
		$norm = $this->magnitude();
		$destination = new Vertex( array( 'x' => $this->getX() / $norm, 'y' => $this->getY() / $norm, 'z' => $this->getZ() / $norm ) );
		return new Vector( array( 'dest' => $destination ) );
	}

	public function add( Vector $rhs ) {
		$x = $this->getX() + $rhs->getX();
		$y = $this->getY() + $rhs->getY();
		$z = $this->getZ() + $rhs->getZ();
		$destination = new Vertex( array( 'x' => $x, 'y' => $y, 'z' => $z ) );
		return new Vector( array( 'dest' => $destination ) );
	}

	public function sub( Vector $rhs ) {
		$x = $this->getX() - $rhs->getX();
		$y = $this->getY() - $rhs->getY();
		$z = $this->getZ() - $rhs->getZ();
		$destination = new Vertex( array( 'x' => $x, 'y' => $y, 'z' => $z ) );
		return new Vector( array( 'dest' => $destination ) );
	}

	public function opposite() {
		$x = - $this->getX();
		$y = - $this->getY();
		$z = - $this->getZ();
		$destination = new Vertex( array( 'x' => $x, 'y' => $y, 'z' => $z ) );
		return new Vector( array( 'dest' => $destination ) );
	}

	public function scalarProduct( $k ) {
		$x = $this->getX() * $k;
		$y = $this->getY() * $k;
		$z = $this->getZ() * $k;
		$destination = new Vertex( array( 'x' => $x, 'y' => $y, 'z' => $z ) );
		return new Vector( array( 'dest' => $destination ) );
	}

	public function dotProduct( Vector $rhs ) {
		return ($this->getX() * $rhs->getX() + $this->getY() * $rhs->getY() + $this->getZ() * $rhs->getZ());
	}

	public function cos( Vector $rhs ) {
		return ( $this->dotProduct($rhs) / ( $this->magnitude() * $rhs->magnitude() ) );
	}

	public function crossProduct( Vector $rhs ) {
		$x = $this->getY() * $rhs->getZ() - $this->getZ() * $rhs->getY();
		$y = $this->getZ() * $rhs->getX() - $this->getX() * $rhs->getZ();
		$z = $this->getX() * $rhs->getY() - $this->getY() * $rhs->getX();;
		$destination = new Vertex( array( 'x' => $x, 'y' => $y, 'z' => $z ) );
		return new Vector( array( 'dest' => $destination ) );
	}
}

?>
