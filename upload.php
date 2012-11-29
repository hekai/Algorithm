<?php
require_once 'include/db_operator_class.php';
if (isset($_POST['submit'])) {
	$form_data_name = $_FILES['form_data']['name'];
	$form_data_size = $_FILES['form_data']['size'];
	$form_data_type = $_FILES['form_data']['type'];
	$form_data = $_FILES['form_data']['tmp_name'];
	echo $form_data_name . ' - ' . $form_data_size . ' - ' . $form_data_type . ' - ' . $form_data;

	$fp      = fopen($form_data, 'r');
	$content = fread($fp, filesize($form_data));
	$content = addslashes($content);
	fclose($fp);
	
// 	$data = addslashes(fread(fopen($form_data, "r"), filesize($form_data)));
	 
	$query="UPDATE user SET photo = '$content' , photoType = '$form_data_type' WHERE id = 1 ;";
	mydb_query_without_return($query);

}
?>