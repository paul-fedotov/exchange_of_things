GALLERY = {
    container: 'section.container',
    item: 'section.item',
    img: 'section.item > img.hidden',
    interval: 200,
    count: 5,
    init: function(params) {
	var _self = this;
	if(params != undefined){
	    for (var key in params) {
		_self[key] = params[key];
	    }
	}
	return _self.setUp();
    },
    setUp: function() {
	var _self = this;
	$(window).bind('resize', function(){
	    _self.adjust();
	});
	$(document).ready(function(){
	    _self.adjust();
	    _self.play();
	});
	$(_self.container).bind('scroll', function(){
	    _self.checkScroll();
	});
    },
    adjust: function() {
	var _self = this;
	var outWidth = $(_self.container).width();
	var outHeight = $(_self.container).height();
	var minWidth = 220;
	var cnt = Math.floor(outWidth / minWidth);
	var itemWidth = 100 / cnt;
	$(_self.item).css({
	    'width' : itemWidth + '%'
	});
    },
    play: function() {
	var _self = this;
	var items = $(_self.container).find(_self.img);
	$(items).each(function(i) {
	    var cur = $(this).hide();
	    $(document).queue('myQueue', function(n) {
		cur.removeClass('hidden').fadeIn(_self.interval, n);
	    });
	});
	$(document).dequeue('myQueue');
    },
    load: function() {
	var _self = this;
	$.ajax({
		url: '/load.php',
	    type: 'POST',
	    data: {'count': _self.count},
	    dataType: 'json',
	    success: function(json) {
		if(json.output) {
		    $(_self.container).children('div.clearfix').before(json.output);
		    _self.adjust();
		    _self.play();
		}
	    }
	});
    },
    checkScroll: function() {
	var _self = this;
	var scrollH = $(_self.container).prop('scrollHeight');
	var scrollT = $(_self.container).prop('scrollTop');
	var scrollS = $(_self.container).prop('scrollTop') + $(_self.container).height();
	if(scrollS == scrollH) {
	    _self.load();
	    console.log({
		'scrollHeight': $(_self.container).prop('scrollHeight'),
		'scrollTop': $(_self.container).prop('scrollTop'),
		's': $(_self.container).prop('scrollTop') + $(_self.container).height()
	    });
	}
    }
}

function toExchangePage(){
	
}