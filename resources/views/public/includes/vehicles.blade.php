<div class="bg-white shadow rounded-lg p-4">
    <h3 class="mb-2 text-sm font-light italic">
        Matching Batteries for Vehicle :
        <span class="font-semibold underline underline-offset-2">
            {{ $variant->model->brand->name }}
            {{ $variant->model->name }}
            ({{ $variant->year_start }} - {{ $variant->year_end }})
        </span>
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-10">
        @foreach($variant->batteries as $battery)
            <div class="border p-3 rounded-lg">
                <div class="font-semibold">
                    {{ $battery->model }} - {{ $battery->type }}
                </div>

                <div class="text-sm text-gray-500 mt-1">
                    • {{ $battery->ah }} AH
                    • {{ $battery->cca }} CCA
                    • {{ $battery->weight }} KG
                </div>

                <div class="flex flex-col text-xs px-2 mt-2 text-gray-500">
                    <h5>Lenght : <span class="font-semibold">{{ $battery->length }} MM</span></h5>
                    <h5>Width : <span class="font-semibold">{{ $battery->width }} MM</span></h5>
                    <h5>Height : <span class="font-semibold">{{ $battery->height }} MM</span></h5>
                    <h5>Total Height : <span class="font-semibold">{{ $battery->total_height }} MM</span></h5>
                </div>
            </div>
        @endforeach
    </div>
</div>