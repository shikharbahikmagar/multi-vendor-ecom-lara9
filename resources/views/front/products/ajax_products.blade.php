<?php 
    use App\Models\Product; 
    $product_image_path = 'admin/images/product_images/small/'; 
 ?>
<div class="row product-container grid-style">
    @foreach($categoryProducts as $product)
    <div class="product-item col-lg-4 col-md-6 col-sm-6">
        <div class="item">
            <div class="image-container">
                <a class="item-img-wrapper-link" href="single-product.html">
                    <img class="img-fluid" src="{{ url($product_image_path.$product['product_image']) }}" alt="Product">
                </a>
                <div class="item-action-behaviors">
                    <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                    <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                    <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                </div>
            </div>
            <div class="item-content">
                <div class="what-product-is">
                    <ul class="bread-crumb">
                        <li class="has-separator">
                            <a href="shop-v1-root-category.html">{{ $product['product_code'] }}</a>
                        </li>
                        <li class="has-separator">
                            <a href="listing.html">{{ $product['product_color'] }}</a>
                        </li>
                        <li>
                            <a href="shop-v3-sub-sub-category.html">{{ $product['brand']['name'] }}</a>
                        </li>
                    </ul>
                    <h6 class="item-title">
                        <a href="single-product.html">{{ $product['product_name'] }}</a>
                    </h6>
                    <div class="item-description">
                        <p>{{ $product['description'] }}</p>
                    </div>
                    <div class="item-stars">
                        <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                            <span style='width:67px'></span>
                        </div>
                        <span>(23)</span>
                    </div>
                </div>
                <?php $discounted_price = Product::getDiscountedPrice($product['id']); ?>
                @if($discounted_price>0)
                <div class="price-template">
                    <div class="item-new-price">
                        {{ $discounted_price }}
                    </div>
                    <div class="item-old-price">
                        {{ $product['product_price'] }}
                    </div>
                </div>
                @else
                <div class="price-template">
                    <div class="item-old-price">
                        <!-- {{ $product['product_price'] }} -->
                    </div>
                </div>
                @endif
            </div>
            <?php $isNewProduct = Product::isProductNew($product['id']);  ?>
            <!-- @if($isNewProduct == "Yes") -->
            <div class="tag new">
                <span>NEW</span>
            </div>
            <!-- @endif -->
        </div>
    </div>
    @endforeach
</div>