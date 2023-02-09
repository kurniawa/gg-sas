<!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
<div class="border border-emerald-500 rounded p-1 mt-1">
    <div class="flex items-center">
        <button class="bg-emerald-500 rounded p-1" type="button" onclick="addMata()">
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
        <span class="ml-2 font-bold">Mata</span>
    </div>
    <div id="div-child-mata"></div>

    <!-- {#each Array(elementMataShowed) as _, i}
    {/each} -->
</div>
<script>
    const matas = {!! json_encode($matas,JSON_HEX_TAG) !!}
    // matas = matas.filter(function(){return true;});
    let label_matas=[];
    matas.forEach(mata => {
        label_matas.push({label:mata.nama,value:mata.nama,id:mata.id});
    });
    // console.log(matas);
    // console.log(matas.length);
    // console.log(label_matas);
    let count_child_mata=0;
    let dataMata=[];
    function addMata() {
        count_child_mata++;
        dataMata[count_child_mata-1]={warna_mata:'',jumlah:1};
        generateElement();

    }

    function subtractMata(index) {
        count_child_mata--;
        dataMata.splice(index,1);
        generateElement();
    }

    function generateElement() {
        let html_child_mata='';
        for (let i = 0; i < count_child_mata; i++) {
            html_child_mata+=`
            <div class="flex items-center mt-1">
                <div id="div-child-mata-${i}">
                    <input
                        id="input-warna-mata-${i}"
                        type="text"
                        placeholder="Warna"
                        class="input w-11/12"
                        name="warna_mata[]"
                        onkeyup="memorizeValue_mata(${i},'warna_mata',this.value)"
                        value="${dataMata[i].warna_mata}"
                    />
                </div>
                <div>
                    <input
                        type="number"
                        placeholder="Jumlah"
                        class="input w-11/12 ml-1"
                        name="jumlah_mata[]"
                        onkeyup="memorizeValue_mata(${i},'jumlah',this.value)"
                        value="${dataMata[i].jumlah}"
                    />
                </div>
                <button
                    class="bg-red-400 rounded-full w-6 h-6 flex justify-center items-center"
                    onclick="subtractMata(${i})"
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
        document.getElementById('div-child-mata').innerHTML=html_child_mata;
        // console.log(html_child_mata);
        for (let i = 0; i < count_child_mata; i++) {
            setAutocomplete_mata(`input-warna-mata-${i}`,label_matas,i);
        }
    }

    function setAutocomplete_mata(id,source,index) {
        $(`#${id}`).autocomplete({
            source: source,
            select: function(event, ui) {
                dataMata[index].warna_mata=ui.item.value;
                document.getElementById(`${id}`).value = ui.item.value;
            }
        });
    }

    function memorizeValue_mata(index, param, value) {
        if (param==='warna_mata') {
            dataMata[index].warna_mata=value;

        } else if (param==='jumlah') {
            dataMata[index].jumlah=value;

        }
    }

</script>
