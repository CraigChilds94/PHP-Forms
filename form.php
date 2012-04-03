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
	# Copyright 2012 Craig Childs                        #
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
	
	/* Form::dropdown(array('hello', 'is', 'it', 'me', 'you're', 'looking', 'for'), '') */
	public static function dropdown($items, $name = 'dropdown', $id ='', $class = '') {
		echo '<select name="' . $name . '"id="'. $id .'" class="'. $class .'">';
		foreach($items as $item){
			echo '<option value="' . $item . '">';
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
}