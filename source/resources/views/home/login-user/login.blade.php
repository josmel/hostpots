    {!!Form::open(array( 'method' => 'get')) !!}
    {!! Form::hidden('username', '' ) !!}
    {!! Form::hidden('password', '' ) !!}
    {!! Form::hidden('mac', '' ) !!}
    {!! Form::hidden('identity', '' ) !!}
    {!! Form::submit('enviar') !!}
    {!! Form::close() !!}