<!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
<div class="border border-orange-500 rounded p-1 mt-1">
    <div class="flex items-center">
        <button class="bg-orange-500 rounded p-1" type="button" onclick="add_mainan()">
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
        <span class="ml-2 font-bold">Mainan</span>
    </div>
    <div id="div-child-mainan"></div>

    <!-- {#each Array(elementmainanShowed) as _, i}
    {/each} -->
</div>
<script>
    function add_mainan() {
        count_child_mainan++;
        data_mainan[count_child_mainan-1]={mainan:'',jumlah:1};
        generateElement_mainan();

    }

    function subtract_mainan(index) {
        count_child_mainan--;
        data_mainan.splice(index,1);
        generateElement_mainan();
    }

    function generateElement_mainan() {
        let html_child_mainan='';
        for (let i = 0; i < count_child_mainan; i++) {
            html_child_mainan+=`
            <div class="flex items-center mt-1">
                <div>
                    <input
                        id="input-mainan-${i}"
                        type="text"
                        placeholder="Mainan"
                        class="input w-11/12 mainan"
                        name="mainan[]"
                        onkeyup="memorizeValue_mainan(${i},'mainan',this.value)"
                        value="${data_mainan[i].mainan}"
                    />
                </div>
                <div>
                    <input
                        type="number"
                        placeholder="Jumlah"
                        class="input w-11/12 ml-1 jumlah_mainan"
                        name="jumlah_mainan[]"
                        onkeyup="memorizeValue_mainan(${i},'jumlah',this.value)"
                        value="${data_mainan[i].jumlah}"
                    />
                </div>
                <button
                    class="bg-red-400 rounded-full w-6 h-6 flex justify-center items-center"
                    onclick="subtract_mainan(${i})"
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
        document.getElementById('div-child-mainan').innerHTML=html_child_mainan;
        // console.log(html_child_mainan);
        for (let i = 0; i < count_child_mainan; i++) {
            setAutocomplete_mainan(`input-mainan-${i}`,label_mainans, i);
        }
    }

    function setAutocomplete_mainan(id,source,index) {
        $(`#${id}`).autocomplete({
            source: source,
            select: function(event, ui) {
                data_mainan[index].mainan=ui.item.value;
                document.getElementById(`${id}`).value = ui.item.value;
            }
        });
    }

    function memorizeValue_mainan(index, param, value) {
        if (param==='mainan') {
            data_mainan[index].mainan=value;
        } else if (param==='jumlah') {
            data_mainan[index].jumlah=value;
        }
    }

</script>
