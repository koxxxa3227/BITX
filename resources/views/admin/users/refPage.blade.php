@extends("layouts.app")

@section("content")
    <div class="container my-2">
        @include('components.admin_user_menu')
        <div class="row">
            <h2 class="text-center">Реферальные вознаграждения</h2>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>От кого</th>
                        <th>Сумма депозита</th>
                        <th>Сумма награды</th>
                        <th>Время солздания</th>
                        <th>Статус</th>
                        <th>Опции</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($refs as $ref)
                            <tr>
                                <td>{{ isset($ref->from_user->login) ? $ref->from_user->login : "Пользователь не найден" }}</td>
                                <td>{!! isset($ref->deposit->payment_amount) ? $ref->deposit->payment_amount : "<span class='text-danger'>Депозит не найден</span>" !!}</td>
                                <td>{{ $ref->amount }}</td>
                                <td>{!! isset($ref->deposit->payment_amount) ? "<span class='text-success'>Активен</span>" : "<span class='text-danger'>Можно удалить</span>" !!}</td>
                                <td>{{ $ref->created_at->format('Y.d.m H:i') }}</td>
                                <td>
                                    <a href="{{action('Admin\ActionController@removeRef', [$user_id, $ref->id])}}"
                                       class="btn btn-primary">Удалить</a>
                                </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$refs->links()}}
            </div>
        </div>
    </div>
@endsection