
<div class="flex space-x-1 max-w-md flex-wrap">
    <span class=" bg-gray-200 rounded-full px-2 py-1 mb-2">
        {{\App\Models\City::find($value)->name ?? ""}}
    </span>
</div>