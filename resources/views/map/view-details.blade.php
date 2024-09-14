@extends('layouts.master-frontend')
@section('content')
<style>
    #map {
        height: 500px;
        width: 100%;
    }
</style>
<div style="position: absolute;top: 30%;left: 50%;z-index: 9999;transform: translate(-50%, -70%);color: #301616;font-weight: 700;">
    <p style="font-size: 30px;">{{$data->name}}</p>
    <span>{{$country}}</span> | <span>{{$data->latitude}}</span>, <span>{{$data->longitude}}</span>
</div>
<div id="map"></div>

@endsection
@section('footer_js')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsmIxUdW_2FQ24Kl-ZhJ_oPyh0K422y0o&libraries=places"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function initMap() {
        var latitude = {{$data->latitude}};
        var longitude = {{$data->longitude}};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 17,
            center: {lat: latitude, lng: longitude},
        });
        var marker = new google.maps.Marker({
            position: {lat: parseFloat(latitude), lng: parseFloat(longitude)},
            map: map,
        });
    }
    google.maps.event.addDomListener(window, 'load', initMap);
</script>
@endsection