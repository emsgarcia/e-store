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
		<div class="row">
			<div class="col">
				<div class="alert bg-secondary text-light">
					{{ Session::get('successmessage') }}
				</div>
			</div>
		</div>
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
				<div><a href="/menu/{{ $item->id }}">{{ $item->name }}</a></div>
				@endforeach
				<a href='/menu/add' class='btn btn-lg bg-dark text-light rounded-0' id='btn_add_item'>+ Add New Item</a>
			</div>
		</div>
	</div>






</body>
</html>

