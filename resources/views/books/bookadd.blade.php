<!-- resources/views/dashboard.blade.php --> 
@extends('layouts.master')

@section('title', '书目添加') 

@section('content')
	<bookadd-component></bookadd-component>     
@endsection

@section('footerScripts')
		<script>
    	var book_id = "{{$book_id}}"
		</script>
    @parent
    <!-- <script src="{{ asset('js/dashboard.js') }}"></script>  -->
@endsection