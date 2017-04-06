<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('session','form_validation'));
		$this->load->helper(array('url','form'));
		
        $this->pbase = array(0,1,2,3,4,5,6,7,8,9);
        $this->pbasep = array('00','11','22','33','44','55','66','77','88','99');
        $this->tciclos = 0;
        $this->presultado = array();
        $this->limity = FALSE;

        
	}

	public function index($x = 1, $y = 1000000)
	{


		if( !is_numeric($x) || !is_numeric($y)){
			$x = 1;
			$y = 1000000;

		}

				

		if($x < 1){
			$x = 1;
		}

		if($y < 1){
			$y = 1;
		}

		$yc = strlen($y);


		for ($i = 1; $i <= $yc; $i++) {

				if($this->limity){
					break 1;

				}



			$this->creap($i,$x,$y);


		}

			$data['palindrome'] = $this->presultado;
			$data['total_palindrome'] = count($this->presultado); 
			$data['cycles'] = $this->tciclos;
			$data['x'] = $x;
			$data['y'] = $y;


			header('Content-Type: application/json');
    		echo json_encode( $data );


			
	}


	public function creap($j,$x,$y){

		/*Construyó los palíndromos posible para números decimale y compruebo si son palíndromos en binario,
		 si lo son, los agrego a la respuesta 
		*/

		
		if( $j % 2 == 0 ){
			$plocalbase = $this->pbasep;
			
		}else{
			$plocalbase = $this->pbase;
		}
		$pnuevabase = array();

		if($j == 1 || $j == 2){
			foreach ($plocalbase as $key => $value) {
				$this->tciclos++;
				if($value > $y){
					$this->limity = TRUE;
					break 1;
				}

				
				array_push($pnuevabase,$value);
				$palibin = decbin($value);
				if($palibin == strrev($palibin) && $value != '00' && $value >= $x && $value <= $y){
					array_push($this->presultado,$value); 

				}

			
			}
				

		}else{
			foreach ($plocalbase as $key => $value) {
				for($i=1; $i<=9; $i++){
					$this->tciclos++;
					$nuevop = intval($i . $value . $i);
					if($nuevop > $y){
						$this->limity = TRUE;
						break 2;
					}
					array_push($pnuevabase,$nuevop);

					$palibin = decbin($nuevop);
					if($palibin == strrev($palibin) &&  $nuevop >= $x && $nuevop <= $y){
						array_push($this->presultado,$nuevop); 
						//echo " * " . $value . " - " . $nuevop;
					} 

					


				}
				

			
			}

				
		}


		
		if( $j % 2 == 0 ){
			$this->pbasep = $pnuevabase; 
			
		}else{
			$this->pbase = $pnuevabase;
		}


	}

	
}
