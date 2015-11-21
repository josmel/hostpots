@extends('client._layouts.layout')
@section('content')
<style>@media all and (max-width: 800px){
        #contenedor .bloque{
            display: block !important;  /* Cuando el ancho sea inferior a 800px el elemento será un bloque */
            width: auto !important;
        }
    }
    #contenedor .bloque{
        background:  	#20B2AA ;
        display: inline-block;  /* Es esencial para que se muestren los bloques en línea */
        height:100px;
        width: 300px;
        color: white;
        size: 1.5em;
        margin:20px;
    }
    #contenedor .bloque p{

        color: white;
        font-size: 1.8em;
        margin:35px;
    }

</style>
<div id="wrapper">


    <div class="container_perfl">
        <div class="texto_perfil">
            <ul>
                
                  <li class="input_form">{!! Form::button('EQUIPOS',array('type'=>'submit')) !!}</li>
            </ul>

        </div>
        <div id="contenedor">
            <div style="background: #FF4500"	 class="bloque"><p>Activos (250)</p></div>  <div class="bloque"><p>Inactivos (150)</p></div>
            <div style="background: #191970"	 class="bloque"><p>Bloqueados (250)</p></div>
        </div>
        <div class="texto_perfil">
            <ul>
                <li class="input_form">{!! Form::button('USUARIOS',array('type'=>'submit')) !!}</li>
            </ul>

        </div>
        <div id="contenedor">
            <div  style="background: 	#87CEFA" class="bloque"><p>Activos (20)</p></div>  <div style="background: #FFA500" class="bloque"><p>Inactivos (40)</p></div>
            <div style="background: #778899"	 class="bloque"><p>Bloqueados (50)</p></div>
        </div>
        
    </div>     

</div>
@stop