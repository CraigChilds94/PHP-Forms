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
	# Version: 0.0.1                                     #
	# http://licence.visualidiot.com/                    #
	######################################################

class Form {
	/* Form::start('POST', '') */
	public static function start($method = 'GET', $action = '', $id ='', $class = '') {
		echo '<form method="' . $method . '" action="' . $action . '" id="'. $id .'" class="'. $class .'">';
	}
	
	/* Form::end() */
	public static function end() {
		echo '</form>';
	}
	
	/* Form::dropdown(array('hello' => 'value', 'is' => 'value', 'it' => 'value', 'me' => 'value', 'you're' => 'value', 'looking' => 'value', 'for' => 'value'), '') */
	public static function dropdown($items, $name = 'dropdown', $id ='', $class = '') {
		
		echo '<select name="' . $name . '"id="'. $id .'" class="'. $class .'">';
		foreach($items as $item => $value){
			echo '<option value="' . (empty($value) ? $item : $value) . '">';
			echo $item;
			echo '</option>';
		}
		
		echo '</select>';
	}

	/* Form::textarea('mytextarea', 'This already appears in the box') */
	public static function textarea($name = 'textarea', $contents = '', $id ='', $class = '') {
		echo '<textarea name="' . $name . '"id="'. $id .'" class="'. $class .'">' . $contents . '</textarea>';
	}
	
	/* Form::input('mytextbox', 'this is already in it', 'the name of the input', 'my placeholder', 'myid', 'class') */
	public static function input($type = 'text', $value = '', $name = '', $placeholder = '' , $id ='', $class = '') {
		echo '<input type="' . $type . '" name="' . $name  . '" placeholder="' . $placeholder . '" id="'. $id .'" class="'. $class .'" value="' . $value . '">';
	}
	
	/* Form::submit('thenameofmybutton', 'Submit value') */
	public static function submit($name = 'submit', $value = 'Submit', $id ='', $class = '') {
		echo '<input type="submit" name="' . $name . '"  value="' . $value . '"  id="'. $id .'" class="'. $class .'">';
	}
	
	public static function password($name = 'password', $value = '', $placeholder = 'Enter your password here', $id = '', $class =''){
		self::input('password', $value, $name, $placeholder, $id, $class);
	}
	
	public static function login($action = '', $id = '', $class = '', $breaks = false){
		self::start('POST', $action, $id, $class);
			 self::input('text', '', 'login', 'Type your username here');
		     echo ($breaks ? '<br>' : '');
		     self::password('password', '', 'Type your password here');
	         echo ($breaks ? '<br>' : '');
		     self::submit();
	     self::end();
	}
}