<?php

echo '<br /> <hr> <br />';

echo $input['numeric_value']['description'];
$this->gen($input['numeric_value']);

echo '<br /> <hr> <br /> <br />';

echo $input['string_value']['description'];
$this->gen($input['string_value']);

echo '<br /> <hr> <br /> <br />';

echo $input['date_value']['description'];
$this->gen($input['date_value']);

echo '<br /> <hr> <br /> <br />';

echo $input['email_value']['description'];
$this->gen($input['email_value']);

echo '<br /> <hr> <br /> <br />';

echo $input['textarea']['description'];
$this->gen($input['textarea']);

echo '<br /> <hr> <br /> <br />';

echo $input['radio_button']['description'];
echo '<br /><br />';
$this->gen($input['radio_button'],'button_name_1');
echo '&nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp';
$this->gen($input['radio_button'],'button_name_2');


echo '<br /> <hr> <br /> <br />';

echo $input['checkbox_button']['description'];
echo '<br /><br />';
$this->gen($input['checkbox_button'],'button_name_1');
echo '&nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp';
$this->gen($input['checkbox_button'],'button_name_2');

echo '<br /> <hr> <br /> <br />';


echo '<br /> <hr> <br /> <br />';

echo $input['checkbox_button_array']['description'];
echo '<br /><br />';
$this->gen($input['checkbox_button_array'],'button_name_1');
echo '&nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp';
$this->gen($input['checkbox_button_array'],'button_name_2');

echo '<br /> <hr> <br /> <br />';

echo $input['input_select']['description'];
$this->gen($input['input_select']);

echo '<br /> <hr> <br /> <br />';


$this->gen($input['file_upload']);

echo '<br /> <hr> <br /> <br />';


$this->gen($input['file_upload_second']);

?>
<br /><br /><br />
<input type = "submit" name = "submit" value = "SUBMIT ME">
