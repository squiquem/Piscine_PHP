<?php

require_once 'Vertex.class.php';

Class Camera {

	public static $verbose = False;
	private $_origin;
	private $_orientation;
	private $_vtc;
	private $_proj;
	private $_tR;
	private $_tT;
	private $_vw;
	private $_w;
	private $_h;
	private $_ratio;

	 static function doc() {
		return file_get_contents( 'Camera.doc.txt' );
	 }

	public function __construct( array $kwargs ) {
		$this->_origin = $kwargs['origin'];
		$this->_vtc = new Vector( array( 'dest' => $this->_origin ) );
		$this->_tT = new Matrix( array( 'preset' => Matrix::TRANSLATION, 'vtc' => $this->_vtc->opposite() ) );
		$this->_orientation = $kwargs['orientation'];
		$this->_tR = $this->_orientation->sym();
		$this->_vw = $this->_tR->mult( $this->_tT );
		$this->_h = (float)$kwargs['height'] / 2;
		$this->_w = (float)$kwargs['width'] / 2;
		if ( isset( $kwargs['ratio'] ) )
			$this->_ratio = $kwargs['ratio'];
		else
			$this->_ratio = $this->_w / $this->_h;
		$this->_proj = new Matrix( array( 'preset' => Matrix::PROJECTION, 'fov' => $kwargs['fov'], 'ratio' => $this->_ratio, 'near' => $kwargs['near'], 'far' => $kwargs['far'] ) );
		if ( self::$verbose === True )
			print( 'Camera instance constructed' . PHP_EOL);
	}

	public function __destruct() {
		if (self::$verbose === True)
			print( 'Camera instance destructed' . PHP_EOL);
	}

	public function __toString() {
		$tmp = "Camera( \n";
		$tmp .= "+ Origine: ".$this->_origin."\n";
		$tmp .= "+ tT:\n".$this->_tT."\n";
		$tmp .= "+ tR:\n".$this->_tR."\n";
		$tmp .= "+ tR->mult( tT ):\n".$this->_vw."\n";
		$tmp .= "+ Proj:\n".$this->_proj."\n)";
		return ($tmp);
	}
	
	public function watchVertex( Vertex $worldVertex ) {
		$vtx3d = $this->_vw->transformVertex( $worldVertex );
		$vtx2d = $this->_proj->transformVertex( $vtx3d );
		$vtx = setX( $vtx2d->getX() * $this->_ratio );
		$vtx = setY( $vtx->getY() );
		$vtx = setColor( $worldVertex->getColor() );
	}
}

?>
