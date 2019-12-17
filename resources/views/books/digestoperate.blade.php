<!-- resources/views/dashboard.blade.php --> 
@extends('layouts.master')

@section('title', '操作笔记') 

@section('content')
	<digestop-component></digestop-component>     
@endsection

@section('footerScripts')
		<script>
    	var digest_id = "{{$digest_id}}"
		</script>
    @parent
    <!-- <script src="{{ asset('js/dashboard.js') }}"></script>  -->
@endsection