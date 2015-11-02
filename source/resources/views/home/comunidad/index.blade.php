
@extends('home._layouts.layout')

@section('content')

<div id="section-1__comunity" class="fullHeightCtn">
  <div data-anchor-target="#section-2__comunity" data-bottom-top="transform: translate3d(0px, -20%, 0px);" data-top-bottom="transform: translate3d(0px, 50%, 0px);" class="first-parallax parallax-image"></div>
  <section>
    <h2>Únete a la comunidad Cligo</h2>
    <h3>Incrementa tus ingresos con horarios flexibles</h3><a data-fancybox-type="iframe" href="{{ URL::asset('unete') }}" class="btn btn--skyblue btn--big popup_unete">ÚNETE HOY</a>
  </section>
</div>
<div id="section-2__comunity">
  <section>
    <div class="items-comunity">
      <ul>
        <li>
          <figure class="float-left"><img src="{{ asset('img/item-comunity-1.png') }}"/></figure>
          <blockquote class="float-right">
            <h3>Trabaja cuando quieras</h3>
            <p>¡Trabaja con total libertad! Tú escoges el horario y los pedidos que quieras aceptar </p>
          </blockquote>
        </li>
        <li>
          <figure class="float-right"><img src="{{ asset('img/item-comunity-3.png') }}"/></figure>
          <blockquote class="float-left">
            <h3>Genera ingresos extras</h3>
            <p>Gana la mayor parte de la tarifa del delivery y recibe tus ingresos semanalmente</p>
          </blockquote>
        </li>
        <li>
          <figure class="float-left"><img src="{{ asset('img/item-comunity-2.png') }}"/></figure>
          <blockquote class="float-right">
            <h3>¿Cuáles son los requisitos?</h3>
            <p>¡Cualquier persona entusiasta con ganas de trabajar puede ser parte de la comunidad! Debes tener un vehículo propio (moto, carro o bici), tener un smartphone, tener +18 años y pasar por nuestra verificación de datos</p>
          </blockquote>
        </li>
      </ul>
    </div>
  </section>
</div>
@stop

@section('alpha')

<script>
  window.alpha = {
  	module : 'cligo',
  	controller : 'comunity',
  	action: 'index'
  }
</script>
@stop
