<!-- resources/views/dashboard.blade.php --> 
@extends('layouts.master')

@section('title', '笔记列表') 

@section('content')
	<booklist-component></booklist-component>     
@endsection

@section('footerScripts')
    @parent
    <!-- <script src="{{ asset('js/dashboard.js') }}"></script>  -->
@endsection