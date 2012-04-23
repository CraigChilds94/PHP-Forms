<?php

	######################################################
	# Title: Easy PHP Forms                              #
	#                                                    #
	# Description: This is a PHP static class which can  #
	# be used to easily generate forms. The idea is to   #
	# make developing forms cleaner and tidier and       #
	# making you write less html.                        #
	#                                                    #                    
	# Author: Craig CHILDS                               #
	#                                                    #
	# Version: 0.1.1                                     #
	# http://licence.visualidiot.com/                    #
	######################################################
	

class Form {

	public static $forms, $files, $allows, $where;
	
	//  Prepare some easy arrays already set up for the developer.
	public static $usernameInput = array('name' => 'username', 'type' => 'text', 'placeholder' => 'Type username here.');
	public static $passwordInput = array('name' => 'password', 'type' => 'password', 'placeholder' => 'Type password here.');

	public static function start($options = array('name' => 'default', 'action' => '', 'method' => 'GET')) {
		echo '<!-- START OF ' . strtoupper($options['name']) . ' FORM -->';
		if(is_array($options)){
			echo self::_generateTag('form', $options);
				
			//  Store the form in an array.
			self::$forms[] = array('name' => (!empty($options['name']) ? $options['name'] : "default"), 'method' => (!empty($options['method']) ? $options['method'] : 'GET'));
			
			//  Store the files in the class
			if(!empty($_FILES)){
				self::$files = $_FILES['file'];
			}
		}else{
			echo 'Error: The first parameter of this method takes an array.';
		}
	}
	
	/* Form::end() */
	public static function end() {
		echo '</form>';
		echo '<!-- END OF FORM -->';
	}
	
	public static function dropdown($items, $options = array()) {
		echo self::_generateTag('select', $options);
		
		//  Generate an option on the dropdown for every item in the items array.
		foreach($items as $item => $value){
			echo '<option value="' . (empty($value) ? $item : $value) . '">';
			echo $item;
			echo '</option>';
		}
		
		echo '</select>';
	}

	public static function textarea($options = array(), $contents = '') {
		echo self::_generateTag('textarea', $options, $contents);
	}
	
	public static function input($options = array('type' => 'text')) {
		echo self::_generateTag('input', $options);
	}
	
	public static function submit($options = array('value' => 'submit', 'type' => 'submit')) {
		echo self::_generateTag('input', $options);	}
	
	/* Form::password();  */
	public static function password($options = array('name' => 'password', 'type' => 'password')){
		self::input($options);
	}
	
	/* Form::login(); */
	public static function login($name = 'login', $action = '', $id = '', $class = '', $breaks = false){
		// Generate a login form
		self::start(array('name' => $name, 'method' => 'POST', 'enctype' => "multipart/form-data", "action" => $action));
			 self::input(array('type' => 'text', 'name' => 'username', 'placeholder' => 'Type your username here'));
		     echo ($breaks ? '<br>' : '');
		     self::password(array('placeholder' => 'Type your password here'));
	         echo ($breaks ? '<br>' : '');
		     self::submit();
	    self::end();
	}
	
	public static function set($type, $key, $value){
		//  Save ourselves from checking both uppercase and lowercase
		$type = strtolower($type);
		
		if(!empty($type) && !empty($key) && !empty($value)){
			return $type[$key] = $value;
		}
		
		return array('Error' => 'You are trying to set nothing.');
	}
	
	public static function getInputType($name){
		if(!empty(self::$forms)){
			foreach(self::$forms as $form){
				if(!empty($form[$name])){
					return $form[$name];
				}
			}
		}
		
		return array('error' => 'There is no form by that name, or you have not declared a request type. e.g.(POST, GET, REQUEST)');
	}
	
	public static function listforms(){
		//  If there are forms loop through and echo with a line break
		if(!empty(self::$forms)){
			foreach(self::$forms as $form){
				if(!empty($form)){
					echo $form  . '<br>';
				}
			}
		}else{
			//  Otherwise throw error.
			echo 'You do not have any forms on this page.';
		}
	}
	
	public static function upload($name = 'upload', $where, $allows, $action = ''){
		//  Display the form
		self::start(array('name' => $name, 'method' => 'POST', 'enctype' => "multipart/form-data", "action" => $action));
			self::input(array('type' => 'file', 'name' => 'file'));
			self::submit();
		self::end();
		
		// Do all of our logic if we want it to be done on this page
		if($action == ''){
			if(isset($_POST) && !empty(self::$files)){
				if(self::_isAllowed($allows)){
					self::_moveFile($where);
				}else{
					echo 'That file type is not allowed!';
				}
			}
		}else{
			//  This means that we are moving the file on another page, so store our stuff
			self::$allows = $allows;
			self::$where = $where;
		}
	}
	
	/* Use this if you want the logic to take place on a different page. */
	public static function receiveFile(){
		// Do the logic from a global point of view
		if(isset($_POST) && !empty(self::$files) && !empty(self::$allows) && !empty(self::$where)){
			if(self::_isAllowed(self::$allows)){
				self::_moveFile(self::$where);
			}else{
				echo 'That file type is not allowed!';
			}
		}else{
			echo 'Somethings that are required were not set. e.g. (POST, $_FILES, Global file data)';
		}
	}
	
	private static function _isAllowed($allows){
		//  Return true if file type is in the array.
		return in_array(self::$files['type'], $allows);
	}
	
	private static function _moveFile($where){
		//  Move our file
		return move_uploaded_file(self::$files["tmp_name"], (empty($where) ? '' : $where) . self::$files["name"]);
	}
	
	private static function _generateTag($tag, $options, $content = ''){
		//  Store the different tag syntax elements
		$varied = array('button', 'textarea');
		
		$out = '<' . $tag . ' ';
		
		//  fill the tag with our options
		foreach ($options as $key => $value) {
			$out .= $key . '="' . $value . '" ';
		}
		
		//  If its not on the varied syntax array just close, else close the appropriate way
		if(!in_array($tag, $varied)){
			$out .= '>';
		}else{
			$out .=  '>' . (in_array($tag, $varied) ? $options['value'] : '') . '</' . $tag . '>';
		}
		
		return $out;
	}
}
