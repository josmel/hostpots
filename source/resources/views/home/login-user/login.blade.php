    {!!Form::open(array( 'method' => 'get','name'=>'redirect')) !!}
    {!! Form::hidden('username', '' ) !!}
    {!! Form::hidden('password', '' ) !!}
    {!! Form::hidden('mac', '' ) !!}
    {!! Form::hidden('identity', '' ) !!}
    {!! Form::close() !!}
 <script language='javascript'>document.redirect.submit();</script>