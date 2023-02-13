<div class="w-full ml-1">
    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
<div class="border border-pink-500 rounded p-1 mt-1">
    <div class="flex items-center">
        <button class="bg-pink-500 rounded p-1" type="button" onclick="show_ukuran()">
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
        <span class="ml-2 font-bold">Ukuran</span>
    </div>
    <div id="div-child-ukuran" class="hidden">
        <div class="flex items-center mt-1">
            <div>
                <input
                    id="input_ukuran"
                    type="number"
                    placeholder="ukuran"
                    class="input w-11/12"
                    name="ukuran"
                    onkeyup="memorizeValue_ukuran(this.value)"
                    value="{{ old('ukuran') }}"
                />
            </div>
            <button
                class="bg-red-400 rounded-full w-6 h-6 flex justify-center items-center"
                onclick="hide_ukuran()"
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

    <!-- {#each Array(elementukuranShowed) as _, i}
    {/each} -->
</div>
<script>
    function show_ukuran() {
        document.getElementById('div-child-ukuran').classList.remove('hidden');
        if (input_ukuran.value==='') {
            input_ukuran.value = ukuran_before;
        }
    }

    function hide_ukuran() {
        document.getElementById('div-child-ukuran').classList.add('hidden');
        input_ukuran.value = null;
    }

    function memorizeValue_ukuran(value) {
        ukuran_before=value;
    }

</script>

</div>
