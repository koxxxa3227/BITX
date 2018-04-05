@extends("layouts.app")

@section("content")
    <div class="container my-2" id="refs-page">
        <div class="row">
            @include('components.cabinet.menu', ['value' => '4'])
        </div>

        <div class="row">
            <div class="col-md-4">
                <h4 class="text-center">Ваша партнёрская ссылка:</h4>
                <input type="text" id="ref-link-input" class="mt-3 m-auto input-styled text-center"
                       value="http://{{$_SERVER['HTTP_HOST']}}/register/?ref={{$me->lower_login}}"
                       title="Ваша партнёрская ссылка">
                <div class="alert alert-success d-none mt-1">
                    Скопировано
                </div>
            </div>
            <div class="col-md-3">
                <h4 class="text-center">Статистика по рефералам:</h4>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="rounded text-center border menu-info-item m-auto">
                            <small class="text-secondary">Всего <br> регистраций:</small>
                            <p><strong>0.00 <i class="fa fa-usd"></i></strong></p>
                            <p class="check-circle"><i class="fa fa-check"></i></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="rounded text-center border menu-info-item m-auto">
                            <small class="text-secondary">Всего <br> активных:</small>
                            <p><strong>0.00 <i class="fa fa-usd"></i></strong></p>
                            <p class="check-circle"><i class="fa fa-check"></i></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <h4 class="text-center">Список моих рефералов:</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Логин</th>
                            <th>Дата</th>
                            <th>Пополнение (<i class="fa fa-usd"></i>)</th>
                            <th>Реферальные (<i class="fa fa-usd"></i>)</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('#ref-link-input').on('focus', function () {
            $(this).select();
            document.execCommand('copy');
            $('.alert').removeClass('d-none').setTimeout(function () {
                $(this).addClass('d-none');
            }, 3000);
        });
    </script>
@endpush