<div class="ml-1">
	<label for="" class="block">Cap:</label>
	<input id="input-cap" class="input w-11/12" type="text" placeholder="Cap" onkeyup="select_cap(this.value)"/>
</div>
<script>
    const caps = {!! json_encode($caps, JSON_HEX_TAG) !!};
    // console.log(caps);
    let label_caps=[];
    caps.forEach(element => {
        label_caps.push({label:element.nama,value:element.nama,id:element.id});
    });
$('#input-cap').autocomplete({
    source:label_caps,
    select: function (event,ui) {
        select_cap(ui.item.value);
    }
});

function select_cap(value) {
    document.getElementById('input-cap').value=value;
}
</script>
