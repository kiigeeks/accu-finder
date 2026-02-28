@extends('public.layouts.main')

@push('addon-style')
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
@endpush

@section('container')
    <div class="w-[97%] md:w-[70%] lg:w-[60%] mx-auto mt-10">
        <div class="flex justify-center gap-2 mb-5">
            <button id="tabVehicle"
                class="tabBtn transition duration-200 bg-gray-800 text-white border border-gray-800 px-7 py-2 rounded-lg cursor-pointer text-sm">
                Vehicles
            </button>

            <button id="tabBattery"
                class="tabBtn transition duration-200 bg-white text-gray-800 border border-gray-800 px-7 py-2 rounded-lg cursor-pointer text-sm">
                Batteries
            </button>
        </div>
        <div class="bg-white shadow-lg rounded-xl p-3 md:p-6 flex flex-row gap-2 md:gap-5">
            <div id="vehicleFinder" class="w-full">
                <select id="variant" placeholder=" ">
                    @foreach($variants as $variant)
                        <option value="{{ $variant->id }}">
                            {{ $variant->model->brand->name }} {{ $variant->model->name }}
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
                        </option>
                    @endforeach
                </select>
            </div>

            <div id="batteryFinder" class="hidden w-full">
                <select id="battery" placeholder="Ketik Battery...">
                    @foreach($batteries as $battery)
                        <option value="{{ $battery->id }}">
                        {{ $battery->model }} {{ $battery->type }} ({{ $battery->ah }}AH)
                        </option>
                    @endforeach
                </select>
            </div>

            <button onclick="resetFinder()"
                class="w-fit px-5 md:px-7 bg-red-500/80 text-white py-1.5 md:py-2 rounded-lg cursor-pointer">
                <i class="fa-solid fa-arrows-rotate text-base md:text-xl"></i>
            </button>
        </div>

        <div id="result" class="mt-5"></div>
    </div>
@endsection

@push('addon-script')
    <script>
        const tabVehicle = document.getElementById('tabVehicle');
        const tabBattery = document.getElementById('tabBattery');
        const vehicleFinder = document.getElementById('vehicleFinder');
        const batteryFinder = document.getElementById('batteryFinder');
        const result = document.getElementById('result');

        const variantSelect = new TomSelect("#variant",{
            allowEmptyOption:true,
            placeholder:"Choose Vehicles...",
        });
        variantSelect.clear(true);

        const batterySelect = new TomSelect("#battery",{
            allowEmptyOption:true,
            placeholder:"Choose Batteries...",
        });
        batterySelect.clear(true);

        function setActiveTab(activeTab)
        {
            [tabVehicle, tabBattery].forEach(tab => {
                tab.classList.remove('bg-gray-800','text-white');
                tab.classList.add('bg-white','text-gray-800');

            });
            activeTab.classList.remove('bg-white','text-gray-800');
            activeTab.classList.add('bg-gray-800','text-white');
        }

        tabVehicle.onclick = function(){
            setActiveTab(tabVehicle);
            vehicleFinder.classList.remove('hidden');
            batteryFinder.classList.add('hidden');
        };

        tabBattery.onclick = function(){
            setActiveTab(tabBattery);
            vehicleFinder.classList.add('hidden');
            batteryFinder.classList.remove('hidden');
        };

        variantSelect.on('change', function(value){
            if(!value)
            {
                result.innerHTML="";
                return;
            }

            fetch(`/vehicle/${value}`)
            .then(res=>{
                if(!res.ok) throw new Error("Not found");
                return res.text();
            })
            .then(html=>{
                result.innerHTML=html;
            })
            .catch(()=>{
                result.innerHTML="<div class='text-gray-500 text-center italic'>No data found</div>";
            });
        });

        batterySelect.on('change', function(value){
            if(!value)
            {
                result.innerHTML="";
                return;
            }

            fetch(`/battery/${value}`)
            .then(res=>{
                if(!res.ok) throw new Error("Not found");
                return res.text();
            })
            .then(html=>{
                result.innerHTML=html;
            })
            .catch(()=>{
                result.innerHTML="<div class='text-gray-500 text-center italic'>No data found</div>";
            });
        });

        function resetFinder()
        {
            variantSelect.clear();
            batterySelect.clear();

            result.innerHTML="";
        }

        window.resetFinder = resetFinder;
    </script>
@endpush