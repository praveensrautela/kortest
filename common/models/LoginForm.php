<?php

namespace	common\models;

use	Yii;
use	yii\base\Model;

class	LoginForm	extends	Model	{

		public	$user_name;
		public	$password;
		public	$rememberMe	=	true;
		private	$_user	=	false;
		public	$returnUrl;

		public	function	rules()	{
				return	[
								// name and password are both required
								[['user_name',	'password'],	'required'],
								// rememberMe must be a boolean value
								['rememberMe',	'boolean'],
								// password is validated by validatePassword()
								['password',	'validatePassword'],
				];
		}

		public	function	validatePassword($attribute,	$params)	{
				if	(!$this->hasErrors())	{
						$user	=	$this->getUser();
						if	(!$user	||	!$user->validatePassword($this->password))	{
								$this->addError($attribute,	'Incorrect username or password.');
						}
				}
		}

		public	function	login()	{
				if	($this->validate())	{
						return	Yii::$app->user->login($this->getUser(),	$this->rememberMe	?	3600	*	24	*	30	:	0);
				}	else	{
						return	false;
				}
		}

		public	function	getUser()	{
//        echo $this->user_name;die;
				if	($this->_user	===	false)	{
						$username	=	$this->user_name;
						$this->_user	=	User::findByUsername($username);
				}
				return	$this->_user;
		}

}
