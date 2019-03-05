<?php

Class Matrix {

	public static $verbose = False;
	const IDENTITY = 'IDENTITY';
	const SCALE = 'SCALE preset';
	const RX = 'Ox ROTATION preset';
	const RY = 'Oy ROTATION preset';
	const RZ = 'Oz ROTATION preset';
	const TRANSLATION = 'TRANSLATION preset';
	const PROJECTION = 'PROJECTION preset';
	protected $matrix = array();
	
	 static function doc() {
		return file_get_contents('Matrix.doc.txt');
	 }

	public function __construct( array $kwargs = null) {
		for ($i = 0; $i < 16; $i++) {
			$this->matrix[$i] = 0;
		}
		if ( $kwargs['preset'] == self::IDENTITY ) {
			$this->matrix[0] = 1;
			$this->matrix[5] = 1;
			$this->matrix[10] = 1;
			$this->matrix[15] = 1;
		}
		else if ( $kwargs['preset'] == self::SCALE && isset( $kwargs['scale'] ) ) {
			$this->matrix[0] = $kwargs['scale'];
			$this->matrix[5] = $kwargs['scale'];
			$this->matrix[10] = $kwargs['scale'];
			$this->matrix[15] = 1;
		}
		else if ( $kwargs['preset'] == self::RX && isset( $kwargs['angle'] ) ) {
			$this->matrix[0] = 1;
			$this->matrix[5] = cos( $kwargs['angle'] );
			$this->matrix[6] = - sin( $kwargs['angle'] );
			$this->matrix[9] = sin( $kwargs['angle'] );
			$this->matrix[10] = cos( $kwargs['angle'] );
			$this->matrix[15] = 1;
		}
		else if ( $kwargs['preset'] == self::RY && isset( $kwargs['angle'] ) ) {
			$this->matrix[0] = cos( $kwargs['angle'] );
			$this->matrix[2] = sin( $kwargs['angle'] );
			$this->matrix[5] = 1;
			$this->matrix[8] = - sin( $kwargs['angle'] );
			$this->matrix[10] = cos( $kwargs['angle'] );
			$this->matrix[15] = 1;
		}
		else if ( $kwargs['preset'] == self::RZ && isset( $kwargs['angle'] ) ) {
			$this->matrix[0] = cos( $kwargs['angle'] );
			$this->matrix[1] = - sin( $kwargs['angle'] );
			$this->matrix[4] = sin( $kwargs['angle'] );
			$this->matrix[5] = cos( $kwargs['angle'] );
			$this->matrix[10] = 1;
			$this->matrix[15] = 1;
		}
		else if ( $kwargs['preset'] == self::TRANSLATION && isset( $kwargs['vtc'] )) {
			$vtc = $kwargs['vtc'];
			$this->matrix[0] = 1;
			$this->matrix[5] = 1;
			$this->matrix[10] = 1;
			$this->matrix[15] = 1;
			$this->matrix[3] = $vtc->getX();
			$this->matrix[7] = $vtc->getY();
			$this->matrix[11] = $vtc->getZ();
		}
		else if ( $kwargs['preset'] == self::PROJECTION && isset( $kwargs['fov'] ) && isset( $kwargs['ratio'] ) && isset( $kwargs['near'] ) && isset( $kwargs['far'] ) ) {
            $this->matrix[5] = 1 / tan( 0.5 * deg2rad( $kwargs['fov'] ) );
            $this->matrix[0] = $this->matrix[5] / $kwargs['ratio'];
            $this->matrix[10] =  ($kwargs['near'] + $kwargs['far']) / ($kwargs['near'] - $kwargs['far']);
            $this->matrix[14] = -1;
            $this->matrix[11] = (2 * $kwargs['near'] * $kwargs['far']) / ($kwargs['near'] - $kwargs['far']);
		}
		if ( self::$verbose === True && isset( $kwargs['preset'] ) ) {
			print( 'Matrix ' . $kwargs['preset'] . ' instance constructed' . PHP_EOL );
		}
	}

	public function __destruct() {
		if (self::$verbose === True)
			print( 'Matrix instance destructed' . PHP_EOL);
	}

	public function __toString() {
		$tmp = "M | vtcX | vtcY | vtcZ | vtxO\n";
		$tmp .= "-----------------------------\n";
		$tmp .= "x | %0.2f | %0.2f | %0.2f | %0.2f\n";
		$tmp .= "y | %0.2f | %0.2f | %0.2f | %0.2f\n";
		$tmp .= "z | %0.2f | %0.2f | %0.2f | %0.2f\n";
		$tmp .= "w | %0.2f | %0.2f | %0.2f | %0.2f";
		return (vsprintf($tmp, array($this->matrix[0], $this->matrix[1], $this->matrix[2], $this->matrix[3], $this->matrix[4], $this->matrix[5], $this->matrix[6], $this->matrix[7], $this->matrix[8], $this->matrix[9], $this->matrix[10], $this->matrix[11], $this->matrix[12], $this->matrix[13], $this->matrix[14], $this->matrix[15])));
	}
	
	public function mult( Matrix $rhs ) {
		$tmp = array();
		for ($i = 0; $i < 16; $i += 4) {
			for ($j = 0; $j < 4; $j++) {
				$tmp[$i + $j] = 0;
				for ($k = 0; $k < 4; $k++)
					$tmp[$i + $j] += $this->matrix[$i + $k] * $rhs->matrix[$j + 4 * $k];
			}
		}
		$matrice = new Matrix();
		$matrice->matrix = $tmp;
		return $matrice;
	}
	
	public function transformVertex( Vertex $vtx ) {
		$tmp = array();
		 $tmp['x'] = ($vtx->getX() * $this->matrix[0]) + ($vtx->getY() * $this->matrix[1]) + ($vtx->getZ() * $this->matrix[2]) + ($vtx->getW() * $this->matrix[3]);
		 $tmp['y'] = ($vtx->getX() * $this->matrix[4]) + ($vtx->getY() * $this->matrix[5]) + ($vtx->getZ() * $this->matrix[6]) + ($vtx->getW() * $this->matrix[7]);
		 $tmp['z'] = ($vtx->getX() * $this->matrix[8]) + ($vtx->getY() * $this->matrix[9]) + ($vtx->getZ() * $this->matrix[10]) + ($vtx->getW() * $this->matrix[11]);
		 $tmp['w'] = ($vtx->getX() * $this->matrix[12]) + ($vtx->getY() * $this->matrix[13]) + ($vtx->getZ() * $this->matrix[14]) + ($vtx->getW() * $this->matrix[15]);
		 $vertex = new Vertex($tmp);
		 return $vertex;
	}

	public function sym() {
		$tmp = array();
		$tmp[0] = $this->matrix[0];
		$tmp[1] = $this->matrix[4];
		$tmp[2] = $this->matrix[8];
		$tmp[3] = $this->matrix[12];
		$tmp[4] = $this->matrix[1];
		$tmp[5] = $this->matrix[5];
		$tmp[6] = $this->matrix[9];
		$tmp[7] = $this->matrix[13];
		$tmp[8] = $this->matrix[2];
		$tmp[9] = $this->matrix[6];
		$tmp[10] = $this->matrix[10];
		$tmp[11] = $this->matrix[14];
		$tmp[12] = $this->matrix[3];
		$tmp[13] = $this->matrix[7];
		$tmp[14] = $this->matrix[11];
		$tmp[15] = $this->matrix[15];
		$matrice = new Matrix();
		$matrice->matrix = $tmp;
		return $matrice;
	}
}

?>
