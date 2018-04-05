@extends("layouts.app")

@section("content")
    <div class="container my-2">
        <div class="row">
            <div class="col-md-4">
                <a href="{{action('Admin\PageController@users')}}" class="btn btn-primary btn-block">Пользователи</a>
            </div>
            <div class="col-md-4">
                <a href="{{action('Admin\PageController@payments')}}" class="btn btn-primary btn-block">Выплаты</a>
            </div>
            <div class="col-md-4">
                <a href="{{action('Admin\PageController@deposits')}}" class="btn btn-primary btn-block">Депозиты</a>
            </div>
        </div>
    </div>
@endsection