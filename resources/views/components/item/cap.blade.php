<div class="ml-1">
	<label for="" class="block">Cap:</label>
	<input id="input-cap" class="input w-11/12" type="text" name="cap" placeholder="Cap" onkeyup="select_cap(this.value)" value="{{ old('cap') }}"/>
</div>
<script>
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
