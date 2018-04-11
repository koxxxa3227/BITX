@component('mail::message')
@component('mail::table')
      {!! $table !!}
@endcomponent
<p class="normal text-right">Итого доход по реферальной программе за {{ $day }}: {{ $total }}$</p>
<a href="https://futuretrade.club/#partnerSECTION_1" class="text-right d-block">Условия реферальной программы</a>
@endcomponent