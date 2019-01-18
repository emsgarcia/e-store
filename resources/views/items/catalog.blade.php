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
		
		<div class='row mb-5'>
			<div class="col-lg-1 col-md-1"></div>
			<div class='col-lg-2 col-md-3 col-sm-12'>
				<h1>Catalog</h1>
				<h3>Categories</h3>
				@foreach($categories as $category)
				<div><a href="#" id='{{ $category->id }}'>{{ $category->name }}</a></div>
				@endforeach
			</div>
			

			<div class='col'>
				<div class='container-fluid'>

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

					<!-- ITEMS -->
					<div class='row mb-5'>
						<!-- <div class="col"> -->
							@foreach($items as $item)
							<div class="card col-lg-3 col-md-4 col-sm-6 mx-2 my-4 p-0 rounded-0 border-0">
								<form method='POST' action='/addToCart/{{$item->id}}'>
											{{ csrf_field() }}
								    <img class="card-img-top" src="{{ $item->image_path }}" alt="Card image cap" style='width:100%;height:200px;'>
								    <div class="card-body">
										<h5 class="card-title font-weight-bold">
											<a href="/menu/{{ $item->id }}">
												{{ $item->name }}
											</a>
										</h5>
										<p class="card-text">₱ {{ number_format($item->price, 2, '.', ',')}}</p>
										<p class="card-text">{{ $item->description}}</p>
										
											<div class="input-group mb-3">
												<input type="number" name='quantity' id='quantity' class="form-control rounded-0" aria-label="quantity" aria-describedby="quantity" min=1>
											</div>
									

								    </div>
								    <div class="card-footer border-0" style='background-color:white!important;'>
								      <button type='submit' class='btn btn-block bg-dark text-light rounded-0'>+ Add To Cart</button>
								    </div>
							   </form>
							</div>
							@endforeach
						<!-- </div> -->
					</div>

				</div>
			</div>

		</div>

		<hr>

		<div class='row d-flex flex-row'>
			<div class='col text-right'>
				<a href='/menu/add' class='btn btn-lg bg-dark text-light rounded-0' id='btn_add_item'>+ Add New Item</a>
			</div>

			<div class='col'>
				<a href='/showcart' class='btn btn-lg border-dark rounded-0'>
				<i class="fas fa-shopping-cart"></i>
				Show Cart
				</a>
			</div>
		</div>


	</div>






</body>
</html>

