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
        <div class="text-center">
            <label for="type">Для какой системы</label>
            <select name="type" id="type" class="custom-select ml-1" style="width: 100px; display: inline-block;" onchange="$('.toggle-form').toggleClass('d-none');">
                <option value="1">Пополнение</option>
                <option value="2">Вывод</option>
            </select>
        </div>
        <form action="{{action('Admin\ActionController@walletInstructionSaver')}}" method="post" class="toggle-form mt-3">
            <h4 class="text-center">Пополнение</h4>
            @csrf
            <input type="text" name="type" hidden value="1">
            @foreach($paymentInstructions as $item)
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
        <form action="{{action('Admin\ActionController@walletInstructionSaver')}}" method="post" class="toggle-form d-none mt-3">
            <h4 class="text-center">Вывод</h4>
            @csrf
            <input type="text" name="type" hidden value="2">
            @foreach($replenishmentInstructions as $item)
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