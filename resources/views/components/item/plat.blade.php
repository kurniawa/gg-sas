<div class="w-full">
    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
<div class="border border-indigo-500 rounded p-1 mt-1">
    <div class="flex items-center">
        <button class="bg-indigo-500 rounded p-1" type="button" onclick="add_plat()">
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
    <div id="div-child-plat"></div>

    <!-- {#each Array(elementplatShowed) as _, i}
    {/each} -->
</div>
<script>
    let count_child_plat=0;
    let jumlah_plat=[];
    function add_plat() {
        if (count_child_plat>=1) {

        } else {
            count_child_plat++;
            jumlah_plat[count_child_plat-1]=1;
            generateElement_plat();
        }

    }

    function subtract_plat(index) {
        count_child_plat--;
        jumlah_plat.splice(index,1);
        generateElement_plat();
    }

    function generateElement_plat() {
        let html_child_plat='';
        for (let i = 0; i < count_child_plat; i++) {
            html_child_plat+=`
            <div class="flex items-center mt-1">
                <div>
                    <input
                        id="input-plat-${i}"
                        type="text"
                        placeholder="plat"
                        class="input w-11/12"
                        name="jumlah_plat"
                        onkeyup="memorizeValue_plat(${i},this.value)"
                        value="${jumlah_plat[i]}"
                    />
                </div>
                <button
                    class="bg-red-400 rounded-full w-6 h-6 flex justify-center items-center"
                    onclick="subtract_plat(${i})"
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
            `;
        }
        document.getElementById('div-child-plat').innerHTML=html_child_plat;
    }

    function memorizeValue_plat(index, param, value) {
        jumlah_plat[index]=value;
        jumlah_plat[index]=value;
    }

</script>

</div>
