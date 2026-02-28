<div x-data="{ sidebarOpen: false }" class="flex">
    <button 
        @click="sidebarOpen = !sidebarOpen"
        class="lg:hidden fixed bottom-4 right-4 z-50 border border-gray-100 bg-white flex justify-center items-center px-3 md:px-5 py-2 md:py-4 lg:py-4 rounded-md drop-shadow-md"
    >
        <template x-if="sidebarOpen">
            <i class="fa-solid fa-xmark text-xl md:text-2xl text-black"></i>
        </template>
        <template x-if="!sidebarOpen">
            <i class="fa-solid fa-bars text-xl md:text-2xl text-black"></i>
        </template>
    </button>

    <div id="sidebar"
        class="fixed top-0 left-0 z-40 bg-white h-full lg:h-fit shadow-lg transform transition-transform duration-300 p-2 lg:p-5 drop-shadow-md
            w-[70%] lg:w-65
            overflow-y-auto
            lg:translate-x-0 lg:relative lg:shadow-none"
        :class="sidebarOpen ? 'translate-x-0 rounded-r-xl' : '-translate-x-full rounded-xl'"
    >
        <div class="flex flex-col mt-3 lg:mt-0">
            <a href="{{ url('cms/dashboard') }}"
                class="uppercase text-2xl md:text-4xl lg:text-2xl text-center font-extrabold text-black tracking-[2px]">
                ACCU Finder
            </a>
            <small class="block text-center text-gray-500 font-light text-xs mt-2">
                v{{ config('app.version') }} &copy; {{ date('Y') }} BIT.
            </small>
        </div>
        <div class="mt-7 md:mt-14 lg:mt-10 flex flex-col gap-3 md:gap-4 lg:gap-5 font-semibold">
            <a href="{{ url('cms/dashboard') }}"
                class="flex flex-row gap-3 py-2 md:py-3 lg:py-2 pl-3 md:pl-5 items-center rounded-lg cursor-pointer
                    hover:bg-gray-400/20
                    {{ request()->is('cms/dashboard*') ? 'bg-gray-400/20' : '' }}">
                <i class="fa-solid fa-gauge text-lg md:text-xl"></i>
                <h4 class="text-lg md:text-xl">Dashboard</h4>
            </a>
            <a href="{{ url('cms/batteries') }}"
                class="flex flex-row gap-3 py-2 md:py-3 lg:py-2 pl-3 md:pl-5 items-center rounded-lg cursor-pointer
                    hover:bg-gray-400/20
                    {{ request()->is('cms/batteries*') ? 'bg-gray-400/20' : '' }}">
                <i class="fa-solid fa-car-battery text-lg md:text-xl"></i>
                <h4 class="text-lg md:text-xl">Battery</h4>
            </a>
            <a href="{{ url('cms/vehicles') }}"
                class="flex flex-row gap-3 py-2 md:py-3 lg:py-2 pl-3 md:pl-5 items-center rounded-lg cursor-pointer
                    hover:bg-gray-400/20
                    {{ request()->is('cms/vehicles*') ? 'bg-gray-400/20' : '' }}">
                <i class="fa-solid fa-car-side text-lg md:text-xl"></i>
                <h4 class="text-lg md:text-xl">Vehicle</h4>
            </a>
            <a href="{{ url('cms/profile') }}"
                class="flex flex-row gap-3 py-2 md:py-3 lg:py-2 pl-3 md:pl-5 items-center rounded-lg cursor-pointer
                    hover:bg-gray-400/20
                    {{ request()->is('cms/profile*') ? 'bg-gray-400/20' : '' }}">
                <i class="fa-solid fa-gear text-lg md:text-xl"></i>
                <h4 class="text-lg md:text-xl">Profile</h4>
            </a>
            

            <form action="{{ route('logout') }}" method="get">
                @csrf
                <button type="submit"
                    class="w-full text-left mt-10 mb-0 md:mb-5 lg:mb-0 flex flex-row hover:bg-gray-400/20 py-2 md:py-3 lg:py-2 pl-3 md:pl-5 gap-3 items-center rounded-lg cursor-pointer">
                    <i class="fa-solid fa-right-from-bracket text-lg md:text-xl"></i>
                    <h4 class="text-lg md:text-xl">Keluar</h4>
                </button>
            </form>

        </div>
    </div>
</div>
