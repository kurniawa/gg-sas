<div class="ml-1">
	<label for="" class="block">Kondisi:</label>
	<input id="input-kondisi" class="input w-11/12" type="text" placeholder="Kondisi" onkeyup="select_kondisi(this.value)"/>
</div>
<script>
    const kondisis = {!! json_encode($kondisis, JSON_HEX_TAG) !!};
    // console.log(kondisis);
    let label_kondisis=[];
    kondisis.forEach(element => {
        label_kondisis.push({label:element.nama,value:element.nama,id:element.id});
    });
    $('#input-kondisi').autocomplete({
        source:label_kondisis,
        select: function (event,ui) {
            select_kondisi(ui.item.value);
        }
    });

    function select_kondisi(value) {
        document.getElementById('input-kondisi').value=value;
    }
</script>
