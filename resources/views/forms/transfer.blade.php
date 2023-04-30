<div class="container mx-auto py-8">
    <form action="{{route('transfer')}}" method="POST">
        @csrf
        <div class="space-y-4">
            <div>
                <label for="source" class="block mb-2">Source:</label>
                <select id="source" name="source" class="w-full p-2 border border-gray-300 rounded">
                    <option value="option1">Opción 1</option>
                    <option value="option2">Opción 2</option>
                    <option value="option3">Opción 3</option>
                </select>
            </div>
            <div>
                <label for="destination" class="block mb-2">Destination:</label>
                <select id="destination" name="destination" class="w-full p-2 border border-gray-300 rounded">
                    <option value="option1">Opción 1</option>
                    <option value="option2">Opción 2</option>
                    <option value="option3">Opción 3</option>
                </select>
            </div>
            <div>
                <label for="playlist" class="block mb-2">Playlist:</label>
                <select id="playlist" name="playlist" class="w-full p-2 border border-gray-300 rounded">
                    <option value="option1">Opción 1</option>
                    <option value="option2">Opción 2</option>
                    <option value="option3">Opción 3</option>
                </select>
            </div>
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
</div>
