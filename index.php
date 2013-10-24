<?php

//
//  Configure the environment
//

$appMode = getenv( 'APPMODE' );

if( ! defined( 'ENT_SUBSTITUTE' ) ) {
    define( 'ENT_SUBSTITUTE', 0 );
}



//
//  Load the Fat Free Framework
//

$f3 = require( 'lib/php/fatfree/base.php' );



//
//  Load the configuration
//

$f3->config( 'app/_config.ini' );



//
//  Load the routes
//

$f3->config( 'app/_routes.ini' );



//
//  Load the AJAX API endpoints
//

$f3->config( 'app/_ajax.ini' );



//
//  Define some usefull constants taking values
//  set in the configuration files
//

define( 'ANALYTICS_CODE', $f3->get( 'ANALYTICS_CODE' ) );
define( 'SALT',           $f3->get( 'SALT'           ) );
define( 'APP_NAME',       $f3->get( 'APP_NAME'       ) );
define( 'APP_DOMAIN',     $f3->get( 'APP_DOMAIN'     ) );
define( 'APP_DIR',        __DIR__                      );
define( 'WEB_DIR',        $f3->get( 'WEB_DIR'        ) );
define( 'AUTHOR',         $f3->get( 'AUTHOR'         ) );
define( 'DEBUG',          ( ! empty( $appMode )
                                ? ( $appMode == 'development'
                                    ? true
                                    : false )
                                : false              ) );



//
//  Set error reporting
//

if( DEBUG ) {
    //  Turn on error reporting in DEBUG mode
    error_reporting( E_ALL & ~E_NOTICE );
    ini_set( 'display_errors', 'On' );
} else {
    //  ...otherwise SHUT UP!
    error_reporting( 0 );
    ini_set( 'display_errors', 'Off' );
}



//
//  What should we do in case of error???
//

if( ! DEBUG ) {
    
    //
    //  Redirect to the homepage only if in production
    //

    $f3->set(
        'ONERROR',
        function( $f3 ) {
            
            //
            //  Reroute to the homepage if it's not an AJAX request
            //

            if( ! $f3->get( 'AJAX' ) ) {

                $f3->reroute( '/' );

            }
        }
    );
    
}



//
//  Enable caching ONLY in production
//

$cache = \Cache::instance();

$isCacheActive = ( ! DEBUG ? true : false );

$cache->load( $isCacheActive );



//
//  Let's begin the rock'n'roll
//

$f3->run();
