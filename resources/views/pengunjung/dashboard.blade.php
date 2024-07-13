@extends('pengunjung.layouts.master')
@section('title','Dashboard')
@section('judul','Dashboard')

@section('content')
<div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('') }}</div>
            <div class="card-body">
    <h2 class="text-center">Selamat Datang,  {{ Auth::user()->name }}</h2>
    <p class="text-center">Di Website SIAKAD SMK PGRI 2 CIANJUR </p>
    </div>
    </div>
 @endsection      
 