<?php

	$form_array = [];
	
	$form_array['test-from-ajax'] = array (
		'input' => array(
			'numeric_value' => array(
				
				// type of input| possible: text,radio,checkbox,select
				'type'=>'text', 
				
				//length of string to check and to allow input
				'length'=>4,  
				
				// id of input
				'id'=> 'numeric_value', 
				
				// input name
				'name'=> 'numeric_value', 
				
				// class for input default input_text
				'class'=>'input_text',
				
				// input additional style
				'style'=>'border:1px solid blue',
				
				//input text placeholder
				'placeholder' => 'type over me',
				
				//to show or not to show options| posible:on, off
				'autocomplete' =>'off',
				
				//fill value if neccecery
				'value' =>'22', //bad if placeholder, god with data
				
				//onkeypress
				//'onkeypress' =>'alert_keypress()', 
				
				//onkeyup
				//'onkeyup' =>'alert_onkeyup()', 
				
				// type for php validation | posible: string, numeric, radio,checkbox,select
				'validate'=>'numeric', 
				
				// if input must hold some value for specific name
				'required'=>true, 
				
				// description to display someware on template to describe input
				'description'=>'NUMERIC DESCRIPTION', 
				
				//report to give back by php if js fails
				'report' => 'NUMERIC VALUE IS BAD',
			),
			
			'string_value' => array(
				
				// type of input| possible: text,radio,checkbox,select
				'type'=>'text', 
				
				//length of string to check and to allow input
				'length'=>4,  
				
				// id of input
				'id'=> 'string_value', 
				
				// input name
				'name'=> 'string_value', 
				
				// class for input DEFAULT input_text
				'class'=>'input_text',
				
				// input additional style
				'style'=>'border:1px solid green',
				
				//input text placeholder
				'placeholder' => 'type over me',
				
				//to show or not to show options| posible:on, off
				'autocomplete' =>'off',
				
				//fill value if neccecery
				'value' =>'asd', //bad if placeholder, god with data
				
				//onkeypress
				//'onkeypress' =>'alert_keypress()', 
				
				//onkeyup
				//'onkeyup' =>'alert_onkeyup()', 
				
				// type for php validation | posible: string, numeric, radio,checkbox,select
				'validate'=>'string', 
				
				// if input must hold some value for specific name
				'required'=>true, 
				
				// description to display someware on template to describe input
				'description'=>'STRING DESCRIPTION', 
				
				//report to give back by php if js fails
				'report' => 'STRING STRING VALUE IS BAD 2',
			),
			
			
			
			'date_value' => array(
				
				// type of input| possible: text,radio,checkbox,select
				'type' => 'text', 
				
				//length of string to check and to allow input
				'length' => 10,  
				
				// id of input
				'id' => 'date_value', 
				
				// input name
				'name' => 'date_value', 
				
				// class for input default input_text
				'class' => 'input_text',
				
				// input additional style
				'style' => 'border:1px solid purple',
				
				//input text placeholder
				'placeholder' => 'type over me',
				
				//to show or not to show options| posible:on, off
				'autocomplete' =>'off',
				
				//fill value if neccecery
				'value' =>'12-12-2012', //bad if placeholder, god with data
				
				//onkeypress
				//'onkeypress' =>'alert_keypress()', 
				
				//onkeyup
				//'onkeyup' =>'alert_onkeyup()', 
				
				// type for php validation | posible: string, numeric, radio,checkbox,select
				'validate'=>'date', 
				
				//enter a format for date to validated upon
				'format'=>'d-m-Y',
				
				// if input must hold some value for specific name
				'required'=>true, 
				
				// description to display someware on template to describe input
				'description'=>'DATE DESCRIPTION', 
				
				//report to give back by php if js fails
				'report' => 'STRING DATE VALUE IS BAD',
			),
			
			'email_value' => array(
				
				// type of input| possible: text,radio,checkbox,select
				'type'=>'text', 
				
				//length of string to check and to allow input
				'length'=>50,  
				
				// id of input
				'id' => 'email_value', 
				
				// input name
				'name' => 'email_value', 
				
				// class for input default input_text
				'class' => 'input_text',
				
				// input additional style
				'style' => 'border:1px solid blue',
				
				//input text placeholder
				'placeholder' => 'type over me',
				
				//to show or not to show options| posible:on, off
				'autocomplete' =>'off',
				
				//fill value if neccecery
				'value' =>'asd@asd.com', //bad if placeholder, god with data
				
				//onkeypress
				//'onkeypress' =>'alert_keypress()', 
				
				//onkeyup
				//'onkeyup' =>'alert_onkeyup()', 
				
				// type for php validation | posible: string, numeric, radio,checkbox,select
				'validate'=>'email', 
				
				// if input must hold some value for specific name
				'required'=>true, 
				
				// description to display someware on template to describe input
				'description'=>'email description', 
				
				//report to give back by php if js fails
				'report' => 'STRING EMAIL VALUE IS BAD',
			),
			'textarea' => array(
				
				// type of input| possible: text,radio,checkbox,select
				'type'=>'textarea', 
				
				//length of string to check and to allow input
				'length'=>22,  
				
				// id of input
				'id'=> 'textarea', 
				
				// input name
				'name'=> 'textarea', 
				
				// class for input default input_textarea
				'class'=>'input_textarea',
				
				// input additional style
				'style'=>'border:1px dotted blue',
				
				//input text placeholder
				'placeholder' => 'textarea placeholder',
				
				//to show or not to show options| posible:on, off
				'autocomplete' =>'off',
				
				//fill value if neccecery
				'value' =>'asd asd asd  asd', //bad if placeholder, god with data
				
				//onkeypress
				//'onkeypress' =>'alert_keypress()', 
				
				//onkeyup
				//'onkeyup' =>'alert_onkeyup()', 
				
				// type for php validation | posible: string, numeric, radio,checkbox,select
				'validate'=>'string', 
				
				// if input must hold some value for specific name
				'required'=>true, 
				
				// description to display someware on template to describe input
				'description'=>'textarea description', 
				
				//report to give back by php if js fails
				'report' => 'TEXTAREA VALUE IS BAD',
			),
			'radio_button' => array(
				// type of input| possible: text,radio,checkbox,select
				'type'=>'radio',
				
				// type for php validation | posible: string, numeric, radio,checkbox,select
				'validate'=>'radio',
				
				// if input must hold some value for specific name
				'required'=>true,
				
				// input name
				'name'=> 'radio_button',
				
				// class for input 
				'class'=>'input_radio_checkbox',
				
				// input additional style
				'style' => 'border:1px dotted blue',
				
				// this is description for all radio buttons, can be omitted
				'description'=>'SELECT ONE RADIO BUTTON',
				
				//report to give back by php if js fails to stop 
				'report' => 'RADIO BUTTON BAD',
				
				// all possible radio buttons that can be used by form class to generate button
				'buttons'=>array(
					//button_name_1 is name to be used in template
					'button_name_1' => array(
						//button id given to input tag 
						//and id with prefix label_ is given to label
						'id'=>'button_name_1',
						
						//onclick 
						'onclick'=>'alert_click()',
						
						//label_class 
						'label_class'=>'radio_checkbox_label',
						
						//button_class to be added next to 'class'=>'input_radio',
						'button_class'=>'radio_checkbox_button',

						//text to be placed next to button
						'side_text'=>'button 1 Side text',
						
						//value that button holds
						'value'=>'button_1_value',
						
						//override name for this button
						//'name'=>'button_1_name_overriden',
						
						//value that button holds
						//'checked'=>'checked',
					),
					'button_name_2' => array(
						//button id given to input tag 
						//and id with prefix label_ is given to label
						'id'=>'button_name_2',
						
						//onclick 
						'onclick'=>'alert_click()',
						
						//label_class 
						'label_class'=>'radio_checkbox_label',
						
						//button_class to be added next to 'class'=>'input_radio',
						'button_class'=>'radio_checkbox_button',

						//text to be placed next to button
						'side_text'=>'button 2 Side text',
						
						//value that button holds
						'value'=>'button_2_value',
						
						//override name for this button
						//'name'=>'button_1_name_overriden',
						
						//value that button holds
						'checked'=>'checked',
					)
				),
			),
			
			'checkbox_button' => array(
				// type of input| possible: text,radio,checkbox,select
				'type'=>'checkbox',
				
				// type for php validation | posible: string, numeric, radio,checkbox,select
				'validate'=>'checkbox',
				
				// if input must hold some value for specific name
				'required'=>true,
				
				// input name
				//'name'=> 'checkbox_button[]',
				
				// class for input 
				'class'=>'input_radio_checkbox',
				
				// this is description for all radio buttons, can be omitted
				'description'=>'SELECT ONE CHECKBOX BUTTON',
				
				//report to give back by php if js fails to stop 
				'report' => 'CHECKBOX BUTTON BAD NON ARRAY',
				
				// all possible radio buttons that can be used by form class to generate button
				'buttons'=>array(
					//button_name_1 is name to be used in template
					'button_name_1' => array(
						//button id given to input tag 
						//and id with prefix label_ is given to label
						'id'=>'button_no_array_name_1',
						
						//onclick 
						'onclick'=>'alert_click()',
						
						//label_class 
						'label_class'=>'radio_checkbox_label',
						
						//button_class to be added next to 'class'=>'input_radio',
						'button_class'=>'radio_checkbox_button',

						//text to be placed next to button
						'side_text'=>'button 1 Side text',
						
						//value that button holds
						'value'=>'button_1_value',
						
						//override name for this button
						'name'=>'checkbox_button_1_name_overriden',
						
						//value that button holds
						//'checked'=>'checked',
					),
					'button_name_2' => array(
						//button id given to input tag 
						//and id with prefix label_ is given to label
						'id'=>'button_no_array_name_2',
						
						//onclick 
						'onclick'=>'alert_click()',
						
						//label_class 
						'label_class'=>'radio_checkbox_label',
						
						//button_class to be added next to 'class'=>'input_radio',
						'button_class'=>'radio_checkbox_button',

						//text to be placed next to button
						'side_text'=>'button 2 Side text',
						
						//value that button holds
						'value'=>'button_2_value',
						
						//override name for this button
						'name'=>'checkbox_button_2_name_overriden',
						
						//value that button holds
						'checked'=>'checked',
					),
				),
			),
			
			'checkbox_button_array' => array(
				// type of input| possible: text,radio,checkbox,select
				'type'=>'checkbox',
				
				// type for php validation | posible: string, numeric, radio,checkbox,select
				'validate'=>'checkbox',
				
				// if input must hold some value for specific name
				'required'=>true,
				
				// input name
				'name'=> 'checkbox_button_array[]',
				
				// class for input 
				'class'=>'input_radio_checkbox',
				
				// this is description for all radio buttons, can be omitted
				'description'=>'SELECT CHECKBOX BUTTONS FROM ARRAY checkbox_button_array[]',
				
				//report to give back by php if js fails to stop 
				'report' => 'CHECKBOX BUTTON BAD FROM ARRAY',
				
				// all possible radio buttons that can be used by form class to generate button
				'buttons'=>array(
					//button_name_1 is name to be used in template
					'button_name_1' => array(
						//button id given to input tag 
						//and id with prefix label_ is given to label
						'id'=>'button_array_name_1',
						
						//onclick 
						'onclick'=>'alert_click()',
						
						//label_class 
						'label_class'=>'radio_checkbox_label',
						
						//button_class to be added next to 'class'=>'input_radio',
						'button_class'=>'radio_checkbox_button',

						//text to be placed next to button
						'side_text'=>'button 1 Side text',
						
						//value that button holds
						'value'=>'button_1_value_arr',
						
						//override name for this button
						//'name'=>'checkbox_button_1_name_overriden',
						
						//value that button holds
						//'checked'=>'checked',
					),
					'button_name_2' => array(
						//button id given to input tag 
						//and id with prefix label_ is given to label
						'id'=>'button_array_name_2',
						
						//onclick 
						'onclick'=>'alert_click()',
						
						//label_class 
						'label_class'=>'radio_checkbox_label',
						
						//button_class to be added next to 'class'=>'input_radio',
						'button_class'=>'radio_checkbox_button',

						//text to be placed next to button
						'side_text'=>'button 2 Side text',
						
						//value that button holds
						'value'=>'button_2_value_arr',
						
						//override name for this button
						//'name'=>'checkbox_button_2_name_overriden',
						
						//value that button holds
						'checked'=>'checked',
					),
				),
			),
			
			'input_select' => array(
				
				// type of input| possible: text,radio,checkbox,select
				'type'=>'select',
				
				// id of input
				'id'=> 'input_select',
				
				// input name
				'name'=> 'input_select',
				
				// class for input 
				'class'=>'input_select',
				
				// input additional style
				'style'=>'border:1px dashed purple',
				
				//First unselectable value for slect input that holds no value
				'placeholder' => 'Select something here',
				
				// type for php validation | posible: string, numeric, radio,checkbox,select
				'validate'=>'select',
				
				// if input must hold some value for specific name
				'required'=>true,
				
				//fire js function on change
				//'onchange' => 'select_change()',
				
				
				// this is description for all checkboxes buttons, can be omitted
				'description'=>'Select description',
				
				
				//report to give back by php if js fails to stop 
				'report' => 'SELECT INPUT BAD',
				
				//All posible options of select input are placed in options
				'options'=>array(
					//left is value right is what client sees
					'frist'=>'First option text',
					'second'=>'Second option text',
				),
			),
			
			'file_upload' => array(
				// type of input
				'type'=>'file',
				
				//Size of the file, not to be exceeded
				'length'=>8388608, //8388608
				
				// id of input
				'id'=> 'file_upload',
				
				// input name
				'name'=> 'file_upload',

				// class for input default input_text
				'class' => 'input_file',///input_file_holder_clasic  input_file
				
				// class for input default input_text
				'style' => 'border:2px solid green;width:500px',///input_file_holder_clasic  input_file
				
				// input file text placeholder
				'placeholder' =>'select file',
				
				// type for php validation | posible: string, numeric, radio,checkbox,select
				'validate'=>'file',
				
				//files to allow for this form upload field
				'allowed'=>array('jpg','jpeg','png','pdf'),
				
				// if input must hold some value for specific name
				'required'=>true,

				//report to give back by php if js fails
				'report' => 'FILE IS BAD',
				
			),
			'file_upload_second' => array(
				// type of input
				'type'=>'file',
				
				//Size of the file, not to be exceeded
				'length'=>8388608, //8388608
				
				// id of input
				'id'=> 'file_upload_second',
				
				// input name
				'name'=> 'file_upload_second',

				// class for input default input_text
				'class' => 'input_file',///input_file_holder_clasic  input_file
				
				// input file text placeholder
				'placeholder' =>'select file',
				 
				// type for php validation | posible: string, numeric, radio,checkbox,select
				'validate'=>'file',
				
				//files to allow for this form upload field
				'allowed'=>array('jpg','jpeg','png','pdf'),
				
				// if input must hold some value for specific name
				'required'=>true,

				//report to give back by php if js fails
				'report' => 'FILE IS BAD SECOND',
				
			),
		
		),
		//ID of the whole form	
		'form_id'=>'test_form_ajax_id',
		// name of template that we are going to use for displaying form
		'template'=>'tpl_test_form_ajax',
		
		//form action 
		'action' => 'process_test_form',	
		
		//name of the functio nthat will validate test form
		'js_validator'=>'test_form_validator',
		
		//functio nthat will add additional validation
		'js_additional'=>'test_form_additional_validation',
		
		//send form using async 
		'ajax'=>'ajax_response_handler',
		
		//method
		'method'=>'POST',
	);
	
	
	
	
	
	