<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    //...

    //Add custom components (DebugKit, SQLLog)
    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
            'authorize' => array('Controller')
            ),
        'DebugKit.Toolbar' => array('autoRun' => false),
	    'SQLLog'
    	//'RequestHandler'
    );

    //Use Bootstrap HTML helper components
	public $helpers = array(
        'Session',
        'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
        'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
        'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),
    );


public function isAuthorized($user) {
    //Use OpenID authentication instead
    return true;
}

public function beforeFilter() {
    //Launch OpenID authentication
	$this->Auth->allow(array('controller' => 'pages', 'action' => 'display'));

	$this->set('who', $this->Auth->user('username'));
	$this->SQLLog->LogEvent();
    }
}
