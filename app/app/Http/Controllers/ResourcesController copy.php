<?php

namespace App\Http\Controllers;

use App\News;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ResourcesController extends Controller
{
    //
    public function somali(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
   $response = $httpClient->load('https://alsomalalyaum.com/category/%d8%a7%d9%84%d8%a7%d9%82%d8%aa%d8%b5%d8%a7%d8%af-%d8%a7%d9%84%d8%b5%d9%88%d9%85%d8%a7%d9%84%d9%8a/');

// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('div.mag-box div.post-details  h2.post-title a') as  $title) {
    $titles[] = $title->plaintext;
}
$bodies=[];
foreach ($response->find('div.mag-box div.post-details  p.post-excerpt') as  $body) {
    $bodies[] = $body->plaintext;
}

// get the dates into an array
$dates = [];
foreach ($response->find('div.mag-box-container div.post-details div.post-meta span.date') as $date) {
    $dates[] = $date->plaintext;
}
$links = [];
foreach ($response->find('div.mag-box-container div.post-details h2.post-title  a') as $link) {
    $links[] = $link->href;
}
$country="الصومال";
$name="الصومال اليوم";
$type="أقتصادية";
$language="العربية";

foreach($titles as $key=>$title){

    $data = array(
                    'title'=>$titles[$key],
                    'body'=>$bodies[$key],
                    'link'=>$links[$key],
                    'date'=>$dates[$key],
                    'type'=>$type,
                    'language'=>$language,
                    'countery_sources'=>$country,
                    'countery_news'=>$country,
                    'sources'=>$name,
                    "created_at"=> Carbon::now()


        );

    News::insert($data);
}
return view('resources.resources',compact('titles','dates','links','country','name','type','bodies'));

    }

    //
public function nina(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://www.ninanews.com/Website/News/List?key=4');

// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('div.featured-section div.post-content a h5') as  $title) {
    $titles[] = $title->plaintext;
}
$images = [];
foreach ($response->find('div.featured-section div.post-thumbnail img') as $image) {

    $images[] = $image->src;
}
$bodies = [];
foreach ($response->find('div.featured-section div.post-content p') as $body) {

    $bodies[] = $body->plaintext;
}
$dates = [];
foreach ($response->find('div.featured-section div.post-content p a.post-date') as $date) {

    $dates[] = $date->plaintext;
}
$links = [];
foreach ($response->find('div.featured-section div.post-content  a.headline') as $link) {

    $links[] = 'https://www.ninanews.com'.$link->href;
}
$country="العراق";
$name="الوكالة الوطنية العراقية";
$type="أقتصادية";
return view('resources.resources',compact('titles','dates','links','country','name','type','images','bodies'));

    }
    public function ninasport(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://www.ninanews.com/Website/News/List?key=2');

// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('div.featured-section div.post-content a h5') as  $title) {
    $titles[] = $title->plaintext;
}
$images = [];
foreach ($response->find('div.featured-section div.post-thumbnail img') as $image) {

    $images[] = $image->src;
}
$bodies = [];
foreach ($response->find('div.featured-section div.post-content p') as $body) {

    $bodies[] = $body->plaintext;
}
$dates = [];
foreach ($response->find('div.featured-section div.post-content p a.post-date') as $date) {

    $dates[] = $date->plaintext;
}
$links = [];
foreach ($response->find('div.featured-section div.post-content  a.headline') as $link) {

    $links[] = $link->href;
}
$country="العراق";
$name="الوكالة الوطنية العراقية";
$type="رياضية";
return view('resources.resources',compact('titles','dates','links','country','name','type','images','bodies'));

    }
    //
    public function alyaum(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://www.alyaum.com/%D8%A7%D9%84%D8%A7%D9%82%D8%AA%D8%B5%D8%A7%D8%AF-%D8%A7%D9%84%D9%8A%D9%88%D9%85');

// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('div.aksa-row  div.article-bx a.article-title') as  $title) {
    $titles[] = $title->plaintext;
}
$bodies = [];
foreach ($response->find('div.aksa-row  div.article-bx a.article-body') as $body) {

     $bodies[] = $body->plaintext;
}
$links = [];
foreach ($response->find('div.aksa-row  div.article-bx a.article-title') as $link) {

     $links[] = $link->href;
}
$dates = [];
foreach ($response->find('div.aksa-row  div.article-bx div.article-publishtime') as $date) {

    $dates[] = $date->plaintext;
}
$country="المملكة العربية السعودية";
$name="اليوم";
$type="أقتصادية";
$language="العربية";

