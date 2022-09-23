@extends('layouts.app')


@section('title', 'Welcome')


@section('content')
<!DOCTYPE html>
<html lang="en">


<body>



  <!-- category start -->
  {{--
  <section class="category-section top-space">
    <ul class="category-slide">
      <li>
        <a href="inner-category.html" class="category-box">
          <img src="assets/images/top-category/kids.png" class="img-fluid" alt="">
          <h4>Kids</h4>
        </a>
      </li>
      <li>
        <a href="inner-category.html" class="category-box">
          <img src="assets/images/top-category/beauty.png" class="img-fluid" alt="">
          <h4>beauty</h4>
        </a>
      </li>
      <li>
        <a href="inner-category.html" class="category-box">
          <img src="assets/images/top-category/shoes.png" class="img-fluid" alt="">
          <h4>footwear</h4>
        </a>
      </li>
      <li>
        <a href="inner-category.html" class="category-box">
          <img src="assets/images/top-category/jewelry.png" class="img-fluid" alt="">
          <h4>jewelry</h4>
        </a>
      </li>
      <li>
        <a href="inner-category.html" class="category-box">
          <img src="assets/images/top-category/women.png" class="img-fluid" alt="">
          <h4>Women</h4>
        </a>
      </li>
      <li>
        <a href="inner-category.html" class="category-box">
          <img src="assets/images/top-category/men.png" class="img-fluid" alt="">
          <h4>men</h4>
        </a>
      </li>
    </ul>
  </section>
  <div class="divider t-12 b-20"></div>
  --}}
  <!-- category end -->

{{--
  <!-- home slider start -->
  <section class="pt-0 home-section ratio_55">
    <div class="home-slider slick-default theme-dots">
      <div>
        <div class="slider-box">
          <img src="assets/images/home-slider/1.jpg" class="img-fluid bg-img" alt="">
          <div class="slider-content">
            <div>
              <h2>Welcome To Multikart</h2>
              <h1>Flat 50% OFF</h1>
              <h6>Free Shipping Till Mid Night</h6>
              <a href="shop.html" class="btn btn-solid">SHOP NOW</a>
            </div>
          </div>
        </div>
      </div>
      <div>
        <div class="slider-box">
          <img src="assets/images/home-slider/2.jpg" class="img-fluid bg-img" alt="">
          <div class="slider-content">
            <div>
              <h2>Welcome To Multikart</h2>
              <h1>Flat 50% OFF</h1>
              <h6>Free Shipping Till Mid Night</h6>
              <a href="shop.html" class="btn btn-solid">SHOP NOW</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  --}}
  <!-- home slider end -->


  <!-- deals section start -->
  <section class="deals-section px-15 pt-0">
    <div class="title-part">
      <h2>الاخبار</h2>
      <a href="shop.html">جميع الاخبار</a>
    </div>
    <div class="product-section">
      <div class="row gy-3">
        @foreach ($news as $new)
        <div id="news_data">
            @include('news.news_data')
        </div>

        @endforeach




      </div>
    </div>
  </section>
  <div class="divider"></div>
  <!-- deals section end -->

