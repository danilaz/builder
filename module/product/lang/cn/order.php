<?php
if(!empty($info))
{
	$lang["title"]=$info["pname"].' - заказ продукции';
	$lang["description"]=strip_tags($info["con"]);
	$lang['keyword']=$info["pname"].' - заказ продукции';
}
$lang['guide']='Заказ продукции';
$lang['orderisset']='Этот продукт уже имеется в Вашем списке заказов! Процесс заказа еще не закончен!';
$lang['cantorder']='Параметры продукта не зваполнены полностью! Невозможно оформить заказ, пожалуйста, свяжитесь с продавцом и потребуйте указания полной информации о продукте!';
$lang['pronameid']='Заказ продукта';
$lang['uprice']='Цена';
$lang['beiz']='Сообщение продавцу';
$lang['buyerdetail']='Подробнее о покупателе';
$lang['comname']='Название компании';
$lang['comaddr']='Адрес компании';
$lang['comlx']='Контактное лицо (должность)';
$lang['can_buy']='Доступно: ';

$lang['contaddr']='Контактный адрес';
$lang['conttel']='Телефон';
$lang['contzip']='Почтовый индекс';
$lang['buyername']='Имя грузополучателя';
$lang['buyertel']='Телефон грузополучателя';
$lang['buyeraddr']='Адрес грузополучателя';
$lang['buyerzip']='Почтовый индекс грузополучателя';
$lang['sellerdetail']='Информация о продавце';

$lang['nums']='Количество';
$lang['allprice']='Общая сумма';
$lang['orderit']='Заказать';
$lang['ordercancel']='Отменить';
$lang['backto']='Вернуться';
$lang['print']='Распечатать';

$lang['freight']='Доставка:';
$lang['sell_freight']='Доставка за счет продавца';
$lang['sent_by_post']='Обычная почта:';
$lang['exp']='Экспресс доставка:';
$lang['ems']='EMS:';
?>