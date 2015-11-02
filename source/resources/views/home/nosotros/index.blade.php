
@extends('home._layouts.layout')

@section('content')

<div id="section-1__us" class="section fullHeightCtn">
  <div data-anchor-target="#section-3__us" data-bottom-top="transform: translate3d(0px, -20%, 0px);" data-top-bottom="transform: translate3d(0px, 50%, 0px);" class="first-parallax parallax-image"></div>
  <section>
    <h2>¿Qué es Cligo?</h2>
    <h3>
       
      Estamos revolucionando la forma de hacer delivery...<br/>Volviéndolo accesible a todos los pequeños negocios de Perú y Latino América...<br/>Generando un impacto positivo en la sociedad.
    </h3>
  </section>
</div>
<div id="section-3__us" class="fullHeightCtn">
  <section>
    <h2>Contáctanos</h2>
    <form data-parsley-validate="data-parsley-validate">
      <div class="form-control">
        <div class="form-input">
          <input type="text" placeholder="(*) Nombres y apellidos" required="required"/>
        </div>
      </div>
      <div class="form-control">
        <div class="form-input form-input--group">
          <input type="text" placeholder="Nombre de la empresa" data-parsley-maxlength="30"/>
          <div>
            <input type="text" placeholder="(*)Email de contacto" data-parsley-type="email" required="required"/>
          </div>
          <input type="text" placeholder="Teléfono de contacto" data-parsley-type="number"/>
        </div>
      </div>
      <div class="form-control">
        <div class="form-input">
          <div>
            <textarea placeholder="(*) ¿Cuál es tu consulta?" data-parsley-maxlength="200" required="required"></textarea>
          </div>
        </div>
      </div>
      <div class="form-control">
        <label class="campo">(*) campo obligatorio</label>
      </div>
      <div class="form-control">
        <input type="submit" value="Enviar" class="btn btn--skyblue btn--big"/>
      </div>
    </form>
    <div class="contact-details">
      <ul>
        <li><span><i class="icon icon-email"></i></span>
          <p>hola@cligo.pe</p>
        </li>
        <li class="doble-line"><span><i class="icon icon-pin"></i></span>
          <p>Ca. Monte Carmelo 310 of. 101, Surco, Lima – Perú</p>
        </li>
        <li><span><i class="icon icon-phone"></i></span>
          <p>981 695 515 / 945 838 725</p>
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
  	controller : 'us',
  	action: 'index'
  }
</script>
@stop
