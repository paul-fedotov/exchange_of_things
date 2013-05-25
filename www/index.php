<?php
	session_start();
	echo file_get_contents('tpl/topHTML.tpl');
	if (isset($_SESSION['authorized'])) {
		echo file_get_contents('tpl/afterAuthForm.tpl');
	} else {
		echo file_get_contents('tpl/AuthForm.tpl');
	}
?>
		</div>
  </div>
  <div class="container">
		<div class="span13"> 
			<table id="tableOut"></table>
		</div>
  </div>
  <div class="navbar navbar-fixed-bottom"> А тут подвал </div>
</body>
</html>