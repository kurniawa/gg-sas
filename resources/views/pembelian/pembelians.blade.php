@extends('layouts.main_layout')
@section('title','GL.SAS')
<x-navbar :goback="$goback"></x-navbar>
<div class="flex items-center justify-between mt-2 px-2">
    <div>
        <h3>Pembelian</h3>
    </div>
    <div>
        <a href="{{ route('carts.create') }}" class="btn-emerald rounded">+Cart</a>
    </div>
</div>
<x-feedback></x-feedback>
<div class="m-1">
    <table class="table-nice">
        @foreach ($pembelians as $key=>$pembelian)
        <tr>
            <td>
                @if (count($arr_pembelian_photos[$key])!==0)
                <div class="w-7 h-7">
                    <img src="{{ asset('storage/'. $arr_pembelian_photos[$key][0]->path) }}" alt="" class="w-full">
                </div>
                @endif
            </td>
            <td>{{ $pembelian->nama }}</td>
            <td>{{ $pembelian->stok }}</td>
            <td>
                {{-- <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5" />
                    </svg>
                </div> --}}
                <div class="flex pembelians-center">
                    <a href="{{ route('pembelians.show', $pembelian->id) }}" class="btn-warning rounded p-2">></a>
                    <form method="POST" action="{{ route('pembelians.destroy', $pembelian->id) }}" class="m-0" onsubmit="return confirm('Anda yakin ingin menghapus pembelian ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger text-white rounded p-1 ml-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </table>
</div>

<x-user-status></x-user-status>