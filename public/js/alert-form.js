const alertAreaTypeSelect = document.getElementById("alert-area-type");
const areaOnMap = document.getElementById("area-on-map");
const addressFromTeryt = document.getElementById("address-from-teryt");

const areaType = document.getElementById("area-type");
const areaLatLangs = document.getElementById("area-lat-lngs");
const areaRadius = document.getElementById("area-radius");

const terytCommune = document.getElementById("teryt-commune");
const terytCity = document.getElementById("teryt-city");
const terytStreet = document.getElementById("teryt-street");


let map = null;

const showAlertAreaTypeForm = function () {
    switch (alertAreaTypeSelect.options[alertAreaTypeSelect.selectedIndex].value) {
        case '0':
            areaOnMap.style.display = "block";
            addressFromTeryt.style.display = "none";
            initMap();
            break;
        case '1':
            areaOnMap.style.display = "none";
            addressFromTeryt.style.display = "block";
            break;
    }
};

const initMap = function () {
    if (map !== null) {
        return 0;
    }
    const mapCenter = [52.1163247, 21.2070874];
    const mapZoom = 12;

    const tileLayers = {
        'Open Street Map': L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }),
        'Arcgis': L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: '&copy; <a href="http://www.esri.com/">Esri</a>, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community',
        }),
    };

    map = L.map('map', {
        center: mapCenter,
        layers: [tileLayers['Open Street Map']],
        zoom: mapZoom,
        preferCanvas: true,
    });

    L.control.layers(tileLayers, {}).addTo(map);

    const editableLayers = new L.FeatureGroup();
    map.addLayer(editableLayers);

    var drawControl = new L.Control.Draw({
        position: 'topright',
        draw: {
            circlemarker: false,
            marker: false,
            polyline: false,
            rectangle: false,
        },
        edit: {
            featureGroup: editableLayers
        }
    });
    map.addControl(drawControl);

    map.on(L.Draw.Event.CREATED, function (e) {
        editableLayers.eachLayer(function (layer) {
            editableLayers.removeLayer(layer);
        });

        switch (e.layerType) {
            case 'circle':
                areaType.value = 'radius';
                areaRadius.value = e.layer.getRadius();
                areaLatLangs.value = JSON.stringify(e.layer.getLatLng());
                break;

            case 'polygon':
                areaType.value = 'polygon';
                areaRadius.value = '';
                areaLatLangs.value = JSON.stringify(e.layer.getLatLngs());
                break;
        }
        editableLayers.addLayer(e.layer);
    });

    map.on(L.Draw.Event.EDITED, function (e) {
        e.layers.eachLayer(function (layer) {
            if (layer instanceof L.Circle) {
                console.log('circle');
                areaType.value = 'radius';
                areaRadius.value = layer.getRadius();
                areaLatLangs.value = JSON.stringify(layer.getLatLng());
            }
            if (layer instanceof L.Polygon) {
                areaType.value = 'polygon';
                areaRadius.value = '';
                areaLatLangs.value = JSON.stringify(layer.getLatLngs());
            }
        });
    });

    map.on(L.Draw.Event.DELETED, function (e) {
        areaType.value = '';
        areaRadius.value = '';
        areaLatLangs.value = '';
    });
};

const resetSelectOptions = function (select) {
    while (select.childNodes.length !== 1) {
        select.removeChild(select.lastChild);
    }
};

const updateCitiesSelect = function (cities) {
    for (let i = 0; i < cities.options.length; i++) {
        const option = document.createElement('option');
        option.value = cities.options[i].id;
        option.innerHTML = cities.options[i].name;
        terytCity.appendChild(option);
        terytCity.removeAttribute("disabled");
    }
};

const updateStreetsSelect = function (streets) {
    for (let i = 0; i < streets.options.length; i++) {
        const option = document.createElement('option');
        option.value = streets.options[i].id;
        option.innerHTML = streets.options[i].name;
        terytStreet.appendChild(option);
        terytStreet.removeAttribute("disabled");
    }
};

async function getTerytData(url, callback) {
    const response = await fetch(url);
    const jsonData = await response.json();
    callback(jsonData);
}

const onTerytCommuneChange = function () {
    const communeId = this.options[this.selectedIndex].value;
    resetSelectOptions(terytCity);
    getTerytData('/teryt/cities/' + communeId, updateCitiesSelect);
};

const onTerytCityChange = function () {
    const cityId = this.options[this.selectedIndex].value;
    getTerytData('/teryt/streets/' + cityId, updateStreetsSelect);
};

document.addEventListener("DOMContentLoaded", function () {
    showAlertAreaTypeForm();

    alertAreaTypeSelect.addEventListener("change", showAlertAreaTypeForm);
    terytCommune.addEventListener("change", onTerytCommuneChange);
    terytCity.addEventListener("change", onTerytCityChange);
});
