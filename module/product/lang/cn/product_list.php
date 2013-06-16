<?php
if(!empty($cat['title']))
	$lang['title']=$cat['title'];
else
	$lang['title']=$dpid.$dcid.$tt."$cat[cat],$cat[cat] производители,$cat[cat] продукты,$cat[cat] торговая платформа";	
if(!empty($cat['keyword']))	
	$lang['keyword']=$cat['keyword'];
else
	$lang['keyword']=$dpid.$dcid."$cat[cat],$cat[cat] производители,$cat[cat] продукты,$cat[cat] торговая платформа";
	
if(!empty($cat['description']))
	$lang['description']=$cat['description'];
else
	$lang['description']=$dpid.$dcid."$cat[cat] каталог профессиональных предприятий $cat[cat] и производителей,$cat[cat] поставщики и эксортеры продукции $cat[cat] прямые поставки от производителей, все категории $cat[cat] в нашей торговой площадке";

$lang['guide']=isset($guide)?$guide:" Список продуктов";
$lang['procat']="Он-лайн торговый центр";
$lang['recpro']='Рекомендуемые продукты';
$lang['newpro']='Новые товары';
$lang['catnav']='Навигация по разделу';
$lang['prolist']='Список продуктов';
$lang['dprice']='Цена: ';
$lang['relinfo']='Просмотр информации';
$lang['inqure']='Email';
$lang['norelinfo']='Нет информации';
$lang['clicktoadd']='Нажмите здесь, чтобы отправить информацию';
$lang['lookmore']='Смотреть другие страны';

$lang['brands'] = "Бренды: ";
$lang['keyw'] = 'Ключевые слова:';
$lang['tt'] = 'Тип сделки ';
$lang['pric'] = 'Цены ';
$lang['utype'] = 'Уровень ';
$lang['allu'] = 'Все участники';
$lang['isure'] = 'Отправить';
$lang['ls'] = 'Список';
$lang['bp'] = 'Фото';
$lang['rsl'] = ' &nbsp;&nbsp;&nbsp;Сортировка ';
$lang['auf']='По приоритету участников&nbsp;';


$lang['tf'] = "Дата по возрастанию";
$lang['tsf'] = 'Дата по убыванию';
$lang['pf'] = 'Цена по возрастанию';
$lang['psf'] = 'Цена по убыванию';
$lang['dfee'] = 'Доставка';
$lang['addrs'] = 'Расположение:';
$lang['allcity'] = 'Во всех регионах&nbsp;';
$lang['seller'] = 'Продавец: ';
?>