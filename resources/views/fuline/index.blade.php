@extends('layouts.fulineapp')

@section('title')

@section('content')
    <form action="" method="post">
        {{ csrf_field() }}
        <label for="name">名前</label>
        <input type="text" name="name" id="name">
        <input type="submit" value="登録">
    </form>
    <ul>
        @foreach($items as $item)
            <li class="mb-1">{{$item->getData()}} <button data-id="{{$item->id}}" class="del btn btn-dark rounded-pill">削除</button></li>
        @endforeach
    </ul>
@endsection

@section('footer')
    copyright 2019 FU-LINE.
@endsection

@section('page-js')
    <script>
        $(function () {
            $('body').on('click', '.del.btn', function () {
                $btn_elm = $(this);
                const id = $btn_elm.data('id');
                $.ajax({
                    url: '{{ route('del') }}',
                    type: "POST",
                    data: {id: id, _token: '{{ csrf_token() }}'},
                    success: function (data) {
                        if (data.success == 1) {
                            $btn_elm.parent().fadeOut();
                        }
                    }
                });
            });
        });
    </script>
@endsection