{{--
  <!-- tab section start -->
  <section class="pt-0 tab-section">
    <div class="title-section px-15">
      <h2>Find your Style</h2>
      <h3>Super Summer Sale</h3>
    </div>
    <div class="tab-section">
      <ul class="nav nav-tabs theme-tab pl-15">
        <li class="nav-item">
          <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#trending" type="button">Trending
            Now</button>
        </li>
        <li class="nav-item">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#top" type="button">Top Picks</button>
        </li>
        <li class="nav-item">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#featured" type="button">Featured
            Products</button>
        </li>
        <li class="nav-item">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#rated" type="button">Top Rated</button>
        </li>
        <li class="nav-item">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#ship" type="button">Ready to ship</button>
        </li>
      </ul>
      <div class="tab-content px-15">
        <div class="tab-pane fade show active" id="trending">
          <div class="row gy-3 gx-3">
            <div class="col-md-4 col-6">
              <div class="product-box ratio_square">
                <div class="img-part">
                  <a href="product.html"><img src="assets/images/products/4.jpg" alt="" class="img-fluid bg-img"></a>
                  <div class="wishlist-btn">
                    <i class="iconly-Heart icli"></i>
                    <i class="iconly-Heart icbo"></i>
                    <div class="effect-group">
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <ul class="ratings">
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo empty"></i></li>
                  </ul>
                  <a href="product.html">
                    <h4>Blue Denim Jacket</h4>
                  </a>
                  <div class="price">
                    <h4>$32.00 <del>$35.00</del><span>20%</span></h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-6">
              <div class="product-box ratio_square">
                <div class="img-part">
                  <a href="product.html"><img src="assets/images/products/5.jpg" alt="" class="img-fluid bg-img"></a>
                  <div class="wishlist-btn">
                    <i class="iconly-Heart icli"></i>
                    <i class="iconly-Heart icbo"></i>
                    <div class="effect-group">
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <ul class="ratings">
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo empty"></i></li>
                  </ul>
                  <a href="product.html">
                    <h4>Blue Denim Jacket</h4>
                  </a>
                  <div class="price">
                    <h4>$32.00 <del>$35.00</del><span>20%</span></h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-6">
              <div class="product-box ratio_square">
                <div class="img-part">
                  <a href="product.html"><img src="assets/images/products/6.jpg" alt="" class="img-fluid bg-img"></a>
                  <div class="wishlist-btn">
                    <i class="iconly-Heart icli"></i>
                    <i class="iconly-Heart icbo"></i>
                    <div class="effect-group">
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <ul class="ratings">
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo empty"></i></li>
                  </ul>
                  <a href="product.html">
                    <h4>Blue Denim Jacket</h4>
                  </a>
                  <div class="price">
                    <h4>$32.00 <del>$35.00</del><span>20%</span></h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-6">
              <div class="product-box ratio_square">
                <div class="img-part">
                  <a href="product.html"><img src="assets/images/products/7.jpg" alt="" class="img-fluid bg-img"></a>
                  <div class="wishlist-btn">
                    <i class="iconly-Heart icli"></i>
                    <i class="iconly-Heart icbo"></i>
                    <div class="effect-group">
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <ul class="ratings">
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo empty"></i></li>
                  </ul>
                  <a href="product.html">
                    <h4>Blue Denim Jacket</h4>
                  </a>
                  <div class="price">
                    <h4>$32.00 <del>$35.00</del><span>20%</span></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="top">
          <div class="row gy-3 gx-3">
            <div class="col-6">
              <div class="product-box ratio_square">
                <div class="img-part">
                  <a href="product.html"><img src="assets/images/products/6.jpg" alt="" class="img-fluid bg-img"></a>
                  <div class="wishlist-btn">
                    <i class="iconly-Heart icli"></i>
                    <i class="iconly-Heart icbo"></i>
                    <div class="effect-group">
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <ul class="ratings">
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo empty"></i></li>
                  </ul>
                  <a href="product.html">
                    <h4>Blue Denim Jacket</h4>
                  </a>
                  <div class="price">
                    <h4>$32.00 <del>$35.00</del><span>20%</span></h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="product-box ratio_square">
                <div class="img-part">
                  <a href="product.html"><img src="assets/images/products/7.jpg" alt="" class="img-fluid bg-img"></a>
                  <div class="wishlist-btn">
                    <i class="iconly-Heart icli"></i>
                    <i class="iconly-Heart icbo"></i>
                    <div class="effect-group">
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <ul class="ratings">
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo empty"></i></li>
                  </ul>
                  <a href="product.html">
                    <h4>Blue Denim Jacket</h4>
                  </a>
                  <div class="price">
                    <h4>$32.00 <del>$35.00</del><span>20%</span></h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="product-box ratio_square">
                <div class="img-part">
                  <a href="product.html"><img src="assets/images/products/4.jpg" alt="" class="img-fluid bg-img"></a>
                  <div class="wishlist-btn">
                    <i class="iconly-Heart icli"></i>
                    <i class="iconly-Heart icbo"></i>
                    <div class="effect-group">
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <ul class="ratings">
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo empty"></i></li>
                  </ul>
                  <a href="product.html">
                    <h4>Blue Denim Jacket</h4>
                  </a>
                  <div class="price">
                    <h4>$32.00 <del>$35.00</del><span>20%</span></h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="product-box ratio_square">
                <div class="img-part">
                  <a href="product.html"><img src="assets/images/products/5.jpg" alt="" class="img-fluid bg-img"></a>
                  <div class="wishlist-btn">
                    <i class="iconly-Heart icli"></i>
                    <i class="iconly-Heart icbo"></i>
                    <div class="effect-group">
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <ul class="ratings">
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo empty"></i></li>
                  </ul>
                  <a href="product.html">
                    <h4>Blue Denim Jacket</h4>
                  </a>
                  <div class="price">
                    <h4>$32.00 <del>$35.00</del><span>20%</span></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="featured">
          <div class="row gy-3 gx-3">
            <div class="col-6">
              <div class="product-box ratio_square">
                <div class="img-part">
                  <a href="product.html"><img src="assets/images/products/7.jpg" alt="" class="img-fluid bg-img"></a>
                  <div class="wishlist-btn">
                    <i class="iconly-Heart icli"></i>
                    <i class="iconly-Heart icbo"></i>
                    <div class="effect-group">
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <ul class="ratings">
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo empty"></i></li>
                  </ul>
                  <a href="product.html">
                    <h4>Blue Denim Jacket</h4>
                  </a>
                  <div class="price">
                    <h4>$32.00 <del>$35.00</del><span>20%</span></h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="product-box ratio_square">
                <div class="img-part">
                  <a href="product.html"><img src="assets/images/products/4.jpg" alt="" class="img-fluid bg-img"></a>
                  <div class="wishlist-btn">
                    <i class="iconly-Heart icli"></i>
                    <i class="iconly-Heart icbo"></i>
                    <div class="effect-group">
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <ul class="ratings">
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo empty"></i></li>
                  </ul>
                  <a href="product.html">
                    <h4>Blue Denim Jacket</h4>
                  </a>
                  <div class="price">
                    <h4>$32.00 <del>$35.00</del><span>20%</span></h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="product-box ratio_square">
                <div class="img-part">
                  <a href="product.html"><img src="assets/images/products/5.jpg" alt="" class="img-fluid bg-img"></a>
                  <div class="wishlist-btn">
                    <i class="iconly-Heart icli"></i>
                    <i class="iconly-Heart icbo"></i>
                    <div class="effect-group">
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <ul class="ratings">
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo empty"></i></li>
                  </ul>
                  <a href="product.html">
                    <h4>Blue Denim Jacket</h4>
                  </a>
                  <div class="price">
                    <h4>$32.00 <del>$35.00</del><span>20%</span></h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="product-box ratio_square">
                <div class="img-part">
                  <a href="product.html"><img src="assets/images/products/6.jpg" alt="" class="img-fluid bg-img"></a>
                  <div class="wishlist-btn">
                    <i class="iconly-Heart icli"></i>
                    <i class="iconly-Heart icbo"></i>
                    <div class="effect-group">
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <ul class="ratings">
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo empty"></i></li>
                  </ul>
                  <a href="product.html">
                    <h4>Blue Denim Jacket</h4>
                  </a>
                  <div class="price">
                    <h4>$32.00 <del>$35.00</del><span>20%</span></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="rated">
          <div class="row gy-3 gx-3">
            <div class="col-6">
              <div class="product-box ratio_square">
                <div class="img-part">
                  <a href="product.html"><img src="assets/images/products/5.jpg" alt="" class="img-fluid bg-img"></a>
                  <div class="wishlist-btn">
                    <i class="iconly-Heart icli"></i>
                    <i class="iconly-Heart icbo"></i>
                    <div class="effect-group">
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <ul class="ratings">
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo empty"></i></li>
                  </ul>
                  <a href="product.html">
                    <h4>Blue Denim Jacket</h4>
                  </a>
                  <div class="price">
                    <h4>$32.00 <del>$35.00</del><span>20%</span></h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="product-box ratio_square">
                <div class="img-part">
                  <a href="product.html"><img src="assets/images/products/4.jpg" alt="" class="img-fluid bg-img"></a>
                  <div class="wishlist-btn">
                    <i class="iconly-Heart icli"></i>
                    <i class="iconly-Heart icbo"></i>
                    <div class="effect-group">
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <ul class="ratings">
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo empty"></i></li>
                  </ul>
                  <a href="product.html">
                    <h4>Blue Denim Jacket</h4>
                  </a>
                  <div class="price">
                    <h4>$32.00 <del>$35.00</del><span>20%</span></h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="product-box ratio_square">
                <div class="img-part">
                  <a href="product.html"><img src="assets/images/products/7.jpg" alt="" class="img-fluid bg-img"></a>
                  <div class="wishlist-btn">
                    <i class="iconly-Heart icli"></i>
                    <i class="iconly-Heart icbo"></i>
                    <div class="effect-group">
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <ul class="ratings">
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo empty"></i></li>
                  </ul>
                  <a href="product.html">
                    <h4>Blue Denim Jacket</h4>
                  </a>
                  <div class="price">
                    <h4>$32.00 <del>$35.00</del><span>20%</span></h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="product-box ratio_square">
                <div class="img-part">
                  <a href="product.html"><img src="assets/images/products/6.jpg" alt="" class="img-fluid bg-img"></a>
                  <div class="wishlist-btn">
                    <i class="iconly-Heart icli"></i>
                    <i class="iconly-Heart icbo"></i>
                    <div class="effect-group">
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <ul class="ratings">
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo empty"></i></li>
                  </ul>
                  <a href="product.html">
                    <h4>Blue Denim Jacket</h4>
                  </a>
                  <div class="price">
                    <h4>$32.00 <del>$35.00</del><span>20%</span></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="ship">
          <div class="row gy-3 gx-3">
            <div class="col-6">
              <div class="product-box ratio_square">
                <div class="img-part">
                  <a href="product.html"><img src="assets/images/products/4.jpg" alt="" class="img-fluid bg-img"></a>
                  <div class="wishlist-btn">
                    <i class="iconly-Heart icli"></i>
                    <i class="iconly-Heart icbo"></i>
                    <div class="effect-group">
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <ul class="ratings">
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo empty"></i></li>
                  </ul>
                  <a href="product.html">
                    <h4>Blue Denim Jacket</h4>
                  </a>
                  <div class="price">
                    <h4>$32.00 <del>$35.00</del><span>20%</span></h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="product-box ratio_square">
                <div class="img-part">
                  <a href="product.html"><img src="assets/images/products/6.jpg" alt="" class="img-fluid bg-img"></a>
                  <div class="wishlist-btn">
                    <i class="iconly-Heart icli"></i>
                    <i class="iconly-Heart icbo"></i>
                    <div class="effect-group">
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <ul class="ratings">
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo empty"></i></li>
                  </ul>
                  <a href="product.html">
                    <h4>Blue Denim Jacket</h4>
                  </a>
                  <div class="price">
                    <h4>$32.00 <del>$35.00</del><span>20%</span></h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="product-box ratio_square">
                <div class="img-part">
                  <a href="product.html"><img src="assets/images/products/7.jpg" alt="" class="img-fluid bg-img"></a>
                  <div class="wishlist-btn">
                    <i class="iconly-Heart icli"></i>
                    <i class="iconly-Heart icbo"></i>
                    <div class="effect-group">
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <ul class="ratings">
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo empty"></i></li>
                  </ul>
                  <a href="product.html">
                    <h4>Blue Denim Jacket</h4>
                  </a>
                  <div class="price">
                    <h4>$32.00 <del>$35.00</del><span>20%</span></h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="product-box ratio_square">
                <div class="img-part">
                  <a href="product.html"><img src="assets/images/products/5.jpg" alt="" class="img-fluid bg-img"></a>
                  <div class="wishlist-btn">
                    <i class="iconly-Heart icli"></i>
                    <i class="iconly-Heart icbo"></i>
                    <div class="effect-group">
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                      <span class="effect"></span>
                    </div>
                  </div>
                </div>
                <div class="product-content">
                  <ul class="ratings">
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo"></i></li>
                    <li><i class="iconly-Star icbo empty"></i></li>
                  </ul>
                  <a href="product.html">
                    <h4>Blue Denim Jacket</h4>
                  </a>
                  <div class="price">
                    <h4>$32.00 <del>$35.00</del><span>20%</span></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- tab section end -->
 --}}

</body>

</html>
@endsection
