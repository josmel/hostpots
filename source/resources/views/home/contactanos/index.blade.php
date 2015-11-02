
@extends('home._layouts.layout')

@section('content')

<div id="section-1__contact">
  <div id="map"></div>
  <section>
    <form data-parsley-validate="data-parsley-validate">
      <fieldset>Contáctanos</fieldset>
      <div class="contact-details">
        <ul>
          <li><span><i class="icon icon-email"></i></span>hola@cligo.pe</li>
          <li><span><i class="icon icon-pin"></i></span>Ca. Monte Carmelo 310 of. 101, Surco, Lima – Perú</li>
          <li><span><i class="icon icon-phone"></i></span>981 695 515 / 945 838 725</li>
        </ul>
      </div>
      <div class="form-control">
        <div class="form-input form-input--group">
          <input type="text" placeholder="(*) Nombres y apellidos" data-parsley-maxlength="30"/>
          <div>
            <input type="text" placeholder="(*) Email de contacto" data-parsley-type="email" required="required"/>
          </div>
          <input type="text" placeholder="Teléfono de contacto" data-parsley-type="number"/>
        </div>
      </div>
      <div class="form-control">
        <div class="form-input">
          <textarea placeholder="(*) ¿Cuál es tu consulta?" data-parsley-maxlength="200" required="required"></textarea>
        </div>
      </div>
      <div class="form-control">
        <label>(*) campo obligatorio	</label>
      </div>
      <div class="form-control text-center">
        <input type="submit" value="Enviar" class="btn btn--skyblue btn--big"/>
      </div>
    </form>
  </section>
</div>
@stop

@section('alpha')

<script>
  window.alpha = {
  	module : 'cligo',
  	controller : 'contact',
  	action: 'index'
  }
</script>
@stop
