<div class="container mx-auto py-8">
    <form id="transfer-form" action="{{route('transfer')}}" method="POST">
        @csrf
        <div class="space-y-4">
            <div x-data="manejadorSelect()">
                <label for="source" class="block mb-2">Source:</label>
                <select
                    id="source" name="source"
                    x-on:change="opcionSeleccionada($event.target.value)"
                    class="w-full p-2 border border-gray-300 rounded"
                >
                    <option value=""></option>
                    <option value="spotify">Spotify</option>
                    <option value="youtube">Youtube</option>
                    <option value="deezer">Deezer</option>
                </select>
            </div>

            <div>
                <label for="destination" class="block mb-2">Destination:</label>
                <select id="destination" name="destination" class="w-full p-2 border border-gray-300 rounded">
                    <option value=""></option>
                    <option value="spotify">Spotify</option>
                    <option value="youtube">YouTube</option>
                    <option value="deezer">Deezer</option>
                </select>
            </div>

            <div>
                <label for="playlist" class="block mb-2">Source Playlists:</label>
                <select id="playlist" name="playlist" class="w-full p-2 border border-gray-300 rounded">
                    <option value=""></option>
                </select>
            </div>

            <input type="hidden" id="source_playlist_id" name="source_playlist_id" value="">

            <div>
                <label for="name" class="block mb-2">Name:</label>
                <input id="name" name="name" type="text" class="w-full p-2 border border-gray-300 rounded" placeholder="Escribe algo...">
            </div>

            <div>
                <label for="Description" class="block mb-2">Description:</label>
                <input id="Description" name="Description" type="text" class="w-full p-2 border border-gray-300 rounded" placeholder="Escribe algo...">
            </div>

            <div class="flex items-center">
                <input id="public" name="public" type="checkbox" class="mr-2">
                <label for="public">Public</label>
            </div>
        </div>
        <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">Start</button>
    </form>

    <script>

        const formulario = document.getElementById('transfer-form');
        const tokenCsrf = formulario.querySelector('input[name="_token"]').value;
        const segundoSelect = document.getElementById('playlist');


        function manejadorSelect() {
            return {
                async opcionSeleccionada(valor) {
                    if (valor === 'spotify') {
                        const response = await fetch('/get_my_playlists', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': tokenCsrf,
                            },
                            body: JSON.stringify({ opcion: valor }),
                        });

                        const data = await response.json();
                        getSelectValues(data);
                    }
                },
            };
        }

        function getSelectValues(data) {
            select_options = [];
            data.playlists.forEach(playlist => {
                select_options.push({ id: playlist.id, name: playlist.name, description: playlist.description, public: playlist.public });
            });

            console.log(select_options);
            emptyAndPlaceOptions(select_options);
        }

        function emptyAndPlaceOptions(select_options) {
            segundoSelect.innerHTML = '';
            select_options.forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option.id;
                optionElement.text = option.name;
                segundoSelect.appendChild(optionElement);
            });
        }

        function updateFields() {
            const selectedIndex = segundoSelect.selectedIndex;
            const selectedOption = segundoSelect.options[selectedIndex];

            if (selectedOption) {
                const selectedData = select_options.find(option => option.id === selectedOption.value);

                if (selectedData) {
                    document.getElementById('name').value = selectedData.name;
                    document.getElementById('Description').value = selectedData.description;
                    document.getElementById('public').checked = selectedData.public;
                    document.getElementById('source_playlist_id').value = selectedData.id;
                }
            }
        }

        segundoSelect.addEventListener('change', updateFields);

    </script>

</div>
