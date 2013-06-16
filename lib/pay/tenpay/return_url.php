<?php

//---------------------------------------------------------
//ІЖё¶НЁјґК±µЅХКЦ§ё¶У¦ґрЈЁґ¦Ан»ШµчЈ©КѕАэЈ¬ЙМ»§°ґХХґЛОДµµЅшРРїЄ·ўјґїЙ
//---------------------------------------------------------

require_once ("./classes/PayResponseHandler.class.php");

/* ГЬФї */
$key = "8934e7d15453e97507ef794cf7b0519d";

/* ґґЅЁЦ§ё¶У¦ґр¶ФПу */
$resHandler = new PayResponseHandler();
$resHandler->setKey($key);

//ЕР¶ПЗ©Гы
if($resHandler->isTenpaySign()) {
	
	//Ѕ»ТЧµҐєЕ
	$transaction_id = $resHandler->getParameter("transaction_id");
	
	//Ѕр¶о,ТФ·ЦОЄµҐО»
	$total_fee = $resHandler->getParameter("total_fee");
	
	//Ц§ё¶Ѕб№ы
	$pay_result = $resHandler->getParameter("pay_result");
	
	if( "0" == $pay_result ) {
	
		//------------------------------
		//ґ¦АнТµОсїЄКј
		//------------------------------
		
		//ЧўТвЅ»ТЧµҐІ»ТЄЦШёґґ¦Ан
		//ЧўТвЕР¶П·µ»ШЅр¶о
		
		//------------------------------
		//ґ¦АнТµОсНк±П
		//------------------------------	
		
		//µчУГdoShow, ґтУЎmetaЦµёъjsґъВл,ёжЛЯІЖё¶НЁґ¦АніЙ№¦,ІўФЪУГ»§дЇААЖчПФКѕ$showТіГж.
		$show = "http://localhost/tenpay/show.php";
		$resHandler->doShow($show);
	
	} else {
		//µ±ЧцІ»іЙ№¦ґ¦Ан
		echo "<br/>" . "Ц§ё¶К§°Ь" . "<br/>";
	}
	
} else {
	echo "<br/>" . "ИПЦ¤З©ГыК§°Ь" . "<br/>";
}

//echo $resHandler->getDebugInfo();

?>