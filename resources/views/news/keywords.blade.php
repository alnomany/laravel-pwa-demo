



       <div class="content-body">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">الراصد الأخباري</h4>
                </div>
                <div class="card-body">
                 <div class="row">
                     @include('includes.keyword-form')



                </div>
                </div>
            </div>
        </div>
        <!-- Blog List -->
        <div class="blog-list-wrapper">
            <div class="section-label  ar" data-aa-component="sectionLabel">
                @if($keyword_array != null)

                <span class="results-label"> نتائج لـ</span>
                @foreach ($keyword_array as $key=>$keyword)

             <span style="font-weight:bolder;">   {{ $keyword }} </span>
                @endforeach
                @endif
            <h4>

عدد الاخبار
            </h4>
                <span class="results-label">{{ count($news) }} خبر</span>

        </div>
        <div class="col-12">

            <div class="product-inline">
              <a href="{{ route('newsview',$new->id) }}">
                  @if($new->img)
                      <img src="{{$new->img}}" class="img-fluid" alt="">

                  @else
                      <img src="assets/images/empty.jpg" class="img-fluid" alt="">


                  @endif



              </a>
              <div class="product-inline-content">
                <div>

                  <a href="{{ route('newsview',$new->id) }}">
                    <h4>{{ $new->title_original }} </h4>
                  </a>
                  <h5>{{ \Illuminate\Support\Str::limit($new->body_original, 100, $end='...') }}</h5>
                  <div class="col-md-10 col-4">

                      <div class="my-1 py-25">


                              <span class=""> الدولة  |
                                  @if ($new->source_id != 0)
                                      {{  $new->country_name  }}

                                      @else
                                      {{  $new->countery_news  }}
                                  @endif                                                </span>,

                              <span class="me-50">المصدر  | {{ $new->source_name}}</span>,


                              @if($new->datetime)
                                  <span class="me-50"> التاريخ  |    {{ $new->datetime }} </span>,

                              @endif
                              @if($new->coverage1)
                              <span class=""> تغظية  الخبر |
                                  {{  Illuminate\Support\Facades\DB::table('news')
                                                  ->join('coverages', 'coverages.id', '=',  'news.coverage1' )

                                                  ->select('title')

                                                  ->value('title')
                                  }}
                              </span>

                              @endif
                              @if($new->coverage2)
                              <span class="">  تغظية الخبر  الثاني |
                                  {{  Illuminate\Support\Facades\DB::table('news')
                                  ->join('coverages', 'coverages.id', '=',  'news.coverage2' )

                                  ->select('title')

                                  ->value('title')
                                  }}
                                  </span>
                              @endif

                      </div>
                </div>
              </div>
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
          </div>
