@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error!'))
@section('detail', __('It looks like there was a small error on the server.'))
