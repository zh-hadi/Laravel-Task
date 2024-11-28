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

    @media (max-width: 768px) {
        .sidebar {
            display: none;
        }

        .sidebar.show {
            display: block;
        }
    }
</style>
@extends('layouts.bootstrap-layout')

@section('title', 'Shop Page')

@section('content')
<div class="d-flex">
    <div class="sidebar bg-light" id="sidebar">
        <h4>Categories</h4>
        <form action="{{url('shop')}}" method="post">
        
        <div class="container">
        @foreach($categories as $category)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" onclick="filter_category()" name="category_id" value="{{$category->id}}" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                {{$category->name}}
            </label>
        </div>
            <!-- <div class="row">
                <div class="col-3">
                <input type="checkbox" onclick="filter_category()" name="category_id" value="{{$category->id}}">
                </div>
                <div class="col-9">
                {{$category->name}}
                </div>
            </div> -->
        @endforeach
        </div>
        <!-- <input type="button"  value="Filter"> -->
        <br><br>
        <input type="hidden" id="category_ids">
        <input type="submit" value="Submit">
        </form>
    </div>
    <div class="content">
        <button class="btn btn-primary mb-3 d-md-none" type="button" id="sidebarToggle">
            Toggle Sidebar
        </button>
        <h2>Products</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Product 1">
                    <div class="card-body">
                        <h5 class="card-title">Product 1</h5>
                        <p class="card-text">$10.00</p>
                        <a href="#" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Product 2">
                    <div class="card-body">
                        <h5 class="card-title">Product 2</h5>
                        <p class="card-text">$20.00</p>
                        <a href="#" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Product 3">
                    <div class="card-body">
                        <h5 class="card-title">Product 3</h5>
                        <p class="card-text">$30.00</p>
                        <a href="#" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
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