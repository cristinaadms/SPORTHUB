<div id="modalMapa" class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 w-11/12 md:w-2/3">
        <h2 class="text-lg font-semibold mb-4">Selecione um local no mapa</h2>
        <div id="map" class="w-full h-80 rounded-lg"></div>

        <div class="mt-4 flex justify-end space-x-3">
            <button type="button" onclick="fecharMapa()"
                class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Cancelar</button>
            <button type="button" onclick="confirmarLocalizacao()"
                class="px-4 py-2 bg-blue-primary text-white rounded-lg hover:bg-blue-hover">
                Confirmar Localização
            </button>
        </div>
    </div>
</div>
