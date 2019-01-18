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
			<div class="col">

				@if($errors->any())
				    <div class="alert alert-danger mb-5 rounded-0">
				        <ul class='list-unstyled'>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif

				
			</div>
		</div>
		

		<div class='row mb-5'>
			<div class="col-4"></div>
			<div class='col d-flex flex-column border p-5'>
				<h1 class='text-center mb-5'>Add New Item</h1>

				<form action='/menu/add' method='POST' enctype='multipart/form-data'>
				{{ csrf_field() }} 

					<div class="form-group">
					    <label for="name">Name</label>
					    <input type="text" class="form-control rounded-0" id="name" name='name'>
					 </div>

					 <div class="form-group">
					    <label for="description">Description</label><textarea type="text" class="form-control rounded-0" id="description" name='description'></textarea></div>

					 <div class="form-group">
					    <label for="price">Price</label>
					    <div class="input-group">
					    	<div class="input-group-prepend">
				        		<div class="input-group-text rounded-0">₱</div>
				        	</div>
					    	<input type="number" class="form-control rounded-0" id="price" name='price' min=1>
					    </div>
					 </div>

					 <div class="form-group">
					    <label for="category">Category</label>
					    <select class='form-control rounded-0' name='category' id='category'>
					    	@foreach($categories as $category)
					    	<option value='{{ $category->id }}'>{{ $category->name }}</option>
					    	@endforeach
					    </select>
					</div>

					 <div class="form-group">
					    <label for="image_path">Upload Image</label>
					    <input type="file" class="form-control-file p-2 border rounded-0" id="image_path" name='image_path'>
					  </div>

					  <button class='btn btn-lg bg-dark text-light rounded-0 btn-block mt-5' id='btn_addItem'>+ Add New Item</button>
				</form>
			</div>
			<div class="col-4"></div>
		</div>

	</div>


	
</body>
</html>