foreach($titles as $key=>$title){

    $data = array(
                    'title'=>$titles[$key],
                    'body'=>$bodies[$key],
                    'link'=>$links[$key],
                    'date'=>$dates[$key],
                    'type'=>$type,
                    'language'=>$language,
                    'countery_sources'=>$country,
                    'countery_news'=>$country,
                    'sources'=>$name,
                    "created_at"=> Carbon::now()


        );

    News::insert($data);
}
return view('resources.resources',compact('titles','dates','links','country','name','type','bodies'));

    }
    public function alyaumsport(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://www.alyaum.com/morearticles/%D8%A7%D9%84%D9%85%D9%8A%D8%AF%D8%A7%D9%86-%D8%A7%D9%84%D8%B1%D9%8A%D8%A7%D8%B6%D9%8A/%D8%AF%D9%88%D8%B1%D9%8A-%D8%A7%D9%84%D9%85%D8%AD%D8%AA%D8%B1%D9%81%D9%8A%D9%86-%D8%A7%D9%84%D8%B3%D8%B9%D9%88%D8%AF%D9%8A');

// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('div.search-inner div.outer-content  div.inner-content a.article-title') as  $title) {
    $titles[] = $title->plaintext;
}
$images=[];
foreach ($response->find('div.search-inner div.outer-content  div.search-image div.img a img') as  $image) {
    $images[]= $image->src;
}
$bodies = [];
foreach ($response->find('div.search-inner div.outer-content  div.inner-content a.article-body') as $body) {

     $bodies[] = $body->plaintext;
}
$links = [];
foreach ($response->find('div.search-inner div.outer-content  div.inner-content a.article-title') as $link) {

     $links[] = $link->href;
}
$dates = [];
foreach ($response->find('div.search-inner div.inner-content time.article-date') as $date) {

    $dates[] = $date->plaintext;
}

$country="المملكة العربية السعودية";
$name="اليوم";
$type="رياضية";
$language="العربية";
foreach($titles as $key=>$title){

    $data = array(
                    'title'=>$titles[$key],
                    'body'=>$bodies[$key],
                    'link'=>$links[$key],
                    'date'=>$dates[$key],
                    'type'=>$type,
                    'language'=>$language,
                    'countery_sources'=>$country,
                    'countery_news'=>$country,
                    'sources'=>$name,
                    "created_at"=> Carbon::now()


        );

    News::insert($data);
}
return view('resources.resources',compact('titles','dates','links','country','name','type','bodies','images'));
    }

    public function alwatan(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://alwatan.ae/?cat=3');

// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('article.c5ab_post_thumb  div.content h3 a') as  $title) {
    $titles[] = $title->plaintext;
}
$bodies=[];
foreach ($response->find('article.c5ab_post_thumb  div.content div.c5-excerpt p') as  $body) {
    $bodies[] = $body->plaintext;
}
$links = [];
foreach ($response->find('article.c5ab_post_thumb  div.content h3 a') as $link) {

     $links[] = $link->href;
}


$dates = [];
foreach ($response->find('article.c5ab_post_thumb  div.content li.c5-meta-li-time time') as $date) {

    $dates[] = $date->plaintext;
}
$country="الأمارات";
$name="الوطن";
$type="أقتصادية";
$language="العربية";
foreach($titles as $key=>$title){
$data = array(
    'title'=>$titles[$key],
    'body'=>$bodies[$key],
    'link'=>$links[$key],
    'date'=>$dates[$key],
    'type'=>$type,
    'language'=>$language,
    'countery_sources'=>$country,
    'countery_news'=>$country,
    'sources'=>$name,
    "created_at"=> Carbon::now()

);

News::insert($data);
}

return view('resources.resources',compact('titles','dates','links','country','name','type','bodies'));

    }
    public function alwatansport(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://alwatan.ae/?cat=4');

// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('article.c5ab_post_thumb  div.content h3 a') as  $title) {
    $titles[] = $title->plaintext;
}
$links = [];
foreach ($response->find('article.c5ab_post_thumb  div.content h3 a') as $link) {

     $links[] = $link->href;
}
$dates = [];
foreach ($response->find('article.c5ab_post_thumb  div.content li.c5-meta-li-time time') as $date) {

    $dates[] = $date->plaintext;
}
$country="الأمارات";
$name="الوطن";
$type="رياضية";
return view('resources.resources',compact('titles','dates','links','country','name','type'));

    }


    public function alain(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://al-ain.com/section/business/');
        $news = new News();


// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('div.loadmore article div.card-body h2.card-title a') as  $title) {
    $titles[] = $title->plaintext;


}

