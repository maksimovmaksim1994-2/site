<?php
			include "config.php";

			if (!$link = mysql_connect(SDB_NAME, USER_NAME, USER_PASSWORD))
			{
			  echo "‹br›He могу соединиться с сервером базы данных‹br›";
			  exit();
			};
    		if (!mysql_select_db(DB_NAME, $link))
			{
			  echo "‹br›He могу выбрать базу данных‹br›";
			  exit();
			};
 
  			if(!mysql_query("set names utf8"))
  			{
			  echo "He могу установить кодировку";
			  exit();
			}; 

?>



