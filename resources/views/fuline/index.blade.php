@extends('layouts.fulineapp')

@section('title')

@section('content')
    <form action="" method="post">
        {{ csrf_field() }}
        <label for="">名前</label>
        <input type="text" name="name">
        <input type="submit" value="登録">
    </form>
    <ul>
        @foreach($items as $key => $item)
            <li class="mb-1">
                {{$item->getData()}}
                <div class="form-check form-check-inline">
                    <input type="checkbox" class="form-check-input" id="inlineCheckbox{{$key}}"  name="monitor_chk">
                    <label class="form-check-label" for="inlineCheckbox{{$key}}" style="cursor: pointer;">監視する</label>
                </div>
            </li>
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