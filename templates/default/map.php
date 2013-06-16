<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Компания на карте</title>
        <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyDqwnPYsB7RiKfBNnULPLyReiZnCrYyIsA=true" type="text/javascript"></script>


  </head>

  <body>
      <div id="map_canvas" style="width: 250px; height: 250px"></div>
  </body>
    <script type="text/javascript">
    var map = null;
    var geocoder = null;
	//var tabList = [ new GInfoWindowTab('Вкладка 1', 'Содержимое первой вкладки'), new GInfoWindowTab('Вкладка 2', 'Содержимое второй вкладки со <A href="http://www.spravkaweb.ru/">ссылкой</A>') ]; 

    function showAddress(address)
	{
		if (GBrowserIsCompatible()) 
		{
			map = new GMap2(document.getElementById("map_canvas"));
			//var map = new GMap2(document.getElementById("map_canvas"));
			//map.setMapType(G_SATELLITE_MAP);
			map.addControl(new GSmallMapControl()); //Стрелки зумированния
			//map.setCenter(new GLatLng(39.917, 36.397), 23);
			geocoder = new GClientGeocoder();
		}
		
      if (geocoder) {
        geocoder.getLatLng(
          address,
          function(point) {
            if (!point) {
              alert("Error: not Google Map Р°dress: " + address);
            } else {
				map.setCenter(point, 16);
				var marker = new GMarker(point);
				map.addOverlay(marker);
				marker.openInfoWindowHtml(address);
			  //marker.openInfoWindowTabsHtml(tabList);
            }
          }
        );
      }
    }
	

	showAddress('<?php echo $_GET['addr'];?>');
    </script>
</html>