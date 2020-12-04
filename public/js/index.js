let mymap;
let loadSpots = [];

$("document").ready(function () {
    mymap = L.map('map').fitWorld();
    let OpenStreetMap_France = L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
        maxZoom: 20,
        attribution: '&copy; Openstreetmap France | &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });
    let OpenSeaMap = L.tileLayer('https://tiles.openseamap.org/seamark/{z}/{x}/{y}.png', {
        attribution: 'Map data: &copy; <a href="http://www.openseamap.org">OpenSeaMap</a> contributors'
    });
    let OpenWeatherMap_Wind = L.tileLayer('http://{s}.tile.openweathermap.org/map/wind/{z}/{x}/{y}.png?appid={apiKey}', {
        maxZoom: 19,
        attribution: 'Map data &copy; <a href="http://openweathermap.org">OpenWeatherMap</a>',
        apiKey: '3ab55b875b15e28a1a578e49fe000d7c',
        opacity: 0.5
    });

    OpenStreetMap_France.addTo(mymap);
    OpenSeaMap.addTo(mymap);
    OpenWeatherMap_Wind.addTo(mymap);

    mymap.locate({setView: true, maxZoom: 16});

    mymap.on('locationfound', onLocationFound);

    mymap.on('locationerror', onLocationError);

    LoadSpots();

    const header = document.querySelector("header");
    const container = document.querySelector(".headerContainer");
    const navbar = document.querySelector("#navbar");
    let TotalHeight = document.body.scrollHeight - window.innerHeight;
    window.onscroll = function () {
        let progress = (window.pageYOffset / TotalHeight) * 100;
        if (progress > container.scrollHeight / 25) {
            header.style.background = "rgba(255, 255, 255, 0.8)";
            header.style.height = "100px";
            navbar.style.fontSize = "20px";

        } else {
            header.style.backgroundColor = "transparent";
            navbar.style.fontSize = "1em";
        }
    };

    $("#rechercherSpot").on("submit", onSubmitRechercherSpot);
});


function onLocationFound(e) {
    var radius = e.accuracy;

    L.marker(e.latlng).addTo(mymap)
        .bindPopup("Vous êtes dans un rayon de " + radius + " mètre(s) à partir de ce point").openPopup();

    L.circle(e.latlng, radius, {color: '#d72727'}).addTo(mymap);
}


function onLocationError(e) {
    alert(e.message);
}

async function LoadSpots() {
    fetch('/getAllSpot').then(errorCheck).then(res => {
        res.forEach(res => {
            L.marker([res.latitude, res.longitude]).addTo(mymap).bindPopup(res.lieu);
            loadSpots.push([res.latitude, res.longitude]);
        });
    }).catch(catchError);
}

function errorCheck(res) {
    if (res.status >= 200 && res.status <= 299) {
        return res.json();
    } else {
        throw Error();
    }
}

function catchError(err) {
    console.log("Une erreur est survenu : " + err)
}

async function getLocation(address) {
    fetch(`http://open.mapquestapi.com/geocoding/v1/address?key=i52Qc0J9YBIq7M8UkGGMjCvUccA8C18F&location=${address}`).then(errorCheck).then(res => {
        let results = [];
        loadSpots.forEach(function (e) {
            console.log(res.results[0].locations[0].latLng.lat);
            console.log(res.results[0].locations[0].latLng.lng);
            console.log(e[0]);
            console.log(e[1]);
            console.log(e[0] - 0.020641);
            console.log(e[1] - 0.020641);
            console.log(measure(res.results[0].locations[0].latLng.lat, res.results[0].locations[0].latLng.lng, e[0], e[1]));


            if (measure(res.results[0].locations[0].latLng.lat, res.results[0].locations[0].latLng.lng, e[0], e[1]) <= 10000) {
                results.push(e);
            }
        });

        console.log(results);
    }).catch(catchError);
}

function onSubmitRechercherSpot(event) {
    event.preventDefault();
    getLocation($($(this).children()[0]).val());
}

function measure(lat1, lon1, lat2, lon2){  // generally used geo measurement function
    var R = 6378.137; // Radius of earth in KM
    var dLat = lat2 * Math.PI / 180 - lat1 * Math.PI / 180;
    var dLon = lon2 * Math.PI / 180 - lon1 * Math.PI / 180;
    var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
        Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
        Math.sin(dLon/2) * Math.sin(dLon/2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    var d = R * c;
    return d * 1000; // meters
}



