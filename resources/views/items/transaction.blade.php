<!DOCTYPE html>
<html>
<head>
	<title>
		Laravel E-commerce
	</title>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

	<!-- BOOTSTRAP CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

	<!-- JQUERY -->
	<script
	  src="https://code.jquery.com/jquery-3.3.1.min.js"
	  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	  crossorigin="anonymous"></script>


	<!-- POPPER -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

	<!-- BOOTSTRAP JS -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</head>
<style>

input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}

</style>
<body>
	<div class='container-fluid my-5 p-5'>

		<!-- NOTIFICATION -->
		<div class="row">
			<div class="col">

				@if(Session::has("successmessage"))
				<div class="alert alert-success rounded-0">
					{{ Session::get('successmessage') }}
				</div>
				@elseif(Session::has("deletemessage"))
				<div class="alert alert-danger rounded-0">
					{{ Session::get('deletemessage') }}
				</div>
				@endif

			</div>
		</div>

		<div class='row mb-5'>
			<div class='col-1'></div>
			<div class='col'>
				<h3>Transaction Summary</h3>
			</div>
			<div class='col-1'></div>
		</div>

	
		<div class='row mb-5'>
			<div class='col-1'></div>
			<div class='col'>
		
				<table class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th scope="col" width='25%'>Order Id</th>
							<th scope="col" width='25%'>Date</th>
							<th scope="col" width='25%'>Item</th>
							<th scope="col" width='25%'>Quantity</th>
						</tr>
						</thead>
						<tbody>
						@foreach($orders as $order)
						@foreach($order->items as $item_order)
						<tr>
							<th scope="row">{{ $order->id }}</th>
							<td>{{ $item_order->pivot->created_at->diffForHumans() }}</td>
							<!-- name is not in item_order table. it is int item table that is accessed by eloquent -->
							<td>{{ $item_order->name }}</td>
							<td>{{ $item_order->pivot->quantity }}</td>
							
						</tr>
						@endforeach
						@endforeach


						

						
						
					</tbody>



				</table>
				


			</div>

			<div class='col-1'></div>
		</div>




		
		<div class='row mb-5'>
			<div class='col-1'></div>
			<div class='col text-center'>
				<a href='/catalog' class='btn btn-lg border-dark rounded-0'>
					<i class="fas fa-angle-double-left"></i>
					Go Back To Shopping
				</a>
				<a href="/checkout" class='btn btn-lg border-dark bg-dark text-light font-weight-bold rounded-0'>
					Check Out
				</a>
			</div>
			<div class='col-1'></div>
		</div>


	</div>




</body>
</html>