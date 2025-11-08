@push('scripts')
    {{-- Leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        // Preview da Imagem
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        function removePreview() {
            const input = document.getElementById('imagem');
            if (input) input.value = '';
            document.getElementById('imagePreview').classList.add('hidden');
        }

        // Modais
        function toggleModal(modalId) {
            document.getElementById(modalId).classList.toggle('hidden');
        }

        // Fecha modal ao clicar fora
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('fixed') && e.target.classList.contains('inset-0')) {
                e.target.classList.add('hidden');
            }
        });

        // Auto fechamento de alertas
        setTimeout(function() {
            const errorAlert = document.querySelector('.bg-red-100');
            if (errorAlert) {
                errorAlert.style.transition = 'opacity 0.5s';
                errorAlert.style.opacity = '0';
                setTimeout(() => errorAlert.remove(), 500);
            }
        }, 10000);

        // Validação do formulário
        document.querySelector('form').addEventListener('submit', function(e) {
            const nome = document.getElementById('nome')?.value.trim();
            const latitude = document.getElementById('latitude')?.value.trim();
            const longitude = document.getElementById('longitude')?.value.trim();

            if (!nome || !latitude || !longitude) {
                e.preventDefault();
                alert('Por favor, preencha todos os campos obrigatórios.');
                return false;
            }

            const latRegex = /^-?([0-8]?[0-9]|90)\.?[0-9]*$/;
            const lonRegex = /^-?((1[0-7][0-9]|[0-9]{1,2})\.?[0-9]*|180\.?0*)$/;

            if (!latRegex.test(latitude)) {
                e.preventDefault();
                alert('Latitude inválida (ex: -23.550520).');
                return false;
            }

            if (!lonRegex.test(longitude)) {
                e.preventDefault();
                alert('Longitude inválida (ex: -46.633308).');
                return false;
            }
        });

        // Mapa interativo (feito com Leaflet)
        let map, marker, selectedLat, selectedLng;

        function abrirMapa() {
            const modal = document.getElementById('modalMapa');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            // Pega os valores atuais do form
            const latInput = parseFloat(document.querySelector('input[name="latitude"]').value);
            const lngInput = parseFloat(document.querySelector('input[name="longitude"]').value);

            // Inicializa o mapa apenas uma vez
            if (!map) {
                map = L.map('map').setView([-15.78, -47.93], 4);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                if (!isNaN(latInput) && !isNaN(lngInput)) {
                    map.setView([latInput, lngInput], 14);
                    marker = L.marker([latInput, lngInput]).addTo(map);
                    selectedLat = latInput;
                    selectedLng = lngInput;
                }
                // Tenta pegar localização atual do dispositivo
                else if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (pos) => {
                            const {
                                latitude,
                                longitude
                            } = pos.coords;
                            map.setView([latitude, longitude], 14);
                            marker = L.marker([latitude, longitude]).addTo(map)
                                .bindPopup("Você está aqui!").openPopup();
                            selectedLat = latitude;
                            selectedLng = longitude;
                        },
                        (err) => console.warn("Geolocalização não disponível:", err)
                    );
                }

                // Clique no mapa para escolher ponto
                map.on('click', function(e) {
                    selectedLat = e.latlng.lat;
                    selectedLng = e.latlng.lng;

                    if (marker) map.removeLayer(marker);
                    marker = L.marker([selectedLat, selectedLng]).addTo(map);
                });
            } else {
                // Caso o mapa já exista, atualiza a posição para as coordenadas do form
                if (!isNaN(latInput) && !isNaN(lngInput)) {
                    map.setView([latInput, lngInput], 14);
                    if (marker) map.removeLayer(marker);
                    marker = L.marker([latInput, lngInput]).addTo(map);
                    selectedLat = latInput;
                    selectedLng = lngInput;
                }
            }

            // Corrige tamanho do mapa ao abrir modal
            setTimeout(() => map.invalidateSize(), 300);
        }

        function fecharMapa() {
            document.getElementById('modalMapa').classList.add('hidden');
        }

        function confirmarLocalizacao() {
            if (selectedLat && selectedLng) {
                document.querySelector('input[name="latitude"]').value = selectedLat.toFixed(6);
                document.querySelector('input[name="longitude"]').value = selectedLng.toFixed(6);
            }
            fecharMapa();
        }
    </script>
@endpush
