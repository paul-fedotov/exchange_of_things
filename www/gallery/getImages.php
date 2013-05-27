<?php
	// $_POST['page']='LK';
	session_start;
	class Images{
		public function getImages(){
			// $tabl=new PDO('mysql:host=localhost;dbname=SWAG','root','');
			$tabl=new PDO('mysql:host=localhost;dbname=SWAG','admin','admin');
			if (!isset($_POST['page'])) {
				$st=$tabl->prepare("SELECT id FROM things ".(($_POST['id']!='last')?'WHERE id<:D':'')." ORDER BY id DESC LIMIT 12");
				if ($_POST['id']!='last') $st->bindValue(':D',$_POST['id']);
				if (!$st->execute()) var_dump($st->errirInfo());
			} elseif ($_POST['page']=='LK') $st=$tabl->query("SELECT things.id as id FROM things INNER JOIN usersthings ON usersthings.thing_id=things.id WHERE usersthings.user_id=".$_SESSION['id']);
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