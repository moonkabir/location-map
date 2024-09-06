@extends('layouts.master-frontend')
@section('content')
<style>
    #map {
        height: 500px;
        width: 100%;
    }
</style>
<h3>Google Maps Pump Locations</h3>
<div id="map"></div>

@endsection
@section('footer_js')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsmIxUdW_2FQ24Kl-ZhJ_oPyh0K422y0o&libraries=places"></script>
<script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 5,
            center: {lat: 28, lng: 90} // Center the map to a default location
        });

        $.ajax({
            url: "{{ url('map/map-data') }}",
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                data.forEach(function(pump) {
                    // var marker = new google.maps.Marker({
                    //     position: {lat: parseFloat(pump.latitude), lng: parseFloat(pump.longitude)},
                    //     map: map,
                    //     title: pump.name,
                    //     icon: "{{ url('app_assets') }}/images/dot.png",
                    // });
                    // var infowindow = new google.maps.InfoWindow({
                    //     content: '<h3>' + pump.name + '</h3><a target="_blank" href= "{{ url('map/map-data') }}/' + pump.id + '">Full Report</a>'
                    // });
                    // marker.addListener('click', function() {
                    //     infowindow.open(map, marker);
                    // });


                    var markers = data.map(function(pump) {
                        var marker = new google.maps.Marker({
                            position: {lat: parseFloat(pump.latitude), lng: parseFloat(pump.longitude)},
                            title: pump.name,
                            icon: "{{ url('app_assets') }}/images/dot.png",
                        });
                        var infowindow = new google.maps.InfoWindow({
                            // content: '<h3>' + pump.name + '</h3><a target="_blank" href= "{{ url('map/map-data') }}/' + pump.id + '">Full Report</a>'
                            content: `
                                    <div>
                                        <a target="_blank" href="{{ url('map/map-data') }}/` + pump.id + `">
                                            <img src="{{ url('app_assets') }}/images/elements/15.png" alt="">
                                            <div>
                                                <h2>` + pump.name + `</h2>
                                            </div>
                                            <div>
                                                <p>View Details</p>
                                            </div>
                                        </a>
                                    </div>`
                        });
                        marker.addListener('click', function() {
                            infowindow.open(map, marker);
                        });
                        return marker;
                    });

                    // Cluster the markers
                    new markerClusterer.MarkerClusterer({ 
                        map,
                        markers,
                        maxZoom: 15 // Below this zoom level, the markers will show individually
                    });
                });
            }
        });
    }
    google.maps.event.addDomListener(window, 'load', initMap);
</script>

@endsection