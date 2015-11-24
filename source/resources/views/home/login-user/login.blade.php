    {!!Form::open(array( 'method' => 'get','name'=>'redirect')) !!}
    {!! Form::hidden('username', '$(username)' ) !!}
    {!! Form::hidden('password', '' ) !!}
    {!! Form::hidden('mac', '$(mac)' ) !!}
    {!! Form::hidden('identity', '' ) !!}
    {!! Form::close() !!}
 <script language='javascript'>document.redirect.submit();</script>