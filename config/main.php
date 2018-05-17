<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 28.11.2017
 * Time: 13:57
 */

        Config::set( 'site_name', 'Your site Name' );

        Config::set( 'languages', array('en', 'ru', 'ua') );

        // Routes. Route name => method prefix

        Config::set( 'routes', array(
            'default' => '',
            'admin' => 'admin_'
        ) );

        // Set global default settings to mvc

        Config::set( 'default_route', 'default' );

        Config::set( 'default_language', 'ru' );

        Config::set( 'default_controller', 'home' );

        Config::set( 'default_action', 'index' );

        // Make connection to DB Server

        Config::set('db.host', '127.0.0.1');

        Config::set('db.user', 'root');

        Config::set('db.password', 'mysql');

        Config::set('db.name', 'mvc');

        Config::set('salt', 'hjjht4Oiybmn@#hjg%662hg');