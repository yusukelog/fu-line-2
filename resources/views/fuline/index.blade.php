@extends('layouts.fulineapp')

@section('title')

@section('content')
    <form action="" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="update">
        <input type="submit" value="リストの更新">
    </form>
    <ul>
        @foreach($items as $key => $item)
            @php $key++; @endphp
            <li class="mb-1">
                <span>{{$key}}</span>
                {{$item->name}}
                <div class="form-check form-check-inline">
                    <input {{ $item->check === 1? 'checked="checked"' : '' }} type="checkbox" class="form-check-input" id="inlineCheckbox{{$key}}" name="code_{{$item->code}}" data-code="{{$item->code}}">
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
            $('body').on('change', '.form-check-input', function () {
                let check,code;
                code = $(this).data('code')
                if($(this).prop('checked') == true){
                    check = 1;
                }else {
                    check = 0;
                }
                $.ajax({
                    url: '{{ route('chk') }}',
                    type: "POST",
                    data: {code: code, check: check, _token: '{{ csrf_token() }}'},
                    success: function (data) {
                    }
                });
            });
        });
    </script>
@endsection