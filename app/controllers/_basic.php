<?php

namespace controllers {
	
	class _basic {
	
		protected
			$f3,			//	Instance of Fat Free Framework
			$db,			//	Instance of DB connection
			$ctrlName,		//	Stores the controller name 
            $layout;		//	The name of the template layout file to render



        //
        //  The Constructor
        //

		function __construct() {
			
			//
			//	Retrive the Fat Free Instance
			//

			$this->f3 = \Base::instance();
			
			
			//
			//	Create the DB Connection Instance
			//

			$this->db = new \DB\SQL(
	            'mysql:host='   . $this->f3->get( 'DB_HOST' ) .
	                 ';port='   . $this->f3->get( 'DB_PORT' ) .
	                 ';dbname=' . $this->f3->get( 'DB_NAME' ),
				$this->f3->get( 'DB_USER' ),
				$this->f3->get( 'DB_PSWD' )
			);



			//
			//	Save the name of the class for later use
			//

			$this->ctrlName = $this->__toString();



			//
			//	Set the current view UI layout to null string
			//

			$this->layout = '';

		}
		
	

        //
        //  Convert the object to a string
        //
        //  In this very case it return the class name
        //

		public function __toString() { 
			$className = explode( '\\', get_class( $this ) );
			return end( $className ); 
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
		    //	Export variables to the view template
		    //

		    $this->f3->set( 'appName',      APP_NAME        );
		    $this->f3->set( 'ctrlName',     $this->ctrlName );



			//
			//	Verify the presence of specific layout
			//

			$ui = $this->f3->get( 'UI' );

		    if( ( empty( $this->layout )
		     || ! file_exists( APP_DIR . '/' . $ui . $this->layout . '.phtml' ) )
		     && file_exists( APP_DIR . '/' . $ui . $this->ctrlName . '/' . strtolower( $action ) . '.phtml' ) ) {
				$this->layout = $this->ctrlName . '/' . strtolower( $action );
			}



		    //
		    //	Render the view template
		    //

		    echo \View::instance()->render(  ( ! empty( $this->layout ) ? $this->layout : '_default' ) . '.phtml' );
		}



        //
        //  Default Index method
        //

		public function index() {
	
			$this->action( 'index' );

		}

	}
	
}
