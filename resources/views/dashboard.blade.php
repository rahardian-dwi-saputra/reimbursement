@extends('template/main')
@section('title','Dashboard')
@section('container')

<div class="container-fluid">
	<h1 class="h3 mb-2 text-gray-800">Selamat Datang, {{ Auth::guard('webkaryawan')->user()->nama }}</h1>
</div>
@endsection