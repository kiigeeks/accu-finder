<div class="bg-white shadow rounded-lg p-4">
    <h3 class="mb-2 text-sm font-light italic">
        Matching Vehicles for Battery :
        <span class="font-semibold underline underline-offset-2">
            {{ $battery->model }} {{ $battery->type }}
        </span>
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-10">
        @foreach($battery->variants as $variant)
            <div class="border p-3 rounded-lg">
                <div class="font-semibold">
                    {{ $variant->model->brand->name }} {{ $variant->model->name }}
                </div>
                <div class="font-semibold text-sm">
                    {{ ($variant->year_start && $variant->year_end)
                            ? '(' . $variant->year_start . ' - ' . $variant->year_end . ')'
                            : ($variant->year_start
                                ? '(' . $variant->year_start . ')'
                                : ($variant->year_end
                                    ? '(' . $variant->year_end . ')'
                                    : ''
                                )
                            )
                    }}
                </div>

                <div class="flex flex-col text-xs px-2 mt-2 text-gray-500">
                    @if ($variant->engine)
                        <h5>Engine : <span class="font-semibold">{{ $variant->engine }}</span></h5>
                    @endif
                    <h5>{{ $variant->model->note ? $variant->model->note : "" }}</h5>
                </div>
            </div>
        @endforeach
    </div>
</div>