@extends('layouts.main_layout')
@section('title','GL.SAS')
{{-- <navbar :goback="$goback"></navbar> --}}
@section('content')
<div class="inline-block mt-2 ml-2 border bg-white rounded shadow drop-shadow p-1">
    <div class="flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
        </svg>
        <h3 class="font-semibold ml-2">Surat Pembelian</h3>

    </div>
    {{-- <div>
        <a href="{{ route('items.create') }}" class="bg-emerald-500 text-white font-semibold p-2 rounded">+Tambah Stok</a>
    </div> --}}
</div>
{{-- <feedback></feedback> --}}
<div class="m-2">
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
    @if (session()->has('success_') && session('success_')!=="")
    <div class="alert-success rounded">{{ session('success_') }}</div>
    @endif
    @if (session()->has('warning_') && session('warning_')!=="")
    <div class="alert-warning rounded">{{ session('warning_') }}</div>
    @endif
    @if (session()->has('danger_') && session('danger_')!=="")
    <div class="alert-danger rounded">{{ session('danger_') }}</div>
    @endif
    @if (session()->has('failed_') && session('failed_')!=="")
    <div class="alert-danger rounded">{{ session('failed_') }}</div>
    @endif
    @if (session()->has('errors_') && session('errors_')!=="")
    <div class="alert-danger rounded">{{ session('errors_') }}</div>
    @endif
</div>

<div class="m-1">
    <table class="table-nice w-full">
        @foreach ($pembelians as $key=>$pembelian)
        <tr>
            <td>
                <div class="bg-emerald-500 text-white rounded flex justify-center">
                    <div class="text-xs font-bold text-center">
                        <div class="flex"><span>{{ date('d', strtotime($pembelian->created_at)) }}</span>.<span>{{ date('m', strtotime($pembelian->created_at)) }}</span></div>
                        <div>{{ date('Y', strtotime($pembelian->created_at)) }}</div>
                    </div>
                </div>
            </td>
            <td>{{ $pembelian->username }}</td>
            <td>{{ $pembelian->pelanggan_nama }}</td>
            <td>{{ $pembelian->harga_total / 1000000 }}M</td>
            {{-- TOMBOL DROPDOWN --}}
            <td>
                <div class="flex items-center">
                    <button id="btn-dd-{{ $key }}" class="rounded bg-white shadow drop-shadow" onclick="showDropdownMultiple(this.id, 'content-dd-{{ $key }}')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                </div>
            </td>
        </tr>
        <tr id="content-dd-{{ $key }}" class="hidden">
            <td colspan="5">
                <form action="{{ route('pembelians.show', $pembelian->id) }}" method="get">
                    <table>
                        @foreach ($arr_pembelian_items[$key] as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td>
                                <div>{{ $item->harga / 1000 }}k/g</div>
                                <div>{{ $item->ongkos / 1000 }}k/g</div>
                            </td>
                            <td>{{ $item->harga_total / 1000 }}k</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">
                                <div class="flex justify-end">
                                    <button class="bg-sky-500 p-1 rounded text-white">Detail</button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection

{{-- <user-status></user-status> --}}
