@layout('main')

@section('page_class')panel@endsection

@section('content')
<div class="row">
    <div class="span3">
    	<aside>
    		@include('panel::panel.menu')
    	</aside>
	</div>

	<div class="span9">
		@yield('panel_content')
	</div>
</div>
@endsection