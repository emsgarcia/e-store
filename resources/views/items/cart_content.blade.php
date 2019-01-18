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
<body>
	<div class='container-fluid my-5 p-5'>

		<!-- NOTIFICATION -->
		<div class="row">
			<div class="col">

				@if(Session::has("deletemessage"))
				<div class="alert alert-danger rounded-0">
					{{ Session::get('deletemessage') }}
				</div>
				@endif

			</div>
		</div>

		<div class='row mb-5'>
			<div class='col-1'></div>
			<div class='col'>
				<h3>Cart Items</h3>
			</div>
			<div class='col-1'></div>
		</div>

		<div class='row mb-5'>
			<div class='col-1'></div>
			<div class='col'>
		
				<table class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th scope="col" width='25%'>Name</th>
							<th scope="col" width='25%'>Quantity</th>
							<th scope="col" width='25%'>Price</th>
							<th scope="col" width='25%'>Subtotal</th>
							<th scope="col" width='25%'>Action</th>
						</tr>
						</thead>
						<tbody>
						@foreach($item_cart as $item)
						<tr>
							<th scope="row">{{$item->name}}</th>
							<td> 
								<input class='rounded-0 text-center' value='{{ $item->quantity }}'>
							</td>
							<td>₱ {{ number_format($item->price, 2, '.', ',') }}</td>
							<td>₱ {{ number_format($item->subtotal, 2, '.', ',') }}</td>
							<td>
								<form method="POST" id='deleteCartItem'>
						      	{{ csrf_field() }}
						      	{{ method_field('DELETE') }}
									<button class='btn border rounded-0' onclick="openDeleteModal({{ $item->id}}, '{{ $item->name }}')" data-toggle='modal'>Delete</button>
								</form>
							</td>
						</tr>
						@endforeach



						<tr>
							<td colspan='3' class='font-weight-bold text-right'>TOTAL</th>
							<td colspan='2'>₱ {{ number_format($total, 2, '.', ',') }}</td>
						</tr>
						
					</tbody>
				</table>
			</div>
			<div class='col-1'></div>
		</div>

		<br><br><br><br><br><br>
		<div class='row mb-5'>
			<div class='col-1'></div>
			<div class='col text-center'>
				<a href='/catalog' class='btn btn-lg border-dark rounded-0'>
					<i class="fas fa-angle-double-left"></i>
					Go Back To Shopping
				</a>
			</div>
			<div class='col-1'></div>
		</div>


	</div>


<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
	      	<div class="modal-header p-5">
	        	<h3 class="modal-title" id="deleteModalLabel">Delete this item?</h3>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	      	</div>

				      
		      <form method="POST" id='deleteItem'>
			      	{{ csrf_field() }}
			      	{{ method_field('DELETE') }}
			        <div class="modal-body p-5">
				        <span id='itemDel'>Do you want to delete this item?</span>			  
				    </div>
			      <div class="modal-footer p-5">
			      <button type='submit' class='btn btn-lg bg-dark text-light rounded-0'>Delete</button>
			        <button type="button" class="btn btn-lg border rounded-0" data-dismiss="modal">Close</button>
			      </div>
		       </form>
      
    	</div>
  	</div>
</div>

<script type="text/javascript">
	function openDeleteModal(id,name){
		$('#deleteItem').attr('action','/itemdelete/' + id);
		$('#itemDel').html("Do you want to delete " + name + "?");
		$('#deleteModal').modal('show');
	}
</script>
</body>
</html>