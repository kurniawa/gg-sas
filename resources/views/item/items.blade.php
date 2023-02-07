@extends('layouts.main_layout')
@section('title','GL.SAS')
<x-navbar></x-navbar>
<div class="flex items-center justify-between mt-2 px-2">
    <div>
        <h3>Stok Items</h3>
    </div>
    <div>
        <a href="{{ route('TambahItem') }}" class="btn-emerald rounded">+Tambah Stok</a>
    </div>
</div>
<table class="table-nice">
    @foreach ($items as $item)
    <tr><td>{{ $item->nama }}</td></tr>
    @endforeach
</table>
<div class="mx-8 rounded border mt-5 text-center p-3">
    @auth

    <p>User logged in!</p>
    <p>Username: {{ Auth::user()->username }}</p>

    @endauth
    @guest
    <p>User is not logged in!</p>

    @endguest
</div>
