<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'О компании';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1>Местоположение</h1>
    <div id="map"></div>
    <h1 style="margin: 0px 0px 1.6rem; font-size: 3.2rem; line-height: 3rem; color: #333333; font-family: MVideo, Arial, Helvetica, sans-serif; background-color: #ffffff;">&nbsp;</h1>
    <h1 style="margin: 0px 0px 1.6rem; font-size: 3.2rem; line-height: 3rem; color: #333333; font-family: MVideo, Arial, Helvetica, sans-serif; background-color: #ffffff;">Информация о компании</h1>
    <p>ED-SHOP - магазин электроники который занимается продажей различного рода техники: смартфоны, смарт-часы, ноутбуки, мониторы, телевизоры и т.д.</p>
    <p>Телефон: 89898090226</p>
    <p>E-mail: voloshchenko_ivan_1999@mail.ru</p>

</div>


<script>
    function initMap() {
        var uluru = {lat: 37.1791045, lng: -93.2963246};
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 11, center: uluru});
        var marker = new google.maps.Marker({position: uluru, map: map});
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8bue5FU70UWS_Uy68HO476RpPUl2oK8A&callback=initMap">
</script>



