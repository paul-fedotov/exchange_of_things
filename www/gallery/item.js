function parseGetParams() { 
   var mass = {}; 
   var mass2 = window.location.search.substring(1).split("&");
   for (var i=0;i<mass2.length;i++) { 
      var str=mass2[i].split("="); 
			mass[str[0]]=str[1];
   }
   return mass; 
}
function getSize(img,n){
	alert('s');
	if (img.width>img.height) {
		var d = n/img.width;
	} else var d = n/img.width;
	alert(d);
	var newWidth = d*img.width;
	var newHeight = d*img.height;
	img.setAttribute('width',newWidth);
	img.setAttribute('height',newHeight);
}
function loadPuctures(){//загружает картинки при загрузке страницы
	var mainPucture = document.getElementById('mainPucture');
	var puctureOne = document.getElementById('puctureOne');
	var puctureTwo = document.getElementById('puctureTwo');
	var puctureThree = document.getElementById('puctureThree');
	var mainImg = document.createElement('img');
	var imgOne = document.createElement('img');
	var imgTwo = document.createElement('img');
	var imgThree = document.createElement('img');
	mainImg.setAttribute('src','gallery/getOneImage.php?id='+parseGetParams().id+'&number=One');
	imgOne.setAttribute('src','gallery/getOneImage.php?id='+parseGetParams().id+'&number=One');
	imgTwo.setAttribute('src','gallery/getOneImage.php?id='+parseGetParams().id+'&number=Two');
	imgThree.setAttribute('src','gallery/getOneImage.php?id='+parseGetParams().id+'&number=Three');
	// getSize(mainImg,n);
	mainImg.setAttribute('onClick',"getImage()");
	imgOne.setAttribute('onClick',"setImage(1)");
	imgTwo.setAttribute('onClick',"setImage(2)");
	imgThree.setAttribute('onClick',"setImage(3)");
	mainPucture.appendChild(mainImg);
	puctureOne.appendChild(imgOne);
	puctureTwo.appendChild(imgTwo);
	puctureThree.appendChild(imgThree);
}
function setImage(n){//меняет картинки по нажатию на них
	var number;
	switch (n) {
		case 1: number='One'; break;
		case 2: number='Two'; break;
		case 3: number='Three'; break;
	}
	var img = document.getElementById('pucture'+number).firstChild;
	var newImg = img.cloneNode(false);
	var div = document.getElementById('mainPucture');
	var oldImg = div.firstChild;
	div.replaceChild(newImg,oldImg);
}