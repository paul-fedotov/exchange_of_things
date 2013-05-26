<?php
	class Images{
		public function getImages(){
			$tabl=new PDO('mysql:host=localhost;dbname=test','root','');
			$st=$tabl->prepare("SELECT id FROM things ".((($_POST['id']!='last')?'WHERE id<:D':''))." ORDER BY id DESC LIMIT 12");
			if ($_POST['id']!='last') $st->bindValue(':D',$_POST['id']);
			if (!$st->execute()) var_dump($st->errirInfo());
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
	$img->getImages();
?>