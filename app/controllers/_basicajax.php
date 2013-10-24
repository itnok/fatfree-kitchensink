<?php

namespace controllers {
	
	class _basicajax extends _basic {
	
		protected
			$ajaxData;		//	Varaible to hold AJAX data



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
		    //	Set default ajaxData value
		    //
		
		    $this->ajaxData = NULL;
		


		    //
		    //	Set default layout to _ajax.phtml
		    //
		
		    $this->layout = '_ajax';
		
		}
		
	

        //
        //  Generic action method
        //

		public function action( $action = null ) {

		    //
		    //	Export variables to the view template
		    //

		    $this->f3->set( 'ajaxData', $this->ajaxData );



            //
            //  Call the parent's method
            //

		    parent::action( $action );
		    
		}

	}
	
}