$bodies=[];
foreach ($response->find('div.loadmore article div.card-body p.card-text') as  $body) {
    $bodies[] = $body->plaintext;

}


$links = [];
foreach ($response->find('div.loadmore article div.card-body h2.card-title a') as $link) {

     $links[] = $link->href;
}

$dates = [];
foreach ($response->find('div.loadmore article div.card-body time') as $data) {

     $dates[] = $data->plaintext;
}
$country="الأمارات";
$name="العين الاخبارية";
$type="أقتصادية";
$language="العربية";

foreach($titles as $key=>$title){

    $data = array(
                    'title'=>$titles[$key],
                    'body'=>$bodies[$key],
                    'link'=>$links[$key],
                    'date'=>$dates[$key],
                    'type'=>$type,
                    'language'=>$language,
                    'countery_sources'=>$country,
                    'countery_news'=>$country,
                    'sources'=>$name,
                    "created_at"=> Carbon::now()


        );

    News::insert($data);
}


return view('resources.resources',compact('titles','dates','links','country','name','type','bodies'));

    }
    public function alainsport(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://al-ain.com/section/politics/');

// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('div.loadmore article div.card-body h2.card-title a') as  $title) {
    $titles[] = $title->plaintext;


}
$bodies=[];
foreach ($response->find('div.loadmore article div.card-body p.card-text') as  $body) {
    $bodies[] = $body->plaintext;

}


$links = [];
foreach ($response->find('div.loadmore article div.card-body h2.card-title a') as $link) {

     $links[] = $link->href;
}

$dates = [];
foreach ($response->find('div.loadmore article div.card-body time') as $data) {

     $dates[] = $data->plaintext;
}
$country="الأمارات";
$name="العين الاخبارية";
$type="السياسية";
$language="العربية";

foreach($titles as $key=>$title){

    $data = array(
                    'title'=>$titles[$key],
                    'body'=>$bodies[$key],
                    'link'=>$links[$key],
                    'date'=>$dates[$key],
                    'type'=>$type,
                    'language'=>$language,
                    'countery_sources'=>$country,
                    'countery_news'=>$country,
                    'sources'=>$name,
                    "created_at"=> Carbon::now()


        );

    News::insert($data);
}


