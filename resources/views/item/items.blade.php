@extends('layouts.main_layout')
@section('title','GL.SAS')
<x-navbar></x-navbar>
<div class="flex items-center justify-between mt-2 px-2">
    <div>
        <h3>Stok Items</h3>
    </div>
    <div>
        <a href="{{ route('items.create') }}" class="btn-emerald rounded">+Tambah Stok</a>
    </div>
</div>
<div class="m-2">
    @if (session()->has('success_') && session('success_')!=="")
    <div class="alert-success rounded">{{ session('success_') }}</div>
    @endif
    @if (session()->has('warnings_') && session('warnings_')!=="")
    <div class="alert-warning rounded">{{ session('warnings_') }}</div>
    @endif
    @if (session()->has('errors_') && session('errors_')!=="")
    <div class="alert-danger rounded">{{ session('errors_') }}</div>
    @endif
</div>
<div class="m-1">
    <table class="table-nice">
        <tr>
            <th>Nama</th><th>Stok</th><th>Opsi.</th>
        </tr>
        @foreach ($items as $item)
        <tr>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->stok }}</td>
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
                <a href="{{ route('items.show', $item->id) }}" class="btn-warning rounded">D</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>

<x-user-status></x-user-status>
