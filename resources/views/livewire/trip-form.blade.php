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
                <span wire:sortable.handle class="flex">
                    <svg class="w-5 mr-2 text-gray-300 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z"/></svg>
                    {{ $city['name'] }}
                </span>
                <div class="prevent-drag">
                    <a href="#" draggable="false"  wire:click="removeCity({{ $city['id'] }})">Remove</a>
                </div>
            </li>
        @endforeach
        </ul>
        <span class="text-gray-900 text-sm"> Drage and drop the cities to make the trip path, The first in the list is the begging od the trip </span>
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