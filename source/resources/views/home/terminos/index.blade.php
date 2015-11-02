
@extends('home._layouts.layout')

@section('content')

<div id="section-1__terms" class="section-blue modHeight section-blue-terminos">
  <section><img src="{{ asset('img/terms.png') }}"/>
    <h2>Términos y condiciones</h2>
    <!--h3 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis eos debitis veniam a, nobis minima neque facilis, et magni dignissimos eaque mollitia officia accusantium possimus dolorem excepturi consequuntur nulla provident. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis eos debitis veniam a, nobis minima neque facilis.-->
  </section>
</div>
<div id="section-2__terms">
  <section>
    <div class="terms">
      <ul>
        <li>
          <h3>1.- Lorem ipsum dolor sit amet</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A rerum quaerat iure quisquam iste.  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam deleniti consequuntur officia, labore tempore alias, distinctio corporis repellendus quo ad necessitatibus quibusdam? Minus ex possimus, ut adipisci culpa cupiditate omnis.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A rerum quaerat iure quisquam iste.  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam deleniti consequuntur officia, labore tempore alias, distinctio corporis repellendus quo ad necessitatibus quibusdam? Minus ex possimus, ut adipisci culpa cupiditate omnis.</p>
        </li>
        <li>
          <h3>2.- Lorem ipsum dolor sit amet</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A rerum quaerat iure quisquam iste.  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam fugiat maiores, aut ad, illo accusantium ratione obcaecati minus hic culpa nisi placeat at explicabo quae sapiente cumque quos necessitatibus aliquam.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A rerum quaerat iure quisquam iste.  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam fugiat maiores, aut ad, illo accusantium ratione obcaecati minus hic culpa nisi placeat at explicabo quae sapiente cumque quos necessitatibus aliquam.</p>
        </li>
        <li>
          <h3>3.- Lorem ipsum dolor sit amet</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A rerum quaerat iure quisquam iste.  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil culpa sapiente nostrum eos veritatis nobis reprehenderit repellendus animi, ipsum at exercitationem id perspiciatis. Magnam laborum, excepturi quibusdam, possimus eum quae?   Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta quaerat dolore ipsam voluptatem quia illo cupiditate nihil excepturi, laudantium placeat unde sapiente harum animi quam, cum culpa maxime officiis corporis. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores nemo, totam exercitationem aperiam, culpa nobis id expedita placeat facere ab autem, accusamus molestiae amet. Voluptate, reprehenderit dolorem modi pariatur voluptatem.</p>
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
  	controller : 'terms',
  	action: 'index'
  }
</script>
@stop
