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
	<div class='container my-5 p-5'>

		<div class="row">
			<div class="col-2"></div>
			<div class="col">
				@if($errors->any())
				    <div class="alert alert-danger mb-5 rounded-0">
				        <ul class='list-unstyled'>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@elseif(Session::has("successmessage"))
				<div class="alert alert-success rounded-0">
					{{ Session::get('successmessage') }}
				</div>
				@endif



			</div>
			<div class="col-4"></div>
		</div>

	

		<div class='row mb-5'>
			<div class="col-2"></div>
			<div class='col'>
				<!-- <h1>Item Details</h1> -->
				<div class='d-flex flex-lg-row flex-md-row flex-sm-column'>
					<div><img src="{{ $itemdetails->image_path }}" class='img-fluid thumbnail'></div>
					<div class='d-flex flex-column ml-4 mt-5'>
						<h1>{{ $itemdetails->name }} </h1>
						<h3 class='mb-4'><span>₱ </span>{{ number_format($itemdetails->price, 2, '.', ',') }} </h3>
						<div class='mb-5'>{{ $itemdetails->description }} </div>
						

						<div class='d-flex flex-row'>
							<a href='#' class='btn border btn-lg rounded-0 bg-dark text-light mr-3 px-5'onclick="openEditModal({{ $itemdetails->id}}, '{{ $itemdetails->name }}')" data-toggle='modal'>EDIT</a>
							<a href='#' class='btn border btn-lg rounded-0 mr-3' 
								onclick="openDeleteModal({{ $itemdetails->id}}, '{{ $itemdetails->name }}')" data-toggle='modal'>DELETE</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-3"></div>
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

<!-- EDIT MODAL -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
	      	<div class="modal-header p-5">
		        <h3 class="modal-title" id="editModalLabel">Update this item?</h3>
		       
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	        </div>
	      	<form method='POST' id='editItemForm' enctype='multipart/form-data'>
			    {{ csrf_field() }}
			    {{ method_field('PATCH') }}
		      	<div class="modal-body d-flex flex-column p-5">
		        
			       
				  	<div class="form-group">
					    <label for="name">Name</label>
					    <input type="text" class="form-control rounded-0" id="name" name='name' value='{{ $itemdetails->name }}'>
					</div>

					<div class="form-group">
					    <label for="description">Description</label><textarea type="text" class="form-control" id="description" name='description'>{{ $itemdetails->description }}</textarea></div>

					<div class="form-group">
					    <label for="price">Price</label>
					    <div class="input-group">
					    	<div class="input-group-prepend">
				        		<div class="input-group-text rounded-0">₱</div>
				        	</div>
				        	<input type="number" class="form-control rounded-0" id="price" name='price' value='{{ $itemdetails->price }}' min=1>
				        </div>
					</div>

					<div class="form-group">
					    <label for="category">Category</label>
					    <select class='form-control rounded-0' name='category' id='category'>
					    	@foreach($categories as $category)
					    	@if($itemdetails->category_id == $category->id)
					    	<option value='{{ $category->id }}' selected>{{ $category->name }}</option>
					    	@else 
					    	<option value='{{ $category->id }}'>{{ $category->name }}</option>
					    	@endif
					    	@endforeach
					    </select>
					</div>

					<div class="form-group">
					    <label for="image_path">Upload Image</label>
					    <input type="file" class="form-control-file p-2 border rounded-0" id="image_path" name='image_path' value='{{ $itemdetails->image_path }}'>
					</div>

				</div>
				<div class="modal-footer p-5">
				  	<button type='submit' class='btn btn-lg bg-dark text-light rounded-0'>SAVE CHANGES</button>
					<button type="button" class="btn btn-lg border rounded-0" data-dismiss="modal">Close</button>
				</div>
	     	</form>
    	</div>
  	</div>
</div>


<!-- JS -->

<script type="text/javascript">
	function openDeleteModal(id,name){
		$('#deleteItem').attr('action','/itemdelete/' + id);
		$('#itemDel').html("Do you want to delete " + name + "?");
		$('#deleteModal').modal('show');
	}

	function openEditModal(taskid, name){
		$('#editItemForm').attr('action', '/menu/' + taskid);
		$('#editModal').modal('show');
	}

</script>

</body>
</html>