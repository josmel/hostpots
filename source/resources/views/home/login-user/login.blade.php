<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <style>
            div.container {
                width: 100%;
                max-width: 450px;
                margin: 0 auto;
            }
            img {
                width: 100%;
                height: auto;
            }
            video {
                width: 100%;
                height: auto;
            }
            #boton {background: red;
                    float: left;
                    position: absolute;
            }

            div a {width:130px; height: 25px;  text-align:center; 
                   top:50%; margin-top:-52px; left: 50%; margin-left:-52px;
                   position:absolute;  line-height:4em; 
                   background: #cc1316 none repeat scroll 0 0;
                   border: medium none;
                   border-radius: 3px;
                   cursor: pointer;
                   display: inline-block;
                   font: 1.143em/1.143em gotham-book,"arial","sans-serif";
                   outline: medium none;
                   vertical-align: middle;
                   color: white;
                   font-size: 1em;
                   line-height: 1.7em;
                   padding-top: 1%;
                   padding-bottom: 1%;      
                   text-decoration:none;}

        </style>
    </head>
    <body>
        <div class="container">
            @if ($value === 'img')
            <img src="{{$imagen}}" >
                @else
                <video src="{{$imagen}}" controls></video>
                @endif
                <div ><a href="{{ $href}}">NAVEGAR  >></a></div>
        </div>
    </body>
</html>

