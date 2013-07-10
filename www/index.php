<?php
	session_start();
	include 'temp.php';
	echo file_get_contents('tpl/topHTML.tpl');
	if ($_SESSION['authorized']==1) {
		$item = new template('tpl/afterAuthForm.tpl');
		$item->assign('src','ava.php');
		echo $item->getHTML();
	} else echo file_get_contents('tpl/authForm.tpl');
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