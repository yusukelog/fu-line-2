@extends('layouts.fulineapp')

@section('title')

@section('content')
    @foreach($items as $item)
        <p>{{$item->g_name}}}</p>
    @endforeach
    <form action="" method="post">
        {{ csrf_field() }}
        <label for="g_name">名前</label>
        <input type="text" class="g_name" id="g_name">
        <input type="submit" value="登録">
    </form>
@endsection

@section('footer')
    copyright 2019 FU-LINE.
@endsection