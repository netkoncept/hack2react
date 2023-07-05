document.addEventListener("DOMContentLoaded", function () {
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

    const map = L.map('map', {
        center: mapCenter,
        layers: [tileLayers['Open Street Map']],
        zoom: mapZoom,
        preferCanvas: true,
    });

    L.control.layers(tileLayers, {}).addTo(map);

    if (type === 1) {
        const circle = L.circle(cords, radius).addTo(map);
        map.fitBounds(circle.getBounds());
    }

    if (type === 2) {
        const polygon = L.polygon(cords).addTo(map);
        map.fitBounds(polygon.getBounds());
    }
});
