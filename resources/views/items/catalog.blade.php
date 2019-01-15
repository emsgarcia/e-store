<!DOCTYPE html>
<html>
<head>
	<title>
		Laravel E-commerce
	</title>

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
	<div class='container my-5 p-5'>
		<div class='row mb-5'>
			<div class='col'>
				<h1>Catalog</h1>
				<h3>Categories</h3>
				@foreach($categories as $category)
				<div><a href="#" id='{{ $category->id }}'>{{ $category->name }}</a></div>
				@endforeach

				<hr>

				<h3>Current Items</h3>
				@foreach($items as $item)
				<div><a href="#" id='{{ $item->id }}' >{{ $item->name }}</a></div>
				@endforeach
				<button type='button' class='btn btn-primary' onclick='openAddItemModal()' data-toggle='modal' id='btn_add_item'>+ Add New Item</button>
			</div>
		</div>
	</div>




	<!-- ADD TASK MODAL -->
	<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="addItemModalLabel">Add New Item?</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<form action='/add_items' method='POST'>
	      		{{ csrf_field() }} 
	      		<label>New Item:</label>
	      		<input type='text' name='add_items' id='add_items'></input>
	      		
	      		<button type="submit" class="btn btn-primary">Save changes</button>
	      	</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>



	<script type="text/javascript">
		function openAddItemModal(){
			$('#addItemModal').modal('show');
		}

	</script>



</body>
</html>
