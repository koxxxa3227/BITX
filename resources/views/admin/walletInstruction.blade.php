@extends("layouts.app")

@push('style')
    <style>
        textarea {
            overflow-y : scroll;
        }
    </style>
@endpush

@section("content")
    <div class="container my-2">
        <h4 class="text-center">Инструкции для пополнения</h4>
        <form action="{{action('Admin\ActionController@walletInstructionSaver')}}" method="post" class="mt-3">
            @csrf
            @foreach($instructions as $item)
                <div class="row mt-2">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="{{$item->wallet}}_textarea">{{__($item->wallet)}}:</label>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <textarea name="{{$item->wallet}}" id="{{$item->wallet}}_textarea" rows="5"
                                  class="form-control">{!! $item->content !!}</textarea>
                    </div>
                </div>
            @endforeach
            <div class="form-group text-right mt-2">
                <button class="btn btn-primary btn-xs-block">Сохранить</button>
            </div>
        </form>
    </div>
@endsection