<?php
	class template {
		private $aAssign=array();
		private $sFile;
		public function __construct($nFile){
			$this->sFile=@file_get_contents($nFile);
		}
		public function assign($name, $value){
			$this->aAssign[$name]=$value;
		}
		public function getHTML(){
			$s=$this->sFile;
			foreach ($this->aAssign as $k=>$v) $s=str_replace('{'.$k.'}',$v,$s);
			return $s;
		}
	}
?>