@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
	    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
	    <span class="alert-text">
	    	{{ session('success') }}
	    </span>
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	    </button>
	</div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
	    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
	    <span class="alert-text">
	    	{{ session('error') }}
	    </span>
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	    </button>
	</div>
@endif
