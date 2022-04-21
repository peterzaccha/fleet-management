<form wire:submit.prevent="submit">
    <div class="mb-6">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Trip Name</label>
        <input id="name" wire:model="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Upper Egypt Trip" >
        @error('name') <span class="text-red-800 text-sm">{{ $message }}</span> @enderror
    </div>
    <div class="mb-6">
        <ul wire:sortable="updateCitiesOrder" class="">
        @foreach (collect($cities)->sortBy('order') as $city)
            <li wire:sortable.item="{{ $city['id'] }}"  wire:key="city-{{ $city['id'] }}" class="bg-gray-50 border border-gray-300 p-2.5 rounded-lg mb-3 text-sm  flex  justify-between w-full">
                <span wire:sortable.handle >
                    {{ $city['name'] }}
                </span>
                <div class="prevent-drag">
                    <a href="#" draggable="false"  wire:click="removeCity({{ $city['id'] }})">Remove</a>
                </div>
            </li>
        @endforeach
        </ul>
    </div>
    @if(count($allCities) > 0)
    <div class="mb-6">
        <label for="city" class="block mb-2 text-sm font-medium text-gray-900 ">Add City</label>
        <div class="flex space-x-2">
            <select id="city" wire:model="selectedCity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" >
                <option disabled=""><option>
                @foreach ($allCities as $id=>$name)
                    <option value="{{$id}}">{{$name}}</option> 
                @endforeach
            </select>
            <a wire:click.perevent="addCity" href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Add</a>
        </div>
        @if(session("error"))
            <span class="text-red-800 text-sm">{{session("error")}}</span> 
        @endif
    </div>
    @endif
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
</form>