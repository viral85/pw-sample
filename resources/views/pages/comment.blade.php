@extends('layout', ['title' => $user->name])

@section('styles')
<style type="text/css">
    .success { color: #008000; }
    .error { color: #f44336; }
    .label-define {text-align: left; font-weight: 600;}
    .pt-15 {padding-top: 15px;}
    .no-text {text-transform: none !important}
    .no-text-wrap {word-wrap: break-word; text-transform: none !important;}
</style>
@stop

@section('content')
    <header>
        <h1>{{ $user->name }} {{$user->id}}</h1>
        @if( $formType == "form" )
            @include('pages.form')
        @else
            @include('pages.jsonForm')
        @endif
    </header>
@stop

@section('scripts')
@stop