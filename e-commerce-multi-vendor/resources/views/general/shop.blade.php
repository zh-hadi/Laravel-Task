<style>
    .sidebar {
        width: 250px;
        background: #f8f9fa;
        padding: 15px;
    }

    .content {
        flex: 1;
        padding: 15px;
    }
    .cd-cart__details{
        padding-top:0 !important;
    }

    @media (max-width: 768px) {
        .sidebar {
            display: none;
        }

        .sidebar.show {
            display: block;
        }
    }
</style>
<link rel="stylesheet" href="{{asset('cart/css/style.css')}}">
@extends('layouts.bootstrap-layout')

@section('title', 'Shop Page')

@section('content')
<div class="d-flex">
    <div class="sidebar bg-light" id="sidebar">
        <h4>Categories</h4>
        <form action="{{url('shop')}}" method="post">
        @csrf
        <div class="container">
        @foreach($categories as $category)
        <div class="form-check">
            @if($category_id_arr && in_array($category->id, $category_id_arr))
                <input class="form-check-input" type="checkbox" onclick="filter_category()" name="category_id" checked value="{{$category->id}}" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    {{$category->name}}
                </label>
            @else
                <input class="form-check-input" type="checkbox" onclick="filter_category()" name="category_id" value="{{$category->id}}" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                {{$category->name}}
            </label>
            @endif          
        </div>
        @endforeach
        </div>

        <br><br>
        <input type="hidden" name="category_ids" id="category_ids">
        <input type="submit" class="btn btn-primary" value="Filter">
        </form>
    </div>
    <div class="content">
        <button class="btn btn-primary mb-3 d-md-none" type="button" id="sidebarToggle">
            Toggle Sidebar
        </button>
        <h2>Products</h2>
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{$product->image}}" class="card-img-top" alt="{{$product->name}}">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <p class="card-text">BDT {{$product->price}}</p>
                        <p class="card-text">Category: {{$product->c_name}}</p>
                        @csrf
                        <a href="#" class="cd-add-to-cart js-cd-add-to-cart" data-name="{{$product->name}}"  data-price="{{$product->price}}" data-pimage='{{$product->image}}' data-id='{{$product->id}}' data-userid='{{$user_id}}' data-csrf='{{csrf_token()}}'>Add to Cart</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{ $products->links() }}
    </div>
</div>
<div class="cd-cart cd-cart--empty js-cd-cart">
	<a href="#0" class="cd-cart__trigger text-replace">
		Cart
		<ul class="cd-cart__count"> <!-- cart items count -->
			<li>0</li>
			<li>0</li>
		</ul> <!-- .cd-cart__count -->
	</a>

	<div class="cd-cart__content">
		<div class="cd-cart__layout">
			<header class="cd-cart__header">
				<h2>Cart</h2>
				<span class="cd-cart__undo">Item removed. <a href="#0">Undo</a></span>
			</header>
			
			<div class="cd-cart__body">
				<ul>
					<!-- products added to the cart will be inserted here using JavaScript -->
				</ul>
			</div>

			<footer class="cd-cart__footer">
				<a href="#0" class="cd-cart__checkout">
          <em>Checkout - BDT <span>0</span>
            <svg class="icon icon--sm" viewBox="0 0 24 24"><g fill="none" stroke="currentColor"><line stroke-width="2" stroke-linecap="round" stroke-linejoin="round" x1="3" y1="12" x2="21" y2="12"/><polyline stroke-width="2" stroke-linecap="round" stroke-linejoin="round" points="15,6 21,12 15,18 "/></g>
            </svg>
          </em>
        </a>
			</footer>
		</div>
	</div> <!-- .cd-cart__content -->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function filter_category() {
        var category_id = document.forms[0];
        var txt = "";
        var i;
        for (i = 0; i < category_id.length; i++) {
            if (category_id[i].checked) {
            txt = txt + category_id[i].value + ",";
            }
        }
        document.getElementById("category_ids").value = txt.replace(/,\s*$/, "");;
    }
    $(document).ready(function() {
        $('#sidebarToggle').on('click', function() {
            $('#sidebar').toggleClass('show').animate();
        });
        
    });
 
</script>
<script src="{{asset('cart/js/util.js')}}"></script>
<script src="{{asset('cart/js/main.js')}}"></script>
@endsection
