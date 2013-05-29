function getXmlHttpRequest(){
	try {
		return new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			return new ActiveXObject("Microsoft.XMLHTTP");
		} catch (ee) {}
}
	if (typeof XMLHttpRequest!='undefined') {
		return new XMLHttpRequest();
	}
}
function block(){
	this.getId = function(){
		var table = document.getElementById('tableOut').children;
		if (table.length!=0){
			var id=table[table.length-1].lastChild.id;
		} else var id='last';
		return id;
	}
	this.getImages = function(){//запрашивает id выводимых картинок и выводит их (картинки)
		var xmlHTTP = getXmlHttpRequest();
		xmlHTTP.withCredentials = true;
		var st = unescape(window.location.href);
    var r = st.substring(st.lastIndexOf('/')+1,st.length);
		var name=r.substring(0,r.lastIndexOf('.'));
		var step,page='';
		switch (name) {
			case 'cabinet': {
				step=2;
				page='&page=LK';
				xmlHTTP.withCredentials = true;
			} break;
			case 'index': step=4; break;
		}
		xmlHTTP.open("POST","gallery/getImages.php",false);
		xmlHTTP.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xmlHTTP.send('id='+this.getId()+page);
		var xmlModel = xmlHTTP.responseXML;
		this.out(xmlModel,step);
	}
	this.out = function(xml,step){//выводит все запрошенные картинки
		var elems = xml.documentElement.childNodes;
		var table = document.getElementById('tableOut');
		for (var i=0;i<elems.length;i++){
			if (i%step==0) var tr = document.createElement('tr');
			var id = elems[i].getAttribute('id');
			var td = document.createElement('td');
			var img = document.createElement('img');
			var a = document.createElement('a');
			img.setAttribute('src','gallery/getOneImage.php?id='+id);
			img.setAttribute('width',270);
			a.setAttribute('href','item.php?id='+id);//создает ссылку на станицу одной шмоточки!
			a.appendChild(img);
			td.appendChild(a);
			td.setAttribute('id',id);
			tr.appendChild(td);
			if ((i%step==step-1)||(i==elems.length-1)) table.appendChild(tr);
			if (i==elems.length-1) {
				if (this.checkId(id)) {
					var button = document.getElementById('button_add');
					button.parentNode.removeChild(button);
				}
			}
		}
	}
	this.checkId = function(id){
		var xmlHTTP = getXmlHttpRequest();
		xmlHTTP.open("POST","gallery/checkId.php",false);
		xmlHTTP.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xmlHTTP.send('id='+id);
		switch (xmlHTTP.responseText){
			case '0': var out = false; break;
			case '1': var out = true; break;
		}
		return out;
	}
}

var page = new block();
function pageLoad() {
	page.getImages();
}
window.onscroll = function(){//запускает добавление, если достигнут конец страницы
	if (document.body.scrollTop+document.body.clientHeight>document.body.offsetHeight-60) page.getImages();
}