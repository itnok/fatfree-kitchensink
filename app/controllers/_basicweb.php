<?php

namespace controllers {
	
	class _basicweb extends _basic {
	
		protected
			$jsInclude;		//	JavaScript sources to include specific functionalities
			                //  for the current controller/view


        //
        //  The Constructor
        //

		function __construct() {
			
			//
			//	Call the basic contructor
			//
			//	NOTE: The DB connection is configured there!
			//

			parent::__construct();



		    //
		    //	Verify the presence of controller specific Js
		    //	AND
		    //	whether they are minified
		    //
		
		    $this->jsInclude = array();
		
		    if( ! DEBUG
		     && file_exists( APP_DIR . '/lib/js/' . $this->ctrlName . '.min.js' ) ) {
		    	$this->jsInclude[] = 'lib/js/' . $this->ctrlName . '.min.js';
		    } elseif( file_exists( APP_DIR . '/lib/js/' . $this->ctrlName . '.js' ) ) {
		    	$this->jsInclude[] = 'lib/js/' . $this->ctrlName . '.js';
		    }

		}
		
	

        //
        //  Generic action method
        //

		public function action( $action = null ) {

			//
			//	if $action is NULL defautl to __FUNCTION__
			//

			if( empty( $action ) ) {
				$action = __FUNCTION__;  // !!! THIS IS ALWAYS "action"
			}
			$action = ucfirst( strtolower( $action ) );



		    //
		    //	Verify the presence of action specific Js
		    //	AND
		    //	whether they are closure compiled
		    //
		
		    if( ! DEBUG
		     && file_exists( APP_DIR . '/lib/js/' . $this->ctrlName . $action . '.min.js' ) ) {
		    	$this->jsInclude[] = 'lib/js/' . $this->ctrlName . $action. '.min.js';
		    } elseif( file_exists( APP_DIR . '/lib/js/' . $this->ctrlName . $action . '/'. $this->ctrlName . $action . '.js' ) ) {
		    	$this->jsInclude[] = 'lib/js/' . $this->ctrlName . $action . '.js';
		    }



            //
            //  Call the parent's method
            //

		    parent::action( $action );
		    
		}

	}
	
}
