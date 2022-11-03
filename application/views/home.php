<style>
    html,
    body {
        height: 100%;
        margin: 0;
    }

    #map {
        width: 100%;
        height: 400px;
    }
</style>

<section class="section">
    <div class="section-header">
        <h1> Poligon </h1>
    </div>

    <div class="section-body">


        <div id='map'></div>
        <form action="<?php echo base_url('home/simpan') ?>" method="post">
            <input type="text" name="nama_gis" placeholder="nama" />
            <input type="text" name="alamat" placeholder="alamat" />
            <input type="text" name="kelurahan" placeholder="kelurahan" />
            <textarea name="polygon" id="" cols="30" rows="10"></textarea>
            <button type="submit"> simpan </button>
        </form>
        <!-- <textarea name="polygon" ></textarea> -->
    </div>
    </div>
</section>

<script>
    var map = L.map('map').fitWorld();

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibGFiaWJ1bGZpa3JpIiwiYSI6ImNrbnM5cTU2ZDA0N3IycXMxbnZwNzU0MmEifQ.8aSIgdT7J9VJlOtqqpfjUA', {
        maxZoom: 20,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
    }).addTo(map);

    function onLocationFound(e) {
        var radius = e.accuracy / 2;

        L.marker(e.latlng).addTo(map)
            .bindPopup("You are within " + radius + " meters from this point").openPopup();
        // L.polygon.bindPopup("I am a polygon.");
        L.circle(e.latlng, radius).addTo(map);
    }

    function onLocationError(e) {
        alert(e.message);
    }

    map.on('locationfound', onLocationFound);
    map.on('locationerror', onLocationError);

    map.locate({
        setView: true,
        maxZoom: 20
    });
    // get coordinate
    // map.on('click',
    //     function(e) {
    //         var coord = e.latlng.toString().split(',');
    //         var lat = coord[0].split('(');
    //         var lng = coord[1].split(')');
    //         alert("You clicked the map at latitude: " + lat[1] + " and longitude:" + lng[0]);
    //     });


    //edit polygon
    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);
    var drawControl = new L.Control.Draw({
        draw: {
            polyline: false,
            rectangle: false,
            circle: false,
            circlemarker: false,
            marker: false
        },
        edit: {
            featureGroup: drawnItems
        }
    });

    map.addControl(drawControl);
    map.on('draw:created', function(e) {
        var type = e.layerType,
            layer = e.layer;

        var latLang = layer.getLatLngs();
        $("[name=polygon]").val(JSON.stringify(latLang[0]));
        drawnItems.addLayer(layer);
    });
</script>