@extends('layouts.app-not-header')


@section('title', 'view')


@section('content')
<!DOCTYPE html>
<html lang="ar" dir="rtl">

    <!-- loader strat -->
    <div class="loader">
        <span></span>
        <span></span>
    </div>
    <!-- loader end -->


    <!-- header start -->
    <header>
        <div class="back-links">
            <a href="../">
                <i class="iconly-Arrow-Left icli"></i>
                <div class="content">
                    <h2>{{ $new->title_original }}</h2>
                </div>
            </a>
        </div>
    </header>
    <!-- header end -->


    <!-- section start -->
    <section class="px-15 top-space pt-0 about-section">
        <h2 class="fw-bold mb-2">Introduction</h2>
        <div class="help-img">
            <img src="{{ $new->img }}" class="img-fluid rounded-1 mb-3 w-100" alt="">
        </div>
        <h4 class="mb-2">Multikart is premier fashion destination for the latest trends and hottest styles.</h4>
        <p class="content-color">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those
            interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also repr oduced
            in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
        <p class="content-color">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a
            piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin
            professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, </p>

        <p class="content-color">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a
            piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin
            professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, </p>

    </section>
    <!-- section end -->



</body>

</html>
@endsection

