@extends('layouts.fulineapp')

@section('title')

@section('content')
    <ul>
        @foreach($items as $item)
        <li>{{$item->getData()}}</li>
        @endforeach
    </ul>
    <form action="" method="post">
        {{ csrf_field() }}
        <label for="name">名前</label>
        <input type="text" name="name" id="name">
        <input type="submit" value="登録">
    </form>
@endsection

@section('footer')
    copyright 2019 FU-LINE.
@endsection