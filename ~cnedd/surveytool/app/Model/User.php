<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'username';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'An email must be included',
				'required' => true,
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'A valid email address was not supplied',
				'required' => true,
			),
			'userdefined' => array(
				'rule' => array('approvedEmail'),
				'message' => 'The supplied email is not approved',
				'required' => true,
			),
		),
		'openid' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'An OpenId must be supplied',
			),
		),
		'admin' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Admin privliges is a boolean value',
			),
		),
	);


   public function approvedEmail($check) {
	$email = $check['username'];
        $pos = strpos($email, '@thecne.org');
        if ($pos !== false) {
	    return true;
	} else {
	    return false;
	}
   }

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
}
