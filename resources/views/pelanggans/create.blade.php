@extends('layouts.main_layout')
<x-navbar :goback="$goback"></x-navbar>
@section('content')
<div class="m-3">
    <div class="inline-block rounded p-2 bg-white shadow drop-shadow">
        <div class="flex items-center">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-6 h-6"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"
                />
            </svg>

            <h3 class="ml-1">Tambah Pelanggan</h3>
        </div>
    </div>

    <form method="POST" action="{{ route('pelanggans.store') }}" class="p-5 border rounded bg-white shadow drop-shadow mt-5">
        <div class="">
            <label for="displayName">Nama :</label>
            <input
                bind:value={form.nama}
                type="text"
                id="displayName"
                placeholder="Raffi Ahmad"
                class="border border-slate-400 text-slate-700 shadow rounded w-full px-3 py-2 block placeholder:text-slate-400 focus:outline-none focus:border-none focus:ring-1 focus:ring-blue-500 invalid:text-pink-700 invalid:focus:ring-pink-700;"
                required
            />
        </div>

        <div class="mt-3">
            <label for="username">Username :</label>
            <input
                bind:value={form.username}
                type="text"
                id="username"
                placeholder="Raffi Ahmad"
                class="border border-slate-400 text-slate-700 shadow rounded w-full px-3 py-2 block placeholder:text-slate-400 focus:outline-none focus:border-none focus:ring-1 focus:ring-blue-500 invalid:text-pink-700 invalid:focus:ring-pink-700;"
                required
            />
        </div>

        <div class="mt-3">
            <label for="gender" class="block">Gender :</label>
            <div class="flex items-center">
                <input type="radio" name="gender" id="pria" value='pria' />
                <label for="pria" class="ml-1">pria</label>
                <input type="radio" name="gender" id="wanita"value='wanita' class="ml-3"/>
                <label for="wanita" class="ml-1">wanita</label>
            </div>
        </div>

        <div class="mt-3">
            <label for="no_hp">No. HP :</label>
            <input name="no_hp" type="text" id="no_hp" placeholder="0889 . . ."
                class="border border-slate-400 text-slate-700 shadow rounded w-full px-3 py-2 block placeholder:text-slate-400 focus:outline-none focus:border-none focus:ring-1 focus:ring-blue-500 invalid:text-pink-700 invalid:focus:ring-pink-700;"
                required
            />
        </div>

        <div class="mt-3">
            <label for="email">Email :</label>
            <input
                type="email"
                id="email"
                placeholder="nagita@slavina.com"
                class="border border-slate-400 text-slate-700 shadow rounded w-full px-3 py-2 block placeholder:text-slate-400 focus:outline-none focus:border-none focus:ring-1 focus:ring-blue-500 invalid:text-pink-700 invalid:focus:ring-pink-700;"
            />
        </div>

        <label for="alamat" class="block mt-3 font-semibold">Alamat</label>
        <div class="p-2 border-4 border-indigo-200 rounded">
            <label for="baris-1">Baris 1 :</label>
            <input
                type="text"
                id="baris-1"
                class="border border-slate-400 text-slate-700 shadow rounded w-full px-3 py-2 block placeholder:text-slate-400 focus:outline-none focus:border-none focus:ring-1 focus:ring-blue-500 invalid:text-pink-700 invalid:focus:ring-pink-700;"
            />
            <label for="baris-2">Baris 2 :</label>
            <input
                type="text"
                id="baris-2"
                class="border border-slate-400 text-slate-700 shadow rounded w-full px-3 py-2 block placeholder:text-slate-400 focus:outline-none focus:border-none focus:ring-1 focus:ring-blue-500 invalid:text-pink-700 invalid:focus:ring-pink-700;"
            />
            <label for="provinsi">Provinsi :</label>
            <input
                type="text"
                id="provinsi"
                class="border border-slate-400 text-slate-700 shadow rounded w-full px-3 py-2 block placeholder:text-slate-400 focus:outline-none focus:border-none focus:ring-1 focus:ring-blue-500 invalid:text-pink-700 invalid:focus:ring-pink-700;"
            />
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label for="kota">Kota :</label>
                    <input
                        type="text"
                        id="kota"
                        class="border border-slate-400 text-slate-700 shadow rounded w-full px-3 py-2 block placeholder:text-slate-400 focus:outline-none focus:border-none focus:ring-1 focus:ring-blue-500 invalid:text-pink-700 invalid:focus:ring-pink-700;"
                    />
                </div>
                <div>
                    <label for="kodepos">Kodepos :</label>
                    <input
                        type="text"
                        id="kodepos"
                        class="border border-slate-400 text-slate-700 shadow rounded w-full px-3 py-2 block placeholder:text-slate-400 focus:outline-none focus:border-none focus:ring-1 focus:ring-blue-500 invalid:text-pink-700 invalid:focus:ring-pink-700;"
                    />
                </div>
            </div>
        </div>

        <!-- Foto Profile -->
        <div class="flex justify-center mt-3 py-3 border-2 border-pink-400 rounded">
            <div class="w-2/3">
                <img src="" alt="avatar_foto" />

            </div>

        </div>

        <div class="text-center">
            <div class="inline-block border-2 border-pink-400 rounded p-2 mt-2">
                <div class="flex items-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6"
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

                    <div class="ml-1">Foto Profile</div>
                </div>


            </div>
        </div>
        <input
            style="display:none"
            name="profile_picture"
            type="file"
            accept=".jpg, .jpeg, .png"
        />

        <div class="flex justify-center mt-3 py-3 border-2 border-violet-400 rounded">
            <div class="w-2/3">
                <img src="" alt="avatar_id" />

            </div>

        </div>

        <div class="text-center">
            <div class="inline-block border-2 border-violet-400 rounded p-2 mt-2">
                <div class="flex items-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6"
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

                    <div class="ml-1">Foto ID</div>
                </div>


            </div>
        </div>
        <input
            style="display:none"
            type="file"
            accept=".jpg, .jpeg, .png"
        />

        <div class="mt-3 text-center">
            <button
                type="submit"
                class="bg-emerald-500 rounded text-white font-semibold w-full py-4 hover:bg-emerald-600 disabled:opacity-25"
                >+Tambah Pelanggan</button
            >
        </div>
    </form>

    <!-- <form class="p-5 border rounded bg-white shadow drop-shadow mt-5" enctype="multipart/form-data">

        <div class="mt-3 text-center">
            <button type="submit" class="btn-emerald rounded">Test Upload</button>
        </div>
    </form> -->
</div>
@endsection
