@extends('layouts.fulineapp')

@section('title')

@section('content')
    <form action="" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="update">
        <input type="submit" value="リストの更新">
    </form>
    <div class="box">
        @foreach($items as $key => $item)
            @php $key++; @endphp
            <div class="list p-2 row border">
                <div class="num col-sm-1 d-flex align-items-center">{{$key}}</div>
                <div class="name col-sm-1 d-flex align-items-center">{{$item->name}}</div>
                @if($item->getTime())
                <div class="time row col-sm-9">
                    @foreach($item->getTime() as $yobi => $time)
                    <dl class="col-sm">
                        <dt>{{$yobi}}</dt>
                        <dd>{{$time}}</dd>
                    </dl>
                    @endforeach
                </div>
                @endif
                <div class="form-check form-check-inline col-sm-1">
                    <input {{ $item->check === 1? 'checked="checked"' : '' }} type="checkbox" class="form-check-input" id="inlineCheckbox{{$key}}" name="code_{{$item->code}}" data-code="{{$item->code}}">
                    <label class="form-check-label" for="inlineCheckbox{{$key}}" style="cursor: pointer;">監視する</label>
                </div>
            </div>
        @endforeach
    </div>
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

                if($(this).prop('checked') == true){
                    $(this).parents('.list').addClass('bg-secondary text-white');
                }else {
                    $(this).parents('.list').removeClass('bg-secondary text-white');
                }
            });
            $('.form-check-input').each(function(index, element){
                if($(element).prop('checked') == true){
                    $(element).parents('.list').addClass('bg-secondary text-white');
                }else {
                    $(element).parents('.list').removeClass('bg-secondary text-white');
                }
            });
        });
    </script>
@endsection