<div class="w-full ml-1">
    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
<div class="border border-indigo-500 rounded p-1 mt-1">
    <div class="flex items-center">
        <button class="bg-indigo-500 rounded p-1" type="button" onclick="show_plat()">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="text-white w-6 h-6"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </button>
        <span class="ml-2 font-bold">Plat</span>
    </div>
    <div id="div-child-plat" class="hidden">
        <div class="flex items-center mt-1">
            <div>
                <input
                    id="input_plat"
                    type="number"
                    placeholder="plat"
                    class="input w-11/12"
                    name="plat"
                    onkeyup="memorizeValue_plat(this.value)"
                    value="{{ old('plat') }}"
                />
            </div>
            <button
                class="bg-red-400 rounded-full w-6 h-6 flex justify-center items-center"
                onclick="hide_plat()"
                type="button"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="text-white w-5 h-5"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                </svg>
            </button>
        </div>
    </div>
</div>
<script>
    function show_plat() {
        document.getElementById('div-child-plat').classList.remove('hidden');
        if (input_plat.value==='') {
            input_plat.value = plat_before;
        }
    }

    function hide_plat() {
        document.getElementById('div-child-plat').classList.add('hidden');
        input_plat.value = null;
    }

    function memorizeValue_plat(value) {
        plat_before=value;
    }

</script>

</div>
