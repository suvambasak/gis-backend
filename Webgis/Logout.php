<?php
	session_start();
	echo "logging out...";

	session_destroy();
	echo ("<SCRIPT LANGUAGE='JavaScript'>
          window.location.href='https://techcodebox.000webhostapp.com/';
          </SCRIPT>");
?>