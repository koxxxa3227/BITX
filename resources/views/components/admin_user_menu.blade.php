<div class="row">
    <div class="col-md-12">
        <ul class="list-unstyled list-inline">
            <li><a class="mr-1" href="{{action('Admin\PageController@editUser', $user_id)}}" title="Редактировать">Редактировать</a></li>
            <li><a class="mr-1" href="{{action('Admin\PageController@retrofittingPage', $user_id)}}"
                   title="Создать пополнение">Создать пополнение</a></li>
            <li><a class="mr-1" href="{{action('Admin\PageController@openDeposit', $user_id)}}" data-toggle="tooltip"
                   data-placement="right" title="Открыть депозит">Создать депозит</a></li>
            <li><a class="mr-1" href="{{action('Admin\PageController@retroActivelyPage', $user_id)}}"
                   title="Создать вывод">Создать вывод</a></li>
            <li><a class="mr-1" href="{{action('Admin\PageController@refsPage', $user_id)}}"
                   title="Реферавльные вознаграждения">Реферальные вознаграждения</a></li>
        </ul>
    </div>
</div>