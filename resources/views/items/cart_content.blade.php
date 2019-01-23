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
				<h3>Cart Items</h3>
			</div>
			<div class='col-1'></div>
		</div>

		@if($item_cart != null)
		<div class='row mb-5'>
			<div class='col-1'></div>
			<div class='col'>
		
				<table class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th scope="col" width='20%'>Name</th>
							<th scope="col" width='20%'>Quantity</th>
							<th scope="col" width='20%'>Price</th>
							<th scope="col" width='20%'>Subtotal</th>
							<th scope="col" width='20%'>Action</th>
						</tr>
						</thead>
						<tbody>
						@foreach($item_cart as $item)
						<tr>
							<th scope="row">{{$item->name}}</th>
							<td class='d-flex flex-row'> 
									<form method='POST' id='updateQuantity'>
										{{ csrf_field() }}
										{{ method_field('PATCH') }}
										<div class="input-group mb-3">
												<div class="input-group-prepend">
												    <button class="input-group-text rounded-0" onclick="minus({{ $item->id }})">
												    &#8722;
												    </button>
											   	</div>
											
											    <input type='number' class='rounded-0 text-center newquantity{{$item->id}}' name='newquantity' value='{{ $item->quantity }}' style='width:25%;' min='1'>	

											    <div class="input-group-prepend">
												    <button class="input-group-text rounded-0" onclick="plus({{ $item->id }})">
												    +
												    </button>
											   	</div>
										</div>
											<!-- <button class='btn rounded-0 border'>
												Update Quantity
											</button> -->
									</form>
								
							</td>
							<td>₱ {{ number_format($item->price, 2, '.', ',') }}</td>
							<td>₱ {{ number_format($item->subtotal, 2, '.', ',') }}</td>
							<td>
								
								<button class='btn border rounded-0' onclick="openDeleteModal({{ $item->id}}, '{{ $item->name }}')" data-toggle='modal'>Delete</button>
							
							</td>
						</tr>
						@endforeach


						<tr>
							<td colspan='3' class='font-weight-bold text-right'>TOTAL</th>
							@if(isset($total))
							<td colspan='2'>₱ {{ number_format($total, 2, '.', ',') }}</td>
							@endif
						</tr>

						
						
					</tbody>



				</table>
				<button class='btn btn-lg border rounded-0' onclick='openClearCartModal()' data-toggle='modal'>
					Clear Cart
				</button>


			</div>

			<div class='col-1'></div>
		</div>
		<br><br><br><br><br><br>
		@else
		<div class='row'>
			<div class="col text-center">
					Your cart as empty as your life. 
			</div>
		</div>
		<br>
		@endif



		
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


<!-- DELETE ITEM MODAL -->
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


<!-- DELETE CART MODAL -->
<div class="modal fade" id="deleteCartModal" tabindex="-1" role="dialog" aria-labelledby="deleteCartModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
	      	<div class="modal-header p-5">
	        	<h3 class="modal-title" id="deleteCartModalLabel">Clear This Cart</h3>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	      	</div>

			<div class="modal-body p-5">
			    <span>Do you want to clear this cart?</span>			  
			</div>
			<div class="modal-footer p-5">
			<form method="POST" id='deleteCart'>
					{{ csrf_field() }}
				<button type='submit' class='btn btn-lg bg-dark text-light rounded-0'>Delete</button>
				<button type="button" class="btn btn-lg border rounded-0" data-dismiss="modal">Close</button>
			</form>
			</div>

    	</div>
  	</div>
</div>

<script type="text/javascript">
	function openDeleteModal(id,name){
		// $('#deleteItem').attr('action','/itemdelete/' + id);
		$('#deleteItem').attr('action','/menu/mycart/' + id + '/delete');
		$('#itemDel').html("Do you want to delete " + name + "?");
		$('#deleteModal').modal('show');
	}

	function openClearCartModal(){
		$('#deleteCart').attr('action','/menu/clearcart');
		$('#deleteCartModal').modal('show');
	}

	function minus(id){
		$('#updateQuantity').attr('action', '/menu/mycart/' + id + '/changequantity');
		$value = $(".newquantity"+id).val();
		$value = parseInt($value);
		if($value > 1){
			$(".newquantity"+id).val($value-1);
		}
	}

	function plus(id){
		$('#updateQuantity').attr('action', '/menu/mycart/' + id + '/changequantity');
		$value = $(".newquantity"+id).val();
		$value = parseInt($value);
		$(".newquantity"+id).val($value+1);
	
	}


</script>
</body>
</html>