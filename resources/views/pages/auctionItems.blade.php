@extends('layouts.app')


@section('content')

	<!---  Active auctions grid --->
	<div class="album py-2">
	    <div class="row">
	      <!--- Items list -->
	      @each('partials.auctionItem', $auctions, 'auction')
	    </div>
	</div>

@endsection
