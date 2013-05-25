<script>
alert(1);
</script>

<?
echo (1);
$json = array();
$html = '';
$items_on_page = !empty($_POST['count'])? (int)$_POST['count']: 5;
for($i = 0; $i < $items_on_page; $i++) {
$html .= '<section class="item"><img src="/img/wpapers_ru_BMW-Х6.jpg" alt="" align="top" class="hidden"/></section>';
}
$json['output'] = $html;
echo json_encode($json);
// Здесь в $_POST передается только один 
// параметр (количество добавляемых блоков), но можно передать дополнительно 
// точку старта, по принципу пагинации. Ее можно получить в JS при помощи:
//var items = $(_self.container).find(_self.img);
//var start = items.length;

// и передать в запросе:
//data: {'count': _self.count, 'start': start},

// ... после чего при выборке данных указать
//...' LIMIT ' . (int)$_POST['start'] . ', ' . $items_on_page;
?>
