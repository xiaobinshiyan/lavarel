<!-- resources/views/dashboard.blade.php --> 
@extends('layouts.master')

@section('title', '书目列表') 

@section('content')
	<digest-component></digest-component>
@endsection

@section('footerScripts')
    <script>
        var book_id = "{{$book_id}}"
    </script>
    @parent
    <!-- <script src="{{ asset('js/dashboard.js') }}"></script>  -->
@endsection