return view('resources.resources',compact('titles','dates','links','country','name','type','bodies'));

    }
    public function test(){
        return "hi";

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
    return    $response = $httpClient->load('https://www.elbalad.news/4959809');
      $titles=[];
foreach ($response->find('div.loadmore article div.card-body h2.card-title a') as  $title) {
    $titles[] = $title->plaintext;
}
$links = [];
foreach ($response->find('div.loadmore article div.card-body h2.card-title a') as $link) {

     $links[] = $link->href;
}
$response=[];
$titles1=[];
$bodies1=[];
$dates1=[];

foreach($titles as $key1=>$title){

        $titles1[] = $httpClient->load($links[$key1])->find('div.loadmore article div.card-body h1.card-title',0)->plaintext;
        $bodies1[] = $httpClient->load($links[$key1])->find('div.loadmore article div.details',0)->plaintext;
      $dates1[]= $httpClient->load($links[$key1])->find('div.loadmore article div.card-body time',0)->plaintext;

}
$country="الأمارات";
$name="العين الاخبارية";
$type="السياسية";
$language="العربية";

      foreach($titles1 as $key=>$title1){

          $data = array(
                          'title'=>$titles1[$key],
                          'body'=>$bodies1[$key],
                          'date'=>$dates1[$key],
                          'type'=>$type,
                          'language'=>$language,
                          'countery_sources'=>$country,
                          'countery_news'=>$country,
                          'sources'=>$name,

                          "created_at"=> Carbon::now()


              );

          News::insert($data);
      }



    }

    public function skynewsarabia(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://www.skynewsarabia.com/business');

// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('div.comp_1.comp.id_644 div.comp_1_inner_cont div.comp_1_cont  div.comp_1_content_container div.comp_1_item a.comp_1_item_inner_cont h3.comp_1_item_header') as  $title) {
    $titles[] = $title->plaintext;
}
$dates = [];
foreach ($response->find('div.comp_1.comp.id_644 div.div.comp_1_inner_cont div.comp_1_cont  div.comp_1_content_container div.comp_1_item a.comp_1_item_inner_cont div.comp_1_item_date span.content_list_item_date') as $date) {

    $dates[] = $date->plaintext;
}
$links = [];
foreach ($response->find('div.comp_1.comp.id_644 div.comp_1_inner_cont div.comp_1_cont  div.comp_1_content_container div.comp_1_item a.comp_1_item_inner_cont') as $link) {

    $links[] = $link->href;
}
$country=" ";
$name=" skynewsarabia";
$type="أقتصادية";
return view('resources.resources',compact('titles','dates','links','country','name','type'));

    }
     public function skynewsarabiasport(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
         $response = $httpClient->load('https://www.skynewsarabia.com/sport');

// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('div.comp_1.comp.id_644 div.comp_1_inner_cont div.comp_1_cont  div.comp_1_content_container div.comp_1_item a.comp_1_item_inner_cont h3.comp_1_item_header') as  $title) {
    $titles[] = $title->plaintext;
}
$dates = [];
foreach ($response->find('div.comp_1.comp.id_644 div.div.comp_1_inner_cont div.comp_1_cont  div.comp_1_content_container div.comp_1_item a.comp_1_item_inner_cont div.comp_1_item_date span.content_list_item_date') as $date) {

    $dates[] = $date->plaintext;
}
$links = [];
foreach ($response->find('div.comp_1.comp.id_644 div.comp_1_inner_cont div.comp_1_cont  div.comp_1_content_container div.comp_1_item a.comp_1_item_inner_cont') as $link) {

    $links[] = $link->href;
}
$country=" ";
$name=" skynewsarabia";
$type="رياضية";
return view('resources.resources',compact('titles','dates','links','country','name','type'));

    }

    public function ir(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://www.voanews.com/economy-business');

// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('div.teaser div.teaser__content div.teaser__title a span') as  $title) {
    $titles[] = $title->plaintext;
}
$links = [];
foreach ($response->find('div.teaser div.teaser__content div.teaser__title a') as $link) {

    $links[] = 'https://www.voanews.com/'.$link->href;
}
$bodies=[];
foreach ($response->find('div.teaser div.teaser__content div.teaser__text') as  $body) {
    $bodies[] = $body->plaintext;
}
$dates=[];
foreach ($response->find('div.teaser div.teaser__content div.teaser__author div.teaser__publish-date') as $data) {

    $dates[] = $data->plaintext;
}
$country="إيران";
$name=" voanews";
$type="economy";
$language="إيران";
foreach($titles as $key=>$title){

    $data = array(
                    'title'=>$titles[$key],
                    'body'=>$bodies[$key],
                    'link'=>$links[$key],
                    'date'=>$dates[$key],
                    'type'=>$type,
                    'language'=>$language,
                    'countery_sources'=>$country,
                    'countery_news'=>$country,
                    'sources'=>$name,
                    "created_at"=> Carbon::now()


        );

    News::insert($data);
}
return view('resources.resources',compact('titles','dates','links','country','name','type','bodies'));

    }
    public function mcdoualiya(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://www.mc-doualiya.com/%D8%B1%D9%8A%D8%A7%D8%B6%D8%A9/');

// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('section.t-content__section-pb div.o-layout-list div.m-item-list-article a div.article__infos p.article__title') as  $title) {
    $titles[] = $title->plaintext;
}
$links = [];
foreach ($response->find('section.t-content__section-pb div.o-layout-list div.m-item-list-article a') as $link) {

    $links[] = $link->href;
}
$dates=[];
$country=" ";
$name=" mc-doualiya";
$type="رياضية";
return view('resources.resources',compact('titles','dates','links','country','name','type'));

    }

    public function euronews(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://arabic.euronews.com/news/business');

// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('div.o-block-listing__articles article div.m-object__body h3.m-object__title a') as  $title) {
    $titles[] = $title->plaintext;
}
$images=[];
foreach ($response->find('div.o-block-listing__articles article div.m-object__body  div.m-object__description a.m-object__description__link') as $body) {

    $bodies[] = $body->plaintext;
}

 $bodies = [];
