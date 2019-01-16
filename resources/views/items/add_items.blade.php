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
			<div class='col d-flex flex-column'>
				<h1 class='text-center mb-5'>Add New Item</h1>

				@if($errors->any())
				    <div class="alert alert-danger mb-5">
				        <ul class='list-unstyled'>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif

				<form action='/menu/add' method='POST' enctype='multipart/form-data'>
				{{ csrf_field() }} 

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

					  <button class='btn btn-primary' id='btn_addItem'>+ Add New Item</button>
				</form>
			</div>
		</div>

	</div>


	
</body>
</html>