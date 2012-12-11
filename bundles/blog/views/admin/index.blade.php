@layout('blog::admin.layout')


@section('admincontent')
    <strong>En chiffres...</strong>
    <ul>
        <li>Nombre de billets : {{ $nbPost }}</li>
    </ul>
@endsection