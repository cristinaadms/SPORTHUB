<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Selecionar Localização</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <style>
    #map {
      height: 400px;
      width: 100%;
      border-radius: 8px;
    }
  </style>
</head>
<body>
  <h3>Clique no mapa para selecionar um ponto</h3>
  <div id="map"></div>

  <form>
    <label>Latitude:</label>
    <input type="text" id="lat" name="latitude" readonly>
    <label>Longitude:</label>
    <input type="text" id="lng" name="longitude" readonly>
  </form>

  <script>
    // Inicializa o mapa com posição genérica
    var map = L.map('map').setView([-15.78, -47.93], 4); // posição inicial = Brasil
    var marker;

    // Adiciona mapa base (OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Tenta obter a localização atual do usuário
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        function(position) {
          var lat = position.coords.latitude;
          var lng = position.coords.longitude;

          // Centraliza o mapa na posição atual
          map.setView([lat, lng], 14);

          // Adiciona um marcador indicando a posição atual
          marker = L.marker([lat, lng]).addTo(map)
                   .bindPopup("Você está aqui!")
                   .openPopup();

          // Preenche os campos com as coordenadas
          document.getElementById('lat').value = lat.toFixed(6);
          document.getElementById('lng').value = lng.toFixed(6);
        },
        function(error) {
          console.warn("Geolocalização não permitida ou indisponível:", error);
          alert("Não foi possível obter sua localização atual. Você pode clicar no mapa para escolher o local.");
        }
      );
    } else {
      alert("Seu navegador não suporta geolocalização.");
    }

    // Evento: clique no mapa para escolher outro ponto
    map.on('click', function(e) {
      var lat = e.latlng.lat;
      var lng = e.latlng.lng;

      document.getElementById('lat').value = lat.toFixed(6);
      document.getElementById('lng').value = lng.toFixed(6);

      // Remove marcador anterior, se existir
      if (marker) {
        map.removeLayer(marker);
      }

      // Adiciona novo marcador
      marker = L.marker([lat, lng]).addTo(map);
    });
  </script>
</body>
</html>
