@extends('presence::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('presence.name') !!}</p>
@endsection
