<?php
	session_start;
	// $_POST['page']='LK';
	// $_POST['id']=11;
	// $_SESSION['id']=1;
	class Images{
		public function getImages(){
			// $tabl=new PDO('mysql:host=localhost;dbname=SWAG','root','');
			$tabl=new PDO('mysql:host=localhost;dbname=SWAG','admin','admin');
			if (!isset($_POST['page'])) {
				$st=$tabl->prepare("SELECT id FROM things ".(($_POST['id']!='last')?'WHERE id<:D':'')." ORDER BY id DESC LIMIT 12");
			} elseif ($_POST['page']=='LK') $st=$tabl->prepare("SELECT id FROM things WHERE user_id=".$_COOKIE['id'].(($_POST['id']!='last')?' and id<:D':'')." ORDER BY id DESC LIMIT 12");
			if ($_POST['id']!='last') $st->bindValue(':D',$_POST['id']);
			if (!$st->execute()) var_dump($st->errorInfo());
				// if (!$st) {
					// echo 0;
				// } else 
			$this->getXML($st);
		}
		private function getXML($st){
			header('Content-type: text/xml');
			$xml = new DomDocument();
			$line=$xml->createElement('line');
			if ($st)
				while ($a=$st->fetch(PDO::FETCH_ASSOC)){
					$column=$xml->createElement('id');
					$column->setAttribute('id',$a['id']);
					$line->appendChild($column);
				}
			$xml->appendChild($line);
			echo $xml->saveXML();
		}
	}
	$img = new Images();
	echo $img->getImages();
?>