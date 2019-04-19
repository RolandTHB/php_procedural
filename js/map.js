// Int map center with Paris latitude and longitude
var lat = 48.852969;
var lon = 2.349903;
var macarte = null;
var markerClusters; // To stocker groups of markers

// Init some markers in a list
var villes = {
    "Paris": {
        "lat": 48.852969,
        "lon": 2.349903
    },
    "Brest": {
        "lat": 48.383,
        "lon": -4.500
    },
    "Quimper": {
        "lat": 48.000,
        "lon": -4.100
    },
    "Bayonne": {
        "lat": 43.500,
        "lon": -1.467
    }
};
// Inti map
function initMap() {
    var markers = []; // Marker list initialisation
    // Create map objet "macarte" and insert it in HTML element with ID "map"
    macarte = L.map('map').setView([lat, lon], 11);
    markerClusters = L.markerClusterGroup(); // Markers groups initialisation
    // Leaflet never ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous sou
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
        // Il est toujours bien de laisser le lien vers la source des données
        attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM FRANCE</a>',
        minZoom: 1,
        maxZoom: 20
    }).addTo(macarte);
    // Nous parcourons la liste des villes
    for (ville in villes) {
        //var marker = L.marker([villes[ville].lat, villes[ville].lon]).addTo(macarte);
        // Nous ajoutons la popup. A noter que son contenu (ici la variable ville) peut être du HTML
        //marker.bindPopup(ville);
        var marker = L.marker([villes[ville].lat, villes[ville].lon]); // pas de addTo(macarte), l'affichage sera géré
        marker.bindPopup(ville);
        markerClusters.addLayer(marker); // Nous ajoutons le marqueur aux groupes
        markers.push(marker); // Nous ajoutons le marqueur à la liste des marqueurs
    }
    var group = new L.featureGroup(markers); // Nous créons le groupe des marqueurs pour adapter le zoom
    macarte.fitBounds(group.getBounds().pad(0.5)); // Nous demandons à ce que tous les marqueurs soient visibles, et aj
    // Add marker Cluster to map
    macarte.addLayer(markerClusters);
}
window.onload = function () {
    // Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
    initMap();
};


let currentSearch;

function initMap(addressJson) { //La fonction prend en parm la longitude et latitude
    //On efface la div qui contient la map afin de la rechargez lors d'une nouvelle recherche
    document.getElementById('mapContainer').innerHTML = null;
    //On recréé une div qui contient la map
    document.getElementById('mapContainer').innerHTML = "<div id='map' style='width: 80vw; height: 72vh;'></div>";
    // On crée un objet map dans la div avec l'id "map"
    let map = L.map('map').setView([addressJson.lat, addressJson.lon], 11); //
    // Leaflet never ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous sou
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
        minZoom: 1,maxZoom: 20
    }).addTo(map);
    let marker = L.marker([addressJson.lat, addressJson.lon]).addTo(map);
    if (addressJson.address.town) {
        marker.bindPopup(`<p>${addressJson.address.town}, <small>${addressJson.address.state} lat: ${addressJson.lat} lon: ${addressJson.lon} </small> </p>`).openPopup();
    } else{
        marker.bindPopup(`<small>${addressJson.address.state} lat: ${addressJson.lat} lon: ${addressJson.lon}</small>`).openPopup();
    }
}

function searchAddress() {
    let address = document.getElementById('address').value;
    if (address !== "") { //Si le formulaire est bien rempli
        if (address != currentSearch) {
            document.getElementById('mapContainer').innerHTML = "<div id='map' style='width: 80vw; height: 72vh;'><img src='http://chittagongit.com//images/loading-icon-gif/loading-icon-gif-19.jpg' alt='loading'></div>";
            let url = window.location.origin + "/public/api/mapapi.php?address=" + address;
            $.ajax({
                url: url,
                method: "GET",
                success: function (data) {
                    currentSearch = address;
                    $(jQuery.parseJSON(data)).each(function () {
                        if (this.length !== 0) {
                            initMap(this);
                        } else {
                            alert("Adress not found!");
                        }
                    });
                },
                error: function (data) {
                    alert("Request failed!");
                    console.log(data);
                }
            });
        } else {
            alert("Enter other Address please!");
        }
    } else {
        alert("Enter an Address please!");
    }
}