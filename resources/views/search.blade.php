@extends('layouts.app')


@section('title', 'search')
@section('content')

<body>

    <!-- loader strat -->
    <div class="loader">
        <span></span>
        <span></span>
    </div>
    <!-- loader end -->

<br><br>
<br>
<br>
<br>



<form method="get" action="{{ route('SearchKeywords') }}">

    <!-- search panel start -->
    <div class="search-panel w-back pt-3 px-15">
        <a href="index.html" class="back-btn"><i class="iconly-Arrow-Left icli"></i></a>

        <div class="search-bar">
            <input type="text" class="form-control form-theme" name="Keywords[]"  placeholder="أدخل كلمة المفتاحية">
            <i class="iconly-Search icli search-icon">    <input type="submit" value="بحث">
            </i>
            <i class="iconly-Camera icli camera-icon"></i>
        </div>
    </div>

    <!-- search panel end -->
</form>









    <!-- panel space start -->
    <section class="panel-space"></section>
    <!-- panel space end -->


    <!-- latest jquery-->
    <script src="assets/js/jquery-3.3.1.min.js"></script>

    <!-- Bootstrap js-->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- Slick js-->
    <script src="assets/js/slick.js"></script>

    <!-- script js -->
    <script src="assets/js/script.js"></script>

</body>

@endsection








