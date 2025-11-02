@extends('errors::minimal')

{{-- Page Title --}}
@section('title', __('Page Expired'))
{{-- Error Code --}}
@section('code', '419')
{{-- Main Message --}}
@section('message', __('Session Expired!'))
{{-- Detail Message --}}
@section('detail', __('The session you were attempting to access has expired. Please refresh the page and try again.'))
