<div>
    <!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
    <div class="relative ml-1">
        <input
            class="input w-full"
            type="text"
            name="pilih_jenis_perhiasan"
            on:keyup={showOpsiJenisPerhiasan}
            bind:value={item.jenis_perhiasan}
            placeholder={placeholder_jenis_perhiasan}
        />
        <div class="border absolute top-9 bg-white z-10">
            {#each haystack_jenis_perhiasan_filtered as item}
                <div
                    class="border p-3 hover:bg-indigo-100 hover:cursor-pointer"
                    on:click={() => pilihJenisPerhiasan(item)}
                    on:keyup={() => pilihJenisPerhiasan(item)}
                >
                    {item}
                </div>
            {/each}
        </div>
        <input type="hidden" bind:value={item.jenis_perhiasan} />
    </div>
</div>
