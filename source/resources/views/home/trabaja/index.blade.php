
@extends('home._layouts.layout')

@section('content')

<div id="section-1__work" class="fullHeightCtn">
  <div data-anchor-target="#section-2__work" data-bottom-top="transform: translate3d(0px, -20%, 0px);" data-top-bottom="transform: translate3d(0px, 50%, 0px);" class="first-parallax parallax-image"></div>
  <section>
    <h2>Hagamos algo increíble, juntos</h2>
    <h3>Estamos cambiando la manera que las pequeñas empresas llegan a sus clientes. <br/>Acompáñanos en esta experiencia y se parte de un equipo de emprendedores apasionados</h3>
  </section>
</div>
<div id="section-2__work">
  <section>
    <form data-parsley-validate="data-parsley-validate">
      <!--fieldset Llenar los datos del siguiente formulario-->
      <div class="form-control">
        <div class="form-input">
          <input type="text" placeholder="(*) Nombres y apellidos" data-parsley-maxlength="30" required="required"/>
        </div>
      </div>
      <div class="form-control">
        <div class="form-input">		
          <input type="text" placeholder="(*) Email de contacto" data-parsley-type="email" required="required"/>
        </div>
      </div>
      <div class="form-control">
        <div class="form-input">		
          <input type="text" placeholder="(*) Teléfono de contacto" data-parsley-type="number" required="required"/>
        </div>
      </div>
      <div class="form-control">
        <div class="form-select">
          <div class="file"><a href="javascript:;" class="btn btn--medium">Adjuntar CV</a>
            <input type="file"/><span></span>
          </div>
        </div>
      </div>
      <div class="form-control">
        <p>(*) campo obligatorio				</p>
      </div>
      <div class="form-control">
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
  	controller : 'work',
  	action: 'index'
  }
</script>
@stop
