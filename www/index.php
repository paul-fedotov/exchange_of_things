<?php
	session_start();
	var_dump($_SESSION);
	echo file_get_contents('tpl/topHTML.tpl');
	if ($_SESSION['authorized']==1) {
		echo file_get_contents('tpl/afterAuthForm.tpl');
	} else {
		echo file_get_contents('tpl/AuthForm.tpl');
	}
	echo <<<str
	</div>
  </div>
  <div class="container">
		<div class="span13"> 
			<table id="tableOut" align="center"></table>
			<input type="button" onClick="pageLoad()" value="ЕЩЁ" id="button_add">
		</div>
  </div>
  <div class="navbar navbar-fixed-bottom"> А тут подвал </div>
</body>
</html>
str;
?>