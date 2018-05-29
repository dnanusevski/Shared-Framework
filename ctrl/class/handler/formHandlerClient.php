<?php
namespace handler;
/*
* Class formHandlerClient 
* 
* 
* functions:
*   convert_field_to_input
*		Uses php form array key to get array from under that key   
*		using that array it generates one input field
*	generate_form_by_template
*		uses form php array value to get template file and includes that file in function
*		template file then can use array to manipulate in template php file
*   generate_form_validation_script
*		using php array it can generate script that will validate input of user using js
*		take not thet this script will also send data as ajax request if ajax key is set in php array
*/
class formHandlerClient{
	
	private $form_array;

	function __construct(&$form_array){
		$this->form_array = $form_array;
	}
	
	/*
	* This function converts one input filed from form array to input
	* ALL THIS IS BASED ON CREATION OF TEMPLATE FILE
	* This function is used in template files
	* input filed is generated using form array key
	* all else is automatic
	* it takes to parameters
	* field -> php form marray key
	* $button -> if form array key is checkbox or radio, wee need to pass exact button key
	*/
	function gen($field,$button=''){
		//key should be array,
		if(is_array($field)){
			
			//FIRST PICK UP VALUES COMMON FOR ALL INPUTS
			
			//get type or return ''
			if(isset($field['type'])) 
				$type = 'type = "'.$field['type'].'"'; else $type='';
			
			//get length or return''
			if(isset($field['length'])) 
				$length = 'maxlength = "'.$field['length'].'"'; else $length='';
			
			//get id or return ''
			if(isset($field['id'])) 
				$id = 'id = "'.$field['id'].'"'; else $id='';
			
			//get name or return ''
			if(isset($field['name'])) 
				$name = 'name = "'.$field['name'].'"'; else {$name='';$field['name']='';};
			
			//get class or return ''
			if(isset($field['class'])) 
				$class = 'class="'.$field['class'].'"'; else $class='';
			
			//get style or return ''
			if(isset($field['style'])) 
				$style = 'style = "'.$field['style'].'"'; else $style='';
			
			//get placeholder or return ''
			if(isset($field['placeholder'])) 
				$placeholder = 'placeholder = "'.$field['placeholder'].'"'; else $placeholder='';
			
			//get autocomplete or return ''
			if(isset($field['autocomplete'])) 
				$autocomplete = 'autocomplete = "'.$field['autocomplete'].'"'; else $autocomplete='';
			
			//get value or return ''
			if(isset($field['value'])) 
				$value = 'value = "'.$field['value'].'"'; else $value='';
			
			//get onkeypress or return ''
			if(isset($field['onkeypress'])) 
				$onkeypress = 'onkeypress = "'.$field['onkeypress'].'"'; else $onkeypress='';
			
			//get onkeypress or return ''
			if(isset($field['onkeyup'])) 
				$onkeyup = 'onkeyup = "'.$field['onkeyup'].'"'; else $onkeyup='';
			
			
			//STAT OF INPUT GENERATION
			if($field['type'] == 'text' || $field['type'] == 'password'){
				if($class == '') $class = 'class = "input_text"';
				
				echo '<input '.$autocomplete.' '.$style.' '.$type.' '.$length.' '.$id.' '.$name.' '.$class.' '.$placeholder.' '.$value.' '.$onkeypress.' '.$onkeyup.'>';
			}
			else if($field['type'] == 'textarea'){
				
				if($class == '') $class = 'class = "input_textarea"';
				
				if(isset($field['value'])) 
					$value = $field['value']; else $value='';
				echo '<textarea '.$autocomplete.' '.$style.' '.$type.' '.$length.' '.$id.' '.$name.' '.$class.' '.$placeholder.'  '.$onkeypress.' >'.$value.'</textarea>';
			}
			//else if input is chekcbox or radio
			else if($field['type'] == 'radio' OR $field['type'] == 'checkbox'){
				
					//get class or return ''
				if(isset($field['class'])) 
					$class = $field['class']; else $class='input_radio_checkbox';
				
				//check if form array holds buttons key
				if(isset($field['buttons'][$button]) AND is_array($field['buttons'][$button])){
					// if it does get button with specific key that is provided as argument
					// as argument to parameter button
					$cur_button_array = $field['buttons'][$button];
					$label_id = '';
					// get asked button id
					// else set id of button label same as button id 
					// but with prefix label_
					// this is neccecery in order for js validator function to target label
					// and to collect label color as weel as to color label 
					// if radio otr checkbox is neccecery to be selected
					if(isset($cur_button_array['id'])){
						$id = 'id = "'.$cur_button_array['id'].'"';
						$label_id = 'id = "label_'.$cur_button_array['id'].'"';
					}
					
					// if button has onclick event add it to input
					if(isset($cur_button_array['onclick'])) {
						$onclick = 'onclick = "'.$cur_button_array['onclick'].'"'; 
					}
					else $onclick = '';	

					//collect label class for button labal
					// button itself can not bee seen
					if(isset($cur_button_array['label_class'])){
						$label_class = 'class="'.$cur_button_array['label_class'].'"';
					} else $label_class = 'radio_checkbox_label';
					
					if(isset($cur_button_array['button_class'])){
						$button_class = $cur_button_array['button_class'];
					} else $button_class = 'radio_checkbox_button';

					//collect asked button side text (text next to button)						
					if(isset($cur_button_array['side_text'])){
						$side_text = $cur_button_array['side_text']; 	
					} else $side_text = '';
					
					//collect asked button value to be sent to server if selected
					if(isset($cur_button_array['value']))
						$value = 'value = "'.$cur_button_array['value'].'"';
					
					//and at the end collect asked butto nname to be set in $_POST
					if(isset($cur_button_array['name'])){
						$name = 'name = "'.$cur_button_array['name'].'"';
					}
					if(isset($cur_button_array['checked']) AND $cur_button_array['checked']){
						$checked = 'checked';
					} else $checked = '';

				}
				if(isset($field['name']))
					$label_for = $field['name'];
				if(isset($cur_button_array['name']))
					$label_for = $cur_button_array['name'];
				
				//now that we have collected neccecery data wee generate asked button
				//in a way that everything is inside div element with specific class
				//this part is a bit messy sorry
				//then we put input witch is hidden by default
				//and after that we put label with two spans 
				//inside label is side text to be displayd after button
				//button is actualy represented as with it's label
				echo '<div class=" '.$class.' '.$button_class.'"  '.$style.'>';
				echo '<input '.$id.' '.$type.' '.$name.' '.$onclick.' '.$value.' '.$checked.' ><label    for = "'.$label_for.'" >';
				echo '<span><span></span></span>&nbsp</label><span '.$label_class .' '.$label_id.' >'.$side_text.'</span>';
				echo '</div>';
			}
			/*
			* Select is straitforward
			* Collect all options if php array options key is set
			* then generate html for select with options
			*/
			else if($field['type'] == 'select' ){
				
				if(isset($field['options'])){
					$options = $field['options'];
				
				
				
				
					if(isset($field['placeholder'])) 
						$placeholder = $field['placeholder'];
					
					if(isset($field['onchange']))
						$onchange = 'onchange = "'.$field['onchange'].'"';
					else
						$onchange = '';
					
					// every option has his key and value set under options array
					echo '<select '.$id.' '.$name.' '.$class.' '.$onchange.' '.$style.' >';
						echo '<option  value="" disabled selected>'.$placeholder.'</option>';
						foreach($options as $option_value=>$option_label){
								echo '<option value="'.$option_value.'">'.$option_label.'</option>';
						}
					echo '</select>';
				}
			}
			else if($field['type'] == 'file' ){
				if(isset($field['id']))
					$label_id = 'for="'.$field['id'].'"'; else $label_id='';
				if(isset($field['placeholder'])) 
						$placeholder = $field['placeholder'];
				if(isset($field['id']))
					$file_holder = 'id= "file_holder_'.$field['id'].'"'; else $label_id='';
				
				echo '<div '.$class.' '.$style.' '.$file_holder.' >';
					echo '<input style = "display:none" type="file" '.$name.' '.$id.' class="inputfile inputfile-1"  />';
					echo '<label '.$label_id.' >';
					echo '<svg  width="25" height="17" viewBox="0 0 20 17">';
					echo '<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 
						2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 
						2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 
						1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg>'; 
						echo '<span> '.$placeholder.' </span>';
					echo '</label>';
				echo '</div>';
				echo '<script src="/js/custom-file-input.js"></script>';
			}
			
			
		}
	}
	
	
	/*
	* function generate form by template is center of this CMS
	* every form is template
	* not every template is form
	*/
	function generate_form_by_template($key, &$data = ''){
		
		static $token = null;
		if($token == null){
			$token = rand_str(128);
			set_session('form_token', $token);
		}
		
		
		//static $token = $cache;
		$arr = $this->form_array[$key];

		//IT IS IMPORTANT that al variables that are created here
		// can be accesed on template file
		// get template name
		$input = $arr['input'];
		$template = $arr['template'];
		$ajax = false;
	
		//generate addres by adding _tpl.php sufix at the end,
		// so that we do not have to type that in php form array
		// templates are alwayw in sub folder templates of current script
		$addr = PAGE_URI_TEMPLATES.'/'.$template.'.php';
		
		// get form id to be set in form tag
		if(isset($arr['form_id'])) 
			$form_id = 'id ="'.$arr['form_id'].'"';
		else 
			$form_id = '';
		
		// get method to be set in form tag
		if(isset($arr['method']))  
			$form_method = 'method = "'.$arr['method'].'"';
		else 
			$form_method = 'method = "POST"';
		
		$key = custom_crypt($key,true);
		$loc = custom_crypt(PAGE_URI,true);
		$process_action = custom_crypt($arr['action'],true);

		// get action to be set in form tag
		if(isset($arr['action']))  {
			$form_action = 'action = "'.
			PROCESS_F.
			'key='.$key.
			'&loc='.$loc.'"';
			if(isset($arr['ajax'])){
				$ajax = PROCESS_AJAX_F.''.$process_action.
					'&key='.$key.'&loc='.$loc.'';
			}
		}
			
		else 
			$form_action = '#';
		
		

		//now let's check if js validator is asked to be set
		// if key js_validator holds some value
		// an js function with that name will be created to check if submitd form is valid
		if(isset($arr['js_validator'])) {
			// make shore to remeber js validato function name
			
			$js_validator = $arr['js_validator']; 
			$on_submit_text = 'onsubmit = "return '.$js_validator.'()"';
		}	
		else {
			// else if there is no function asked nothing will be returned on submit
			$js_validator = '';
			$on_submit_text = '';
		}
		
		if(isset($arr['on_submit']) AND !isset($arr['js_validator'])) {
			
			$on_submit_text = $arr['on_submit'];
			$on_submit_text = 'onsubmit = "return '.$on_submit_text.'()"';
		}
		
		//if one of inputs is file input wee need to change enctype to multipart/form data
		$enctype = '';
		foreach ($arr['input'] as $cur_data){
			if(isset($cur_data["validate"])){
				if($cur_data["validate"] == 'file'){
					$enctype='enctype="multipart/form-data"';
				}
			}		
		}
		
		//START FORM TAG
		//echo '<div id = "preload_form_images_div"></div>';//this is under inspection
		echo '<form '.$form_id.'  '.$form_method.' '.$form_action.' '.$on_submit_text.' '.$enctype.'>';
		//INCLUDE template file that has acces to variablres above
		// so that they can be easylu used inside template file
		include($addr);
		
		
		//set session token;
		 
		
		
		echo '<input type = "text" name = "form_token" value = "'.$token.'">';
		//close form tag
		echo '</form>';
		//and now if we asked that this form should be validated with 
		//js we generate validator function
		//NEX LINE IS NECCECERY IF YTO WANT JS TO VALIDATE FORM
		if(isset($arr['js_validator'])) {
			$js_additional = false;
			if(isset($arr['js_additional'])) $js_additional = $arr['js_additional'];
			$this->generate_form_validation_script($arr,$js_validator,$js_additional,$ajax);
		}
	}
	/*
	* It should be fair to explain this generate_form_validation_script
	* First get php form array, and put it in new array without elements that are not fields 
	* Those are elements without array as value
	* Second thing is to create two functions neccecery for validation
	* is_one_radio_selected and is_one_checkbox_selected
	* is_one_radio_selected gets elements by name and see if one of them is selected
	* is_one_checkbox_selected checks same thing using ids array
	* Next create validator array using json encode from php form array
	* collect border color of select and tex input fields
	* collect color of checkbox labels and radio labels
	* save them in specific arrays by id values, so we now to witch color to return if needed
	* Next, go throw array (validator_array_specific_name) and inspect if text, radio, checkbox or select input
	* if text or select and if required then check if empty
	* If checkbox or radio, and if required check using names or ids if at least one is selected
	* if ther is error make it red
	* if it is corrected return to original color using specific id of array :D
	*/
	function generate_form_validation_script($arr,$js_validator,$js_additional = false, $ajax = false, $ajax_content_type = false){
		?>
		<script>
			/*
			* function is_one_radio_selected
			* check to see if one of the radio buttons is selected
			* using get elements by name we retrive all elements with given array
			*/			
			function is_one_radio_selected(name){
				if(document.getElementsByName(name)){
					var elements = document.getElementsByName(name);
					for(var x = 0;x < elements.length;x++){
						if(elements[x].checked)
							return true;
					}
				}
				return false;
			}
			/*
			* Get ell checkbox ids under one form array
			* then go throw all of them and cehck if at least one is selected
			* if one is selected get return true
			*/
			function is_one_checkbox_selected(ids){
				for(var x=0;x<ids.length;x++){
					if(document.getElementById(ids[x])){
						if(document.getElementById(ids[x]).checked)
							return true;
					}
				}
				return false;
			}
	
			/*
			* First we collect colors from specific input
			* for input type select and text we collect border color
			* for input type checkbox and radio we colect label text color
			*/
			
			/*
			* create validator array with specific name found in form array
			* after that add prefix validator_array_
			* then put content from temp array holding only fields fro main form array 
			* main form array is php array that holds form data
			*/
			<?php echo 'var validator_array_'.$js_validator.' = '.json_encode($arr['input']).';';?>
			//array to hold border color for text and select input
			var border_color = new Array();
			//array to hold label color for checkbox and radio buttons
			var label_text_color = new Array();	
			
			//go throw js array that holds fields from main php form array
			// remind that we have that data json encoded in validator_array_*
			for(var prop in <?php echo"validator_array_".$js_validator?>){
				// if we have found that input is type text or select
				// they are similar and have border color
				if(<?php echo"validator_array_".$js_validator?>[prop]['type'] === 'text' || 
					<?php echo"validator_array_".$js_validator?>[prop]['type'] === 'password' || 
					<?php echo"validator_array_".$js_validator?>[prop]['type'] === 'select' || 
					<?php echo"validator_array_".$js_validator?>[prop]['type'] === 'textarea' ){
					//if that field has id set, othervise we cant collect anything
					if(document.getElementById(<?php echo"validator_array_".$js_validator?>[prop]['id'])){
						//if we have found element using id
						var element = document.getElementById(<?php echo"validator_array_".$js_validator?>[prop]['id']);
						//get element style using window.getComputedStyle and put it in element_styl var
						var element_style = window.getComputedStyle(element, null);
						//we then extract border color from element_style
						var cur_border_color = element_style['border'];
						// we then put that color in associated array
						// element id => border color of that element
						border_color[<?php echo"validator_array_".$js_validator?>[prop]['id']]=cur_border_color;
					}
				}
				else if (<?php echo"validator_array_".$js_validator?>[prop]['type'] === 'file'){
					//get div element id that holds ouer input file element
					var file_holder = 'file_holder_'+<?php echo"validator_array_".$js_validator?>[prop]['id'];
					
					if(document.getElementById(file_holder)){
						//if we have found element using id
						var element = document.getElementById(file_holder);
						//get element style using window.getComputedStyle and put it in element_styl var
						var element_style = window.getComputedStyle(element, null);
						//we then extract border color from element_style
						var cur_border_color = element_style['border'];
							// we then put that color in associated array
						// element id => border color of that element
						border_color[file_holder] = cur_border_color;
					}
				}
				//if we have found that element is checkbox or radio
				else if(<?php echo"validator_array_".$js_validator?>[prop]['type'] === 'radio' ||
						<?php echo"validator_array_".$js_validator?>[prop]['type'] === 'checkbox'){
					//radio and checkbox buttons are held in array with key['buttons'] 
					if(<?php echo"validator_array_".$js_validator?>[prop]['buttons']){
						// get all buttons from ['buttons'] - this is for radios and checkboxes
						// not only radios even thou var is cur_radios
						var cur_radios = <?php echo"validator_array_".$js_validator?>[prop]['buttons'];
						// go throw all buttons
						for(cur_button in cur_radios){
							// get current button id
							cur_button_id = cur_radios[cur_button]['id'];
							// if exist element with that ID
							if(document.getElementById(cur_button_id)){
								
								// label id is same as id but with prefix label_
								var label_id = 'label_'+cur_button_id;
								//now get label with that id
								var element = document.getElementById(label_id);
								//get style of that element
								var element_style = window.getComputedStyle(element, null);
								//get his text color
								var cur_label_color = element_style['color'];
								// now generate sam array
								// element id => that element text color
								label_text_color[label_id] = cur_label_color;
							}
						}	
					}
				}
			}
			/*
			* functnion with name that is predefined in php array under js_validator key
			* this is the function that will check if form is valide
			*/
			function <?php echo $js_validator?> (){
				
				//create variable that hold if erro is found
				var error_in_form = false;
				// go throw php form array convertet to json
				for(var prop in <?php echo"validator_array_".$js_validator?>){
					// cehck to see if input is required
					//othervise we will skip it, 
					//and let php afther that check for addtional errors
					if(<?php echo"validator_array_".$js_validator?>[prop]['required']){
						// if it is required and if input is text or select
						if(<?php echo"validator_array_".$js_validator?>[prop]['type'] === 'text' || 
							<?php echo"validator_array_".$js_validator?>[prop]['type'] === 'password' ||
							<?php echo"validator_array_".$js_validator?>[prop]['type'] === 'select' ||
								<?php echo"validator_array_".$js_validator?>[prop]['type'] === 'textarea' ){
							//check if we have id provided and if element with that id exist
							if(document.getElementById(<?php echo"validator_array_".$js_validator?>[prop]['id'])){
								//if it exist get that element
								var element = document.getElementById(<?php echo"validator_array_".$js_validator?>[prop]['id']);	
								// if element value is empty set border to red
								if(element.value.trim() == ""){
									element.style.border = "1px solid red";
									error_in_form = true;
								}
								// if we have corrected value and now it is required and not empty
								// we return border color to what it was
								// and we do that using array that holds boreder color 
								// in according to element id
								else{
									element.style.border = border_color[<?php echo"validator_array_".$js_validator?>[prop]['id']];
								}
							}
						} 
						// if input is radio
						else if(<?php echo"validator_array_".$js_validator?>[prop]['type'] === 'radio'){
							// if value for name is set
							if(<?php echo"validator_array_".$js_validator?>[prop]['name']){
								//get radio shared name
								var cur_radio_name = <?php echo"validator_array_".$js_validator?>[prop]['name'];
								//get all ids of button labels
								var cur_button_label_ids=new Array();
								// if we have buttons array sat in php form array
								if(<?php echo"validator_array_".$js_validator?>[prop]['buttons']){
									//get all buttons
									var cur_buttons = <?php echo"validator_array_".$js_validator?>[prop]['buttons'];
									//collect all ids of all radio buttons
									// we do this so that we can make them all red when one is required
									for (var button_num in cur_buttons){
										//alert("this alert"+cur_buttons[button_num].id);
										cur_button_label_ids.push('label_'+cur_buttons[button_num].id);
									}
								}
								// now check if one radio button is selected
								if(is_one_radio_selected(cur_radio_name)){
									//if we have at least one selected 
									//return the collor of all labels using array holding label ids
									for(var x=0;x<cur_button_label_ids.length;x++){
										if(document.getElementById(cur_button_label_ids[x])){
											document.getElementById(cur_button_label_ids[x]).style.color=label_text_color[cur_button_label_ids[x]];
										}
									}
								}
								else{
									//if there is no radio selected
									// go throw array of label ids and set the color to red
									for(var x=0;x<cur_button_label_ids.length;x++){
										if(document.getElementById(cur_button_label_ids[x])){
											document.getElementById(cur_button_label_ids[x]).style.color='red';
											error_in_form = true;
										}
									}
								}
							}
						} 
						//if input is checkbox
						else if(<?php echo"validator_array_".$js_validator?>[prop]['type'] === 'checkbox'){
							//collect all buton label ids so that we can color them
							//or discolor them using array that hold color for specific id
							var cur_button_label_ids=new Array();
							//collect all buttons id so that we can check if at least one radio is selected
							//this is being done because we sad we want it as required
							var cur_button_ids=new Array();
							//if we have buttons in php form array
							if(<?php echo"validator_array_".$js_validator?>[prop]['buttons']){
								//we have ok then collect them all
								var cur_buttons = <?php echo"validator_array_".$js_validator?>[prop]['buttons'];
								for (var button_num in cur_buttons){
									//for all buttons get buttons ids and button label ID's
									cur_button_ids.push(cur_buttons[button_num].id);
									cur_button_label_ids.push('label_'+cur_buttons[button_num].id);
								}
							}
							//if at least one checkbox is selected - if it is required 
							//and stated as such in php form array array
							//if at least one is color them according to color
							if(is_one_checkbox_selected(cur_button_ids)){
								for(var x=0;x<cur_button_label_ids.length;x++){
									if(document.getElementById(cur_button_label_ids[x])){
										document.getElementById(cur_button_label_ids[x]).style.color=label_text_color[cur_button_label_ids[x]];
									}
								}
							} 
							//if non of checkboxes are selected
							//color all checkbox labels to red
							else{
								for(var x=0;x<cur_button_label_ids.length;x++){
									if(document.getElementById(cur_button_label_ids[x])){
										document.getElementById(cur_button_label_ids[x]).style.color='red';
										error_in_form = true;
									}
								}
							}
						}
						else if(<?php echo"validator_array_".$js_validator?>[prop]['type'] === 'file'){

							if(document.getElementById(<?php echo"validator_array_".$js_validator?>[prop]['id'])){
								var file_holder = 'file_holder_'+<?php echo"validator_array_".$js_validator?>[prop]['id'];
								//if it exist get that element
								var element = document.getElementById(<?php echo"validator_array_".$js_validator?>[prop]['id']);	
							
								// if element value is empty set border to red
								if(element.value == ""){
									
									//alert(<?php echo"validator_array_".$js_validator?>[prop]['length']);
									document.getElementById(file_holder).style.border = '1px solid red';
									//element.style.border = "1px solid red";
									error_in_form = true;
								}
								else if (element.value != "" && <?php echo"validator_array_".$js_validator?>[prop]['length']){
									var file_size = parseInt(element.files[0].size);
									var allowed_length = parseInt(<?php echo"validator_array_".$js_validator?>[prop]['length']);
							
									if(file_size > allowed_length){
										allowed_length = allowed_length/8/8;
										alert('Max: '+allowed_length+' MB');
										//alert(<?php echo"validator_array_".$js_validator?>[prop]['length']);
										document.getElementById(file_holder).style.border = '1px solid red';
										//element.style.border = "1px solid red";
										error_in_form = true;
									}
									
								}
								// if we have corrected value and now it is required and not empty
								// we return border color to what it was
								// and we do that using array that holds boreder color 
								// in according to element id
								else{
									document.getElementById(file_holder).style.border = border_color[file_holder];
								}
							}
						}
					}
				}  
			
				<?php
				/*
				* if ajax is set, form will not be submited
				* but serialized form data will be sent to predefined file
				* after that data has been processed a response is generated
				* that response will be given to custum function that is
				* given in form array
				* if it is not given, ajax will not be called
				*/
				if(isset($arr['ajax'])){
					//get name of function that will handle response
					$function_to_handle = $arr['ajax'];
					//get form id
					if(isset($arr['form_id']))
						$form_id = $arr['form_id'];
					
					$method = 'POST';
					
					//if all of the above is set we can generate call to ajax using php
					if($form_id!='' AND $function_to_handle !='' 
						AND $ajax !='' AND  $method != ''){
							
							//get form id
							echo 'var form_id = "'.$form_id.'";';
							//get function to handle, it is called withoud "", othervise it is a string
							echo 'var function_to_handle = '.$function_to_handle.';';
							//file addres to handle request 
							echo 'var file_to_handle_sent_data = "'.$ajax.'";';
							//method for ajax request
							echo 'var method = "'.$method.'";';
							
							echo 'var content_type = "'.$ajax_content_type.'";';
							
							// calling ajax_send_form situated in forms.js
							//it takes
							//1 form id to serialize data
							//2 method
							//3 file adress
							//4 function t handle data - it is custum made function 
							//and has to be included in page that script is running on
							?>
							if(error_in_form == true)				
								return false;
							<?php
							// add more validations is js_additional is given
							// it is afunction created outside 
							// if returns false, whole form is false
							if($js_additional)
								echo 'if(!'.$js_additional.'()) return false;';
							
							echo 'ajax_send_form(form_id,method,file_to_handle_sent_data,function_to_handle,content_type);';
							// returns false, so that form does not submit on any 
							// it may happan that fomr submit file is set so in any case return fales
							echo 'return false;';
					}
				}
				// if there is no ajax call this form is submited the old way
				else{
				?>
					if(error_in_form == true)	{
						return false;
					}	else {
						<?php
						// add more validations is js_additional is given
						// it is afunction created outside 
						// if returns false, whole form is false
						if($js_additional)
							echo 'if(!'.$js_additional.'()) return false;';
						?>
						return true;
					}		
					
				<?php
				}
				?>	
			}
		</script> 
		<?php	
	}
}