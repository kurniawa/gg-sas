@extends('layouts.main_layout')
@section('title','GL.SAS')
{{-- <navbar :goback="$goback"></navbar> --}}
{{-- <feedback></feedback> --}}
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
@section('content')
<div class="m-2">
    <div class="bg-white rounded p-1 shadow drop-shadow inline-block">
        <h3 class="font-semibold text-lg">Verifikasi Surat Digital</h3>
    </div>
</div>
<div class="m-2">
    @if (session()->has('success_') && session('success_')!=="")
    <div class="alert-success rounded">{{ session('success_') }}</div>
    @endif
    @if (session()->has('warning_') && session('warning_')!=="")
    <div class="alert-warning rounded">{{ session('warning_') }}</div>
    @endif
    @if (session()->has('errors_') && session('errors_')!=="")
    <div class="alert-danger rounded">{{ session('errors_') }}</div>
    @endif
</div>

<form action="{{ route('penjualans.cek_surat_digital') }}" method="get" class="m-2 border rounded p-2">
    <label for="no_surat" class="block">No. Surat:</label>
    <input type="text" name="no_surat" id="no_surat" class="input mt-1" placeholder="No. Surat...">
    @if ($errors->any())
    <div class="alert-danger mt-1">
        @foreach ($errors->all() as $error)
        <span>{{ $error }} </span>
        @endforeach
    </div>
    @endif
    <div class="mt-2 flex justify-center">
        <button type="submit" class="bg-emerald-500 text-white p-2 rounded flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            <span class="ml-2">Cek Surat Digital</span>
        </button>
    </div>
</form>

@endsection

