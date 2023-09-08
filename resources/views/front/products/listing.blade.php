@extends('front.layouts.layout')
@section('content')
<!-- Page Introduction Wrapper -->
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Shop</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="index.html">Home</a>
                </li>
                <li class="is-marked">
                    <a href="listing.html">Shop</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Page Introduction Wrapper /- -->
<!-- Shop-Page -->
<div class="page-shop u-s-p-t-80">
    <div class="container">
        <!-- Shop-Intro -->
        <div class="shop-intro">
            <ul class="bread-crumb">
                <li class="has-separator">
                    <a href="index.html">Home</a>
                </li>
               <?php echo $catDetails['breadCrumbs']; ?>
            </ul>
        </div>
        <!-- Shop-Intro /- -->
        <div class="row">
            @include('front.products.filters')
            <!-- Shop-Right-Wrapper -->
            <div class="col-lg-9 col-md-9 col-sm-12">
                <!-- Page-Bar -->
                <div class="page-bar clearfix">
                    <!-- <div class="shop-settings">
                        <a id="grid-anchor" class="active">
                            <i class="fas fa-th"></i>
                        </a>
                        <a id="list-anchor">
                            <i class="fas fa-th-list"></i>
                        </a>
                    </div> -->
                    <!-- Toolbar Sorter 1  -->
                    <form name="sortProducts" id="sortProducts">
                        <input type="hidden" id="url" name="url" value = "{{ $url }}">
                    <div class="toolbar-sorter">
                        <div class="select-box-wrapper">
                            <label class="sr-only" for="sort-by">Sort By</label>
                            <select id="sort" name="sort" class="select-box" >
                                <option selected="selected" value="">select</option>
                                <option value="product_latest" @if(isset($_GET['sort']) && $_GET['sort'] == "product_latest") selected="" @endif>Sort By: Latest</option>
                                <option value="product_price_lowest" @if(isset($_GET['sort']) && $_GET['sort'] == "product_price_lowest") selected="" @endif>Sort By: Lowest Price</option>
                                <option value="product_price_highest" @if(isset($_GET['sort']) && $_GET['sort'] == "product_price_highest") selected="" @endif>Sort By: Highest Price</option>
                                <option value="product_a_z" @if(isset($_GET['sort']) && $_GET['sort'] == "product_a_z") selected="" @endif>Sort By: Name A to Z</option>
                                 <option value="product_z_a" @if(isset($_GET['sort']) && $_GET['sort'] == "product_z_a") selected="" @endif>Sort By: Name Z to A</option>
                            </select>
                        </div>
                    </div>
                    </form>
                    <!-- //end Toolbar Sorter 1  -->
                    <!-- Toolbar Sorter 2  -->
                    <div class="toolbar-sorter-2">
                        <div class="select-box-wrapper">
                            <label class="sr-only" for="show-records">Show Records Per Page</label>
                            <select class="select-box" id="show-records">
                                <option selected="selected" value="">Showing: {{ $productsCount }}</option>
                            </select>
                        </div>
                    </div>
                    <!-- //end Toolbar Sorter 2  -->
                </div>
                <!-- Page-Bar /- -->
                <!-- Row-of-Product-Container -->
                <div class="filter_products">
                    @include('front.products.ajax_products')
                </div>
                @if(isset($_GET['sort']) && !empty($_GET['sort']))
                <div>{{ $categoryProducts->appends(['sort'=>$_GET['sort']])->links() }}</div>
                @else
                <div>{{ $categoryProducts->links() }}</div>
                @endif
                <div>{{ $catDetails['catDetails']['description'] }}</div>
                <!-- Row-of-Product-Container /- -->

            </div>
            <!-- Shop-Right-Wrapper /- -->
            <!-- Shop-Pagination -->
            <!-- <div class="pagination-area">
                <div class="pagination-number">
                    <ul>
                        <li style="display: none">
                            <a href="shop-v1-root-category.html" title="Previous">
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                        <li class="active">
                            <a href="shop-v1-root-category.html">1</a>
                        </li>
                        <li>
                            <a href="shop-v1-root-category.html">2</a>
                        </li>
                        <li>
                            <a href="shop-v1-root-category.html">3</a>
                        </li>
                        <li>
                            <a href="shop-v1-root-category.html">...</a>
                        </li>
                        <li>
                            <a href="shop-v1-root-category.html">10</a>
                        </li>
                        <li>
                            <a href="shop-v1-root-category.html" title="Next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div> -->
            <!-- Shop-Pagination /- -->
        </div>
    </div>
</div>
<!-- Shop-Page /- -->

@endsection