@extends('layouts.main_layout')
@section('title','GL.SAS')
<x-navbar></x-navbar>
@section('content')
<form action="{{ route('Login') }}" method="POST" class="p-5 border rounded border-slate-300 mx-5 mt-11">
    @csrf
	<div class="flex justify-center border-b pb-7">
		<h3 class="text-slate-700">Login</h3>
	</div>

	<div class="mt-3">
		<label for="username">Username</label>
		<input
			type="text"
			id="username"
			name="username"
			class="border border-slate-400 text-slate-700 shadow rounded w-full px-3 py-2 block placeholder:text-slate-400 focus:outline-none focus:border-none focus:ring-1 focus:ring-blue-500 invalid:text-pink-700 invalid:focus:ring-pink-700;"
			placeholder="Username..."
            required
		/>
        @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
	</div>
	<div class="mt-3">
		<label for="password">Password</label>
		<input
			type="password"
			id="password"
			name="password"
			class="border border-slate-400 text-slate-700 shadow rounded w-full px-3 py-2 block placeholder:text-slate-400 focus:outline-none focus:border-none focus:ring-1 focus:ring-blue-500 invalid:text-pink-700 invalid:focus:ring-pink-700;"
            placeholder="Password..."
            required
		/>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
	</div>

	<div class="mt-3 text-center">
		<button type="submit" class="btn-dd rounded">Login</button>
	</div>
</form>

@endsection
