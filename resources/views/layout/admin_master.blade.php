
@if(Auth::check() && Auth::User()->role == 1) 
<!-- Admin  -->
	@include('include_admin_dashboard.header')
	@yield('content')
	@include('include_admin_dashboard.footer')
@elseif(Auth::check() && Auth::User()->role == 2) 
	<!-- Shop -Owner  -->
	@include('include_shop_owner.header')
	@yield('content')
	@include('include_shop_owner.footer')

@elseif(Auth::check() && Auth::User()->role == 3) 
<!-- Branch -Owner  -->
	@include('include_branch_owner.header')
	@yield('content')
	@include('include_branch_owner.footer')

@endif