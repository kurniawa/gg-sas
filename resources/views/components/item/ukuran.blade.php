<div class="w-full ml-1">
    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
<div class="border border-pink-500 rounded p-1 mt-1">
    <div class="flex items-center">
        <button class="bg-pink-500 rounded p-1" type="button" onclick="add_ukuran()">
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
    <div id="div-child-ukuran"></div>

    <!-- {#each Array(elementukuranShowed) as _, i}
    {/each} -->
</div>
<script>
    let count_child_ukuran=0;
    let ukuran=[];
    function add_ukuran() {
        if (count_child_ukuran>=1) {

        } else {
            count_child_ukuran++;
            ukuran[count_child_ukuran-1]=1;
            generateElement_ukuran();
        }

    }

    function subtract_ukuran(index) {
        count_child_ukuran--;
        ukuran.splice(index,1);
        generateElement_ukuran();
    }

    function generateElement_ukuran() {
        let html_child_ukuran='';
        for (let i = 0; i < count_child_ukuran; i++) {
            html_child_ukuran+=`
            <div class="flex items-center mt-1">
                <div>
                    <input
                        id="input-ukuran-${i}"
                        type="text"
                        placeholder="ukuran"
                        class="input w-11/12"
                        name="ukuran"
                        onkeyup="memorizeValue_ukuran(${i},this.value)"
                        value="${ukuran[i]}"
                    />
                </div>
                <button
                    class="bg-red-400 rounded-full w-6 h-6 flex justify-center items-center"
                    onclick="subtract_ukuran(${i})"
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
        document.getElementById('div-child-ukuran').innerHTML=html_child_ukuran;
    }

    function memorizeValue_ukuran(index, param, value) {
        ukuran[index]=value;
        ukuran[index]=value;
    }

</script>

</div>
