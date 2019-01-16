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
				<!-- <h1>Item Details</h1> -->
				<div class='d-flex flex-row'>
					<div><img src="{{ $itemdetails->image_path }}" class='img-fluid thumbnail'></div>
					<div class='d-flex flex-column ml-4'>
						<h1>{{ $itemdetails->name }} </h1>
						<h3 class='mb-4'><span>₱</span>{{ $itemdetails->price }} </h3>
						<div class='mb-5'>{{ $itemdetails->description }} </div>
						

						<div class='d-flex flex-row'>
							<a href='#' class='btn btn-primary mr-3'onclick="openEditModal({{ $itemdetails->id}}, '{{ $itemdetails->name }}')" data-toggle='modal'>EDIT</a>
							<a href='#' class='btn btn-danger' 
								onclick="openDeleteModal({{ $itemdetails->id}}, '{{ $itemdetails->name }}')" data-toggle='modal'>DELETE</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title" id="deleteModalLabel">Delete this item?</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	      	</div>
	      
		      <form method="POST" id='deleteItem'>
			      	{{ csrf_field() }}
			      	{{ method_field('DELETE') }}
			        <div class="modal-body">
				        <span id='itemDel'>Do you want to delete this item?</span>			  
				    </div>
			      <div class="modal-footer">
			      <button type='submit' class='btn btn-danger'>Delete</button>
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			      </div>
		       </form>
      
    	</div>
  	</div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
		        <h5 class="modal-title" id="editModalLabel">Update This Task?</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	        </div>
	      	<form method="POST" id='editItemForm' enctype='multipart/form-data'>
			    {{ csrf_field() }}
			    {{ method_field('PUT') }}
		      	<div class="modal-body d-flex flex-column">
		        
			       
				  	<div class="form-group">
					    <label for="name">Name</label>
					    <input type="text" class="form-control" id="name" name='name'>
					</div>

					<div class="form-group">
					    <label for="description">Description</label><textarea type="text" class="form-control" id="description" name='description'></textarea></div>

					<div class="form-group">
					    <label for="price">Price</label>
					    <input type="number" class="form-control" id="price" name='price'>
					</div>

					<div class="form-group">
					    <label for="image_path">Upload Image</label>
					    <input type="file" class="form-control-file p-2 border rounded" id="image_path" name='image_path'>
					</div>


				</div>
				<div class="modal-footer">
				  	<button type='submit' class='btn btn-primary'>SAVE CHANGES</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

	function openEditModal(id, name){
		$('#editItemForm').attr('action', '/itemupdate/' + id);
		$('#editModal').modal('show');
	}

</script>

</body>
</html>