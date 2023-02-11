    <!-- Live as if you were to die tomorrow. Learn as if you were to live forever. - Mahatma Gandhi -->
<div class="flex mt-2">
    @for ($i = 0; $i < 3; $i++)
        {{-- <div class="w-24 h-24{class_preview[i]}">
            <img src="" alt="avatar_foto" />
        </div> --}}
        {{-- {:else} --}}
        @if ($i!==0)
        <div class="ml-2">
        @else
        <div>
        @endif
            <div id="container-preview-photo-{{ $i }}" class="hidden">
                <label for="input-photo-{{ $i }}">
                    <div class="w-24 h-24">
                        <img id="preview-photo-{{ $i }}" src="" alt="" class="w-full">
                    </div>
                </label>
                <button type="button" class="btn-danger rounded flex justify-center text-white mt-1 w-full" onclick="remove_photo('input-photo-{{ $i }}','container-preview-photo-{{ $i }}','preview-photo-{{ $i }}','label-choose-photo-{{ $i }}')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </button>
            </div>
            <label id="label-choose-photo-{{ $i }}" for="input-photo-{{ $i }}" class="border-8 border-dashed rounded w-24 h-24 flex items-center justify-center">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-16 h-16 text-slate-300"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"
                    />
                </svg>
            </label>

        </div>
        <input id="input-photo-{{ $i }}" name="item_photo[]" type="file" accept=".jpg, .jpeg, .png" style="display:none" onchange="preview_photo(this.id,'container-preview-photo-{{ $i }}','preview-photo-{{ $i }}','label-choose-photo-{{ $i }}')"/>
    @endfor
</div>
<script>
    // $(document).ready(function (e) {


    //     $('#photo').change(function(){

    //     let reader = new FileReader();

    //     reader.onload = (e) => {

    //         $('#preview-photo-before-upload').attr('src', e.target.result);
    //     }

    //     reader.readAsDataURL(this.files[0]);

    //     });

    // });
    function preview_photo(input_id,container_preview_photo_id,preview_photo_id,label_choose_photo_id) {
        const el_input = document.getElementById(input_id);
        const el_container_preview_photo = document.getElementById(container_preview_photo_id);
        const el_preview_photo = document.getElementById(preview_photo_id);
        const el_label_choose_photo = document.getElementById(label_choose_photo_id);
        // console.log(el_input.files[0]);
        const blob = URL.createObjectURL(el_input.files[0]);
        el_preview_photo.src=blob;
        el_container_preview_photo.classList.remove('hidden');
        el_label_choose_photo.classList.add('hidden');
    }

    function remove_photo(input_id,container_preview_photo_id,preview_photo_id,label_choose_photo_id) {
        const el_input = document.getElementById(input_id);
        const el_container_preview_photo = document.getElementById(container_preview_photo_id);
        const el_preview_photo = document.getElementById(preview_photo_id);
        const el_label_choose_photo = document.getElementById(label_choose_photo_id);
        el_input.value=null;
        el_preview_photo.src=null;
        console.log(el_container_preview_photo);
        el_container_preview_photo.classList.add('hidden');
        el_label_choose_photo.classList.remove('hidden');
    }
</script>
