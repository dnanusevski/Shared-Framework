<?php
namespace traits;
trait from_templates{

	function generate_form_holder_green($title,$formClass,$asked_form,$aditional_class='',&$data = ''){
		
		echo '<div class ="system_form_div_holder '.$aditional_class.'">';
			echo '<br>';
			echo '<div class = "system_form_title"> ';
				echo '<img class = "system_form_title_decoration" src = "/images/system_svg/form_triangle.svg">';
				echo '<div class = "system_form_title_text">'.$title.'</div>';
			echo '</div>';
			echo '<br>';
			echo '<br>';
				$formClass->$asked_form($data);
			echo '<br>';
		echo '</div>';
	}
	
	function generate_form_holder_spec_green($title,$formClass,$asked_form,$aditional_class='',&$data = ''){
		echo '<div class ="system_form_div_holder '.$aditional_class.'">';
			echo '<div class = "system_form_spec_title"> '.$title.'</div>';
			echo '<br>';
			echo '<br>';
				$formClass->$asked_form($data);
			echo '<br>';
		echo '</div>';
	}
}