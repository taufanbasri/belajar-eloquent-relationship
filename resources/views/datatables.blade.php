@extends('layouts.app')

@section('content')
    {!! $html->table(['class' => 'table table-hover']) !!}
@endsection

@section('scripts')
    {!! $html->scripts() !!}
@endsection
