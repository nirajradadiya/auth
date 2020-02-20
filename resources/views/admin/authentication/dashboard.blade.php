@extends('layout.admin_default')
@section('content')
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Dashboard <small>reports & statistics</small>
		</h3>
        <!-- END PAGE HEADER-->
		<!-- BEGIN DASHBOARD STATS -->
		
		<!-- END DASHBOARD STATS -->
		<div class="clearfix">
		</div>
	    <div class="row">
            @foreach($total as $key => $val)
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat {{$val['class']}}">
    				<div class="visual">
    					<i class="{{$val['icon']}}"></i>
    				</div>
    				<div class="details">
    					<div class="number">
    						 {{$val['total']}}
    					</div>
    					<div class="desc">
    					   {{$val['name']}}	 
    					</div>
    				</div>
    				<a class="more" href="{{ $val['action']}}">
    				View more <i class="m-icon-swapright m-icon-white"></i>
    				</a>
    			</div>
            </div>
		  @endforeach
        </div>   	
	</div>
</div>
@endsection