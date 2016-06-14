<?php
	header("Content-Type: text/html; charset=utf-8");
	if(empty($_POST['whot']) or empty($_POST['status'])) exit();

    	include "functions.php";
    	if($_POST['whot'] == 'question') {
    		$question = getQuestion($_POST['status']);
    		echo json_encode($question);
        } elseif($_POST['whot'] == 'comment') {
    		$comment = getcomment($_POST['status']);
    		echo json_encode($comment);
        };
?>