foreach ($response->find('div.o-block-listing__articles article div.m-object__body  div.m-object__description a.m-object__description__link') as $body) {

     $bodies[] = $body->plaintext;
}
// get the dates into an array
$links = [];
foreach ($response->find('div.o-block-listing__articles article div.m-object__body h3.m-object__title a') as $link) {

    $links[] = 'https://arabic.euronews.com/'.$link->href;
}
$dates=[];
foreach ($response->find('div.o-block-listing__articles article div.m-object__body  time.m-object__date') as $date) {

    $dates[] = $date->plaintext;
}
$country=" ";
$name="euronews";
$type="أقتصادية";
return view('resources.resources',compact('titles','dates','links','country','name','type','images','bodies'));

    }
    public function euronewssport(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://arabic.euronews.com/news/sport');

// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('div.o-block-more-news-themes__articles article div.m-object__body  h3.m-object__title') as  $title) {
    $titles[] = $title->plaintext;
}
// get the dates into an array
$links = [];
foreach ($response->find('div.o-block-more-news-themes__articles article div.m-object__body  h3.m-object__title a.m-object__title__link') as $link) {

    $links[] = $link->href;
}
$dates=[];
$country=" ";
$name="euronews";
$type="رياضية";
return view('resources.resources',compact('titles','dates','links','country','name','type'));

    }
   public function shafaq(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://shafaq.com/ar/%D8%A7%D9%82%D8%AA%D8%B5%D9%80%D8%A7%D8%AF?rss=1');

        $titles=[];
        foreach ($response->find('item title') as  $title) {
            $titles[] = $title;
        }
        // get the dates into an array
        $links = [];
        foreach ($response->find('link') as $link) {

            $links[] = $link;
        }
        $dates=[];
        foreach ($response->find('pubDate') as  $date) {
            $dates[] = $date;
        }
        $descriptions=[];
        foreach ($response->find('description') as  $description) {
            $descriptions[] = $description;
        }
        $images=[];
        foreach ($response->find('enclosure') as  $image) {
            $images[] = $image->url;
        }
        $country=" ";
        $name="shafq";
        $type="أقتصادية";
        return view('resources.resources',compact('titles','dates','links','country','name','type','descriptions'));

    }
    public function aawsat(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://aawsat.com/home/article/3146256/%D8%A7%D9%84%D8%B3%D8%B9%D9%88%D8%AF%D9%8A%D8%A9-%D8%AA%D9%85%D8%AF%D8%AF-%D9%85%D9%87%D9%84%D8%A9-%D8%AA%D8%B5%D8%AD%D9%8A%D8%AD-%D8%A3%D9%88%D8%B6%D8%A7%D8%B9-%C2%AB%D9%85%D8%AE%D8%A7%D9%84%D9%81%D9%8A-%D8%A7%D9%84%D8%AA%D8%B3%D8%AA%D8%B1-%D8%A7%D9%84%D8%AA%D8%AC%D8%A7%D8%B1%D9%8A%C2%BB-6-%D8%A3%D8%B4%D9%87%D8%B1');

// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('article.article div#article_content h2') as  $title) {
    $titles[] = $title->plaintext;
}
// get the dates into an array
$links ="";
$link="https://aawsat.com/home/article/3146256/%D8%A7%D9%84%D8%B3%D8%B9%D9%88%D8%AF%D9%8A%D8%A9-%D8%AA%D9%85%D8%AF%D8%AF-%D9%85%D9%87%D9%84%D8%A9-%D8%AA%D8%B5%D8%AD%D9%8A%D8%AD-%D8%A3%D9%88%D8%B6%D8%A7%D8%B9-%C2%AB%D9%85%D8%AE%D8%A7%D9%84%D9%81%D9%8A-%D8%A7%D9%84%D8%AA%D8%B3%D8%AA%D8%B1-%D8%A7%D9%84%D8%AA%D8%AC%D8%A7%D8%B1%D9%8A%C2%BB-6-%D8%A3%D8%B4%D9%87%D8%B1";

$dates=[];

foreach ($response->find('article.article div#article_content div.node-info div#update_date') as  $date) {
    $dates[] = $date->plaintext;
}
$country=" ";
$name="الوسيط";
$type="أقتصادية";
return view('resources.resources',compact('titles','dates','links','country','name','type'));

    }
    public function aawsatsport(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://aawsat.com/home/international/section/sport');

// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('div.media-type-3 div.media div.media-body a') as  $title) {
    $titles[] = $title->plaintext;
}
// get the dates into an array
$links = [];
foreach ($response->find('div.media-type-3 div.media div.media-body a') as $link) {

    $links[] = $link->href;
}
$dates=[];
$country=" ";
$name="الوسيط";
$type="رياضية";
return view('resources.resources',compact('titles','dates','links','country','name','type'));

    }
    public function twinty(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://aawsat.com/home/international/section/economy?page=1');

// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('div.media-type-3 div.media div.media-body a') as  $title) {
    $titles[] = $title->plaintext;
}
// get the dates into an array
$links = [];
foreach ($response->find('div.media-type-3 div.media div.media-body a') as $link) {

    $links[] = $link->href;
}
$dates=[];
$country=" ";
$name="الوسيط";
$type="أقتصادية";
return view('resources.resources',compact('titles','dates','links','country','name','type'));

    }






}
