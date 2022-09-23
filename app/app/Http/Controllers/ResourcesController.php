<?php

namespace App\Http\Controllers;

use App\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stichoza\GoogleTranslate\GoogleTranslate;


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
foreach ($response->find('li.post-item:nth-child(1)') as  $title) {
 return   $titles[] = $title->plaintext;
}
#posts-container > li.post-item.post-20885.post.type-post.status-publish.format-standard.has-post-thumbnail.category-24.category-65.tie-standard > div > h2 > a
$categories=[];
foreach ($response->find('li.post-item:nth-child(1) > div:nth-child(2) > h2:nth-child(2) > a:nth-child(1)') as  $category) {
 return   $categories[] = $category->plaintext;
}


$links = [];
foreach ($response->find('div.mag-box-container div.post-details h2.post-title  a') as $link) {
    $links[] = $link->href;
}
$titles1=[];
$bodies1=[];
$dates1=[];
foreach($titles as $key1=>$title){
    $httpClient->load($links[$key1]);
    $titles1[]=$httpClient->load($links[$key1])->find('article.container-wrapper div.entry-header h1.post-title',0)->plaintext;
    $bodies1[]=$httpClient->load($links[$key1])->find('article.container-wrapper div.entry-content div.bialty-container',0)->plaintext;
   $dates1[]=$httpClient->load($links[$key1])->find('article.container-wrapper div.entry-header span.date',0)->plaintext;

}
$country="الصومال";
$name="الصومال اليوم";
$type="أقتصادية";
$language="ar";

foreach($titles1 as $key=>$title1){
    $data=array(



        'title'=>$titles1[$key],
        'body'=>$bodies1[$key],
        'date'=>$dates1[$key],
        'type'=>$type,
        'language'=>$language,
        'countery_sources'=>$country,
        'countery_news'=>$country,
        'sources'=>$name,
        'created_at'=>Carbon::now());

    News::insert($data);
}

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
    public function ninapolitics(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
      return  $response = $httpClient->load('https://www.ninanews.com/Website/News/List?key=5');

// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('div.featured-section div.post-content a h5') as  $title) {

    $titles[] = $title->plaintext;
}

$links = [];
foreach ($response->find('div.featured-section div.post-content  a.headline') as $link) {

  return  $links[] = 'https://www.ninanews.com'.$link->href;
}
$titles1=[];
$bodies1=[];
$dates1=[];
foreach($titles as $key1=>$title){
    $titles1[]=$httpClient->load($links[$key1])->find("div.main-content-wrapper div.container div.justify-content-center h3",0)->plaintext;
    $bodies1[]=$httpClient->load($links[$key1])->find("div.main-content-wrapper div.container div.justify-content-center div.post-content",0)->plaintext;
    $dates1[]=$httpClient->load($links[$key1])->find("div.main-content-wrapper div.container div.justify-content-center a.post-date",0)->plaintext;

}

$country="العراق";
$name="الوكالة الوطنية العراقية";
$type="سياسية";


/** */



foreach($titles as $key=>$title){

    $data = array(
                    'title'=>$titles1[$key],
                    'body'=>$bodies1[$key],
                    'link'=>$links1[$key],
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
$type="سياسية";
$language="ar";
/** */



foreach($titles as $key=>$title){

    $data = array(
                    'title'=>$titles1[$key],
                    'body'=>$bodies1[$key],
                    'link'=>$links1[$key],
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
foreach ($response->find('div.aksa-o1  div.article-bx a.article-body') as $body) {

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
$language="ar";

$bodies1=[];
/*
foreach($titles as $key1=>$title){


  //  return $httpClient->load($links[$key1]);    $titles1[]=$httpClient->load($links[$key1])->find('header.o-article__header h1.c-article-title',0)->plaintext;
   return  $bodies1[]=$httpClient->load($links[$key1])->find('div.padd10px div.aksa-desc-o article.aksa-o2 div.aksa-articleBody',0)->plaintext;
}
*/


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
        'created_at'=>Carbon::now()
        );

    News::insert($data);
}

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
 $language="ar";
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
public function alwatansa(){
    require '../vendor/autoload.php';
    $httpClient = new \simplehtmldom\HtmlWeb();
    $response = $httpClient->load('https://www.alwatan.com.sa/%D8%B3%D9%8A%D8%A7%D8%B3%D8%A9');

// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('div.new-more-articles-widget  div.rowMargin div.title a p') as  $title) {
 $titles[] = $title->plaintext;
}

$links = [];
foreach ($response->find('div.new-more-articles-widget  div.rowMargin div.title a') as $link) {

  $links[] = $link->href;
}
$titles1=[];
$bodies1=[];
$dates1=[];
foreach($titles as $key1=>$title){
    $httpClient->load($links[$key1]);
    $titles1[]=$httpClient->load($links[$key1])->find('div.new-article-details h1.new-article-title',0)->plaintext;
    $bodies1[]=$httpClient->load($links[$key1])->find('div.new-article-details div.articleBody',0)->plaintext;
    $dates1[]=$httpClient->load($links[$key1])->find('div.new-article-details div.article-publish-date',0)->plaintext;

}



$country="المملكة العربية السعودية";
$name="صحيفة الوطن السعودية";
$type="سياسية";
$language="ar";
foreach($titles as $key=>$title){
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

$links = [];
foreach ($response->find('article.c5ab_post_thumb  div.content h3 a') as $link) {

     $links[] = $link->href;
}
$titles1=[];
$bodies1=[];
$dates1=[];
foreach($titles as $key1=>$title){
   // $httpClient->load($links[$key1]);
    $titles1[]=$httpClient->load($links[$key1])->find('header.article-header h1',0)->plaintext;
    $bodies1[]=$httpClient->load($links[$key1])->find('header.article-header section p',0)->plaintext;
     $dates1[]=$httpClient->load($links[$key1])->find('header.article-header div.c5-author-data time',0)->plaintext;

}


//------------------------------



$country="الأمارات";
$name="الوطن";
$type="أقتصادية";
$language="ar";
foreach($titles as $key=>$title){
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
    public function alwatansport(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
    return    $response = $httpClient->load('https://alwatan.ae/?cat=4');

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
$language="ar";

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
    public function RT(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $tr1 = new GoogleTranslate('ar');
     return   $response = $httpClient->load('https://arabic.rt.com/');

        $titles=[];
        foreach ($response->find('div.layout__content div.columns__content div.news-block div.card strong.card__header a') as  $title) {
          return  $titles[] = $title->plaintext;
        }

// get the dates into an array
        $links = [];
        foreach ($response->find('div.layout__content div.columns__content div.news-block div.card strong.card__header a') as $link) {

           $links[] = 'https://www.rt.com'.$link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){

           return $httpClient->load($links[$key1]);
              $titles1[]=$httpClient->load($links[$key1])->find('div.layout__content div.columns__content div.article h1.article__heading',0);
               $bodies1[]=$httpClient->load($links[$key1])->find('div.layout__content div.columns__content div.article div.article__text',0);
               $dates1[]=$httpClient->load($links[$key1])->find('div.layout__content div.columns__content div.article div.article__date span.date',0);

          }


$country="russia";
$name="RT";
$type="أقتصادية";
$language="ar";
foreach($titles1 as $key=>$title1){
    $data=array(
        'title'=>$titles1[$key],
        'body'=>$bodies1[$key],
        'date'=>$dates1[$key],
        'type'=>$type,
        'language'=>$language,
        'countery_sources'=>$country,
        'countery_news'=>$country,
        'sources'=>$name,
        'created_at'=>Carbon::now());
    News::insert($data);
}


    }
    public function france24(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $tr1 = new GoogleTranslate('fr');
        $response = $httpClient->load('https://www.france24.com/en/sport/');
        $titles=[];
        foreach ($response->find('section.t-content__section-pb  div.m-item-list-article a div.article__infos p.article__title') as  $title) {
            $titles[] = $title->plaintext;
        }
// get the dates into an array
        $links = [];
        foreach ($response->find('section.t-content__section-pb div.m-item-list-article a') as $link) {

           $links[] = 'https://www.france24.com/'.$link->href;
        }

        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
        //  return $httpClient->load($links[$key1]);
            $titles1[]=$httpClient->load($links[$key1])->find('article h1.t-content__title',0)->plaintext;
      return      $bodies1[]=$httpClient->load($links[$key1])->find('article div.t-content__body p',0)->plaintext;
            $dates1[]=$httpClient->load($links[$key1])->find('article p.m-pub-dates span.m-pub-dates__date time',0)->plaintext;

        }


$country="france";
$name="france24";
$type="رياضية";
$language="fr";
foreach($titles1 as $key=>$title1){
    $data=array(
        'title'=>$tr1->translate($titles1[$key]),
        'body'=>$tr1->translate($bodies1[$key]),
        'title_he'=>$titles1[$key],
        'body_he'=>$bodies1[$key],
        'date'=>$dates1[$key],
        'type'=>$type,
        'language'=>$language,
        'countery_sources'=>$country,
        'countery_news'=>$country,
        'sources'=>$name,
        'created_at'=>Carbon::now());
    News::insert($data);
}
    }
public function africanewsen(){
    require '../vendor/autoload.php';
    $httpClient = new \simplehtmldom\HtmlWeb();
    $tr = new GoogleTranslate('ar');

    $response = $httpClient->load('https://www.africanews.com/business/');
    foreach ($response->find('article.just-in__article h3.just-in__title a') as  $title) {
             $titles[] = $title->plaintext;
    }

    $links = [];
    foreach ($response->find('article.just-in__article h3.just-in__title a') as $link) {

            $links[] = "https://www.africanews.com/".$link->href;
    }
    $titles1=[];
    $bodies1=[];
    $dates1=[];
    foreach($titles as $key1=>$title){
             $httpClient->load($links[$key1]);
            $titles1[]=$httpClient->load($links[$key1])->find('article.article h1.article__title',0);
            $bodies1[]=$httpClient->load($links[$key1])->find('article.article div.article-content__text',0);
            $dates1[]=$httpClient->load($links[$key1])->find('article.article time.article__date',0);
    }
    $country="Africa";
    $name="africanews";
    $type="أقتصاد";
    $language="en";

foreach($titles1 as $key=>$title1){


$data = array(
  //  'title'=>$tr->translate($titles1[$key]),
  //  'body'=>$tr->translate($bodies1[$key]),
                'title_en'=>$titles1[$key],
                'body_en'=>$bodies1[$key],
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
public function africanewsfr(){
    require '../vendor/autoload.php';
    $httpClient = new \simplehtmldom\HtmlWeb();
    $tr = new GoogleTranslate('ar');

    $response = $httpClient->load('https://fr.africanews.com/economie/');
    foreach ($response->find('article.just-in__article h3.just-in__title a') as  $title) {
             $titles[] = $title->plaintext;
    }

    $links = [];
    foreach ($response->find('article.just-in__article h3.just-in__title a') as $link) {

            $links[] = "https://fr.africanews.com/".$link->href;
    }
    $titles1=[];
    $bodies1=[];
    $dates1=[];
    foreach($titles as $key1=>$title){
             $httpClient->load($links[$key1]);
            $titles1[]=$httpClient->load($links[$key1])->find('h1.article__title',0);
            $bodies1[]=$httpClient->load($links[$key1])->find('div.article-content__text',0);
            $dates1[]=$httpClient->load($links[$key1])->find('time.article__date',0);
    }
    $country="Africa";
    $name="africanews";
    $type="أقتصاد";
    $language="fr";

foreach($titles1 as $key=>$title1){


$data = array(
  //  'title'=>$tr->translate($titles1[$key]),
  //  'body'=>$tr->translate($bodies1[$key]),
                'title_fr'=>$titles1[$key],
                'body_fr'=>$bodies1[$key],
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

    public function test1(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        //$resources=News::select('countery_sources')->distinct()->get();
       //  $resources=News::select('language')->distinct()->get();
       $resources=News::select('body')->distinct()->get();

        //  $resources=News::select('sources')->where('language','EGY')->orwhere('language','ar')->distinct()->get();
       //  return $resources=News::select('sources')->where('language','fr')->distinct()->get();
       //  return $resources=News::select('sources')->where('language','en')->distinct()->get();
      // return $resources=News::select('sources')->where('language','he')->distinct()->get();
      // return $resources=News::select('sources')->where('language','tr')->distinct()->get();
     //  return $resources=News::select('sources')->where('language','pe')->distinct()->get();




      //  $resources=News::select('date')->distinct()->get();
        return view('test2',compact('resources'));

    }
    public function test(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
       return $response = $httpClient->load('https://see.news/category/business/');



        //$resources=News::select('countery_sources')->distinct()->get();
       // $resources=News::select('sources')->distinct()->get();
        $resources=News::select('date')->distinct()->get();
        return view('test2',compact('resources'));
    }


    public function trust(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $tr = new GoogleTranslate('ar');
        $response = $httpClient->load('https://news.trust.org/economies/');
        foreach ($response->find('div.feature-block a div.title') as  $title) {
                  $titles[] = $title->plaintext;
        }
        $links = [];
        foreach ($response->find('div.feature-block a') as $link) {

            return    $links[] = "https://news.trust.org/".$link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];

        foreach($titles as $key1=>$title){
               $httpClient->load($links[$key1]);
         return        $titles1[]=$httpClient->load($links[$key1])->find('span.article-container h1.left',0)->plaintext;
                          $bodies1[]=$httpClient->load($links[$key1])->find('span.article-container div.body-text',0)->plaintext;
                             $dates1[]=$httpClient->load($links[$key1])->find('span.article-container div.small',0);
        }

    }
    public function cgtn(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $tr = new GoogleTranslate('ar');
        $response = $httpClient->load('https://www.cgtn.com/politics');
        foreach ($response->find('div.cg-newsWrapper div.cg-title h4 a') as  $title) {
                 $titles[] = $title->plaintext;
        }
        $links = [];
        foreach ($response->find('div.cg-newsWrapper div.cg-title h4 a') as $link) {

                 $links[] = $link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
               $httpClient->load($links[$key1]);
                 $titles1[]=$httpClient->load($links[$key1])->find('div.cg-main-container div.news-title',0)->plaintext;
                          $bodies1[]=$httpClient->load($links[$key1])->find('div.cg-main-container div#cmsMainContent',0)->plaintext;
                             $dates1[]=$httpClient->load($links[$key1])->find('div.cg-main-container div.updatetime',0);
        }
        $country="China";
        $name="China Global Television Network";
        $type="السياسية";
        $language="en";

foreach($titles1 as $key=>$title1){


    $data = array(

                    'title_en'=>$titles1[$key],
                    'body_en'=>$bodies1[$key],
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

    public function cgtnar(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $tr = new GoogleTranslate('ar');
        $response = $httpClient->load('https://arabic.cgtn.com/arabic');
        foreach ($response->find('div.cg-newsWrapper div.cg-title h1 a') as  $title) {
                $titles[] = $title->plaintext;
        }
        $links = [];
        foreach ($response->find('div.cg-newsWrapper div.cg-title h1 a') as $link) {

                   $links[] = $link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
                 $httpClient->load($links[$key1]);
                   $titles1[]=$httpClient->load($links[$key1])->find('div.cg-main-container div.news-title',0)->plaintext;
                          $bodies1[]=$httpClient->load($links[$key1])->find('div.cg-main-container div#cmsMainContent',0)->plaintext;
                             $dates1[]=$httpClient->load($links[$key1])->find('div.cg-main-container div.updatetime',0);
        }
        $country="China";
        $name="China Global Television Network";
        $type="السياسية";
        $language="ar";

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
    public function cgtnfr(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $tr = new GoogleTranslate('ar');
        $response = $httpClient->load('https://francais.cgtn.com/business');
        foreach ($response->find('div.cg-newsWrapper div.cg-title h1 a') as  $title) {
                $titles[] = $title->plaintext;
        }
        $links = [];
        foreach ($response->find('div.cg-newsWrapper div.cg-title h1 a') as $link) {

                   $links[] = $link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
                 $httpClient->load($links[$key1]);
                   $titles1[]=$httpClient->load($links[$key1])->find('div.cg-main-container div.news-title',0)->plaintext;
                          $bodies1[]=$httpClient->load($links[$key1])->find('div.cg-main-container div#cmsMainContent',0)->plaintext;
                             $dates1[]=$httpClient->load($links[$key1])->find('div.cg-main-container div.updatetime',0);
        }
        $country="China";
        $name="China Global Television Network";
        $type="الاقتصادية";
        $language="fr";

foreach($titles1 as $key=>$title1){


    $data = array(
                    'title'=>$tr->translate($titles1[$key]),
                    'body'=>$tr->translate($bodies1[$key]),
                    'title_fr'=>$titles1[$key],
                    'body_fr'=>$bodies1[$key],


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
    public function cnn(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $tr = new GoogleTranslate('ar');
       return $response = $httpClient->load('https://middleeast.in-24.com/business');
        foreach ($response->find('ul.cn-list-hierarchical-xs div.cd__content h3.cd__headline a span.cd__headline-text') as  $title) {
                return $titles[] = $title->plaintext;
        }
        $links = [];
        foreach ($response->find('section.ContentRoll__Item div.ContentRoll__Headline a.AnchorLink') as $link) {

               $links[] = $link->href;
        }



    }
    public function abcnews(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $tr = new GoogleTranslate('ar');

        $response = $httpClient->load('https://abcnews.go.com/Politics');
        foreach ($response->find('section.ContentRoll__Item div.ContentRoll__Headline a.AnchorLink') as  $title) {
                $titles[] = $title->plaintext;
        }
        $links = [];
        foreach ($response->find('section.ContentRoll__Item div.ContentRoll__Headline a.AnchorLink') as $link) {

               $links[] = $link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
               $httpClient->load($links[$key1]);
                     $titles1[]=$httpClient->load($links[$key1])->find('header.Article__Header div.Article__Headline h1.Article__Headline__Title',0);
                 $bodies1[]=$httpClient->load($links[$key1])->find('article.Article__Wrapper section.Article__Content',0);
                       $dates1[]=$httpClient->load($links[$key1])->find('article.Article__Wrapper div.Byline__Meta--publishDate',0);
        }
        $country="الولالية المتحدة الامريكية";
        $name="abcnews";
        $type="السياسية";
        $language="en";

foreach($titles1 as $key=>$title1){


    $data = array(

                    'title_en'=>$titles1[$key],
                    'body_en'=>$bodies1[$key],
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
    public function sepnews(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $tr = new GoogleTranslate('ar');

        $response = $httpClient->load('https://www.26sepnews.net/category/main-sidebar/%d9%8a%d9%88%d9%85%d9%8a%d8%a7%d8%aa-%d8%a7%d9%84%d8%ac%d9%8a%d8%b4/');
        foreach ($response->find('article h2.post-title a') as  $title) {
                   $titles[] = $title->plaintext;
        }
        $links = [];
        foreach ($response->find('article h2.post-title a') as $link) {

                $links[] = $link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
             $httpClient->load($links[$key1]);
                 $titles1[]=$httpClient->load($links[$key1])->find('h1.post-title',0)->plaintext;
                      $bodies1[]=$httpClient->load($links[$key1])->find('div.post-content',0)->plaintext;
                     $dates1[]=$httpClient->load($links[$key1])->find('time.value-title',0)->plaintext;
        }
        $country="اليمن";
        $name="موقع 26 سبتمبر الاخباري";
        $type="السياسية";
        $language="ar";

foreach($titles1 as $key=>$title1){


    $data = array(
       // 'title'=>$tr->translate($titles1[$key]),
       // 'body'=>$tr->translate($bodies1[$key]),
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
    public function sepnewsen(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $tr = new GoogleTranslate('ar');

        $response = $httpClient->load('http://en.26sepnews.net/category/national-army/');
        foreach ($response->find('article.main_article a h3') as  $title) {
                   $titles[] = $title->plaintext;
        }
        $links = [];
        foreach ($response->find('article.main_article a') as $link) {

                $links[] = $link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
             $httpClient->load($links[$key1]);
                 $titles1[]=$httpClient->load($links[$key1])->find('div.section_title h1',0)->plaintext;
                      $bodies1[]=$httpClient->load($links[$key1])->find('div.detail-blog-text',0)->plaintext;
                     $dates1[]=$httpClient->load($links[$key1])->find('span.date time',0)->plaintext;
        }
        $country="اليمن";
        $name="موقع 26 سبتمبر الاخباري";
        $type="السياسية";
        $language="ar";

foreach($titles1 as $key=>$title1){


    $data = array(
        'title'=>$tr->translate($titles1[$key]),
        'body'=>$tr->translate($bodies1[$key]),
                    'title_en'=>$titles1[$key],
                    'body_en'=>$bodies1[$key],
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
    public function sonna(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $tr = new GoogleTranslate('ar');

        $response = $httpClient->load('https://sonna.so/en/category/business/');
        foreach ($response->find('div.td-module-meta-info h3.entry-title a') as  $title) {
                 $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('div.td-module-meta-info h3.entry-title a') as $link) {

                $links[] = $link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
              $httpClient->load($links[$key1]);
               $titles1[]=$httpClient->load($links[$key1])->find('div.wpb_wrapper h1.tdb-title-text',0)->plaintext;
                 $bodies1[]=$httpClient->load($links[$key1])->find('div.wpb_wrapper div.tdb-block-inner > p',0)->plaintext;
                  $dates1[]=$httpClient->load($links[$key1])->find('div.wpb_wrapper time.entry-date',0)->plaintext;
        }
        $country="الصومال";
        $name="وكالة الانباء الصومالية";
        $type="أقتصاد";
        $language="en";

foreach($titles1 as $key=>$title1){


    $data = array(
        //'title'=>$tr->translate($titles1[$key]),
        //'body'=>$tr->translate($bodies1[$key]),
                    'title_en'=>$titles1[$key],
                    'body_en'=>$bodies1[$key],
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
    public function sonnaar(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $tr = new GoogleTranslate('ar');

        $response = $httpClient->load('https://sonna.so/ar/category/%d8%a7%d9%84%d8%a7%d9%82%d8%aa%d8%b5%d8%a7%d8%af/');
        foreach ($response->find('div.td-module-meta-info h3.entry-title a') as  $title) {
                 $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('div.td-module-meta-info h3.entry-title a') as $link) {

                $links[] = $link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
              $httpClient->load($links[$key1]);
               $titles1[]=$httpClient->load($links[$key1])->find('div.wpb_wrapper h1.tdb-title-text',0)->plaintext;
                 $bodies1[]=$httpClient->load($links[$key1])->find('div.wpb_wrapper div.tdb-block-inner > p',0)->plaintext;
                  $dates1[]=$httpClient->load($links[$key1])->find('div.wpb_wrapper time.entry-date',0)->plaintext;
        }
        $country="الصومال";
        $name="وكالة الانباء الصومالية";
        $type="أقتصاد";
        $language="ar";

foreach($titles1 as $key=>$title1){


    $data = array(
        //'title'=>$tr->translate($titles1[$key]),
        //'body'=>$tr->translate($bodies1[$key]),
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
    public function washingtonpost(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $tr = new GoogleTranslate('ar');
        $response = $httpClient->load('https://www.washingtonpost.com/politics/?itid=hp_top_nav_politics');
       foreach ($response->find('div.story-list-story h2 a') as  $title) {
          $titles[] = $title->plaintext;
    }
    $links = [];
    foreach ($response->find('div.story-list-story h2 a') as $link) {

        $links[] = $link->href;
    }
    $titles1=[];
    $bodies1=[];
    $dates1=[];

foreach($titles as $key1=>$title){
       $httpClient->load($links[$key1]);
         $titles1[]=$httpClient->load($links[$key1])->find('h1.font--headline span',0);
         $bodies1[]=$httpClient->load($links[$key1])->find('div.teaser-content',0)->plaintext;
         $dates1[]=$httpClient->load($links[$key1])->find('span.display-date',0)->plaintext;
}
$country="فرنسا";
$name="washingtonpost";
$type="سياسية";
$language="en";
foreach($titles1 as $key=>$title1){
$data=array(
    //'title'=>$tr->translate($titles1[$key]),
    //'body'=>$tr->translate($bodies1[$key]),
    'title_en'=>$titles1[$key],
    'body_en'=>$bodies1[$key],
    'date'=>$dates1[$key],
    'type'=>$type,
    'language'=>$language,
    'countery_sources'=>$country,
    'countery_news'=>$country,
    'sources'=>$name,
    'created_at'=>Carbon::now());
    News::insert($data);

}


    }
    public function theconversationfr(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $tr = new GoogleTranslate('ar');
        $response = $httpClient->load('https://theconversation.com/ca-fr');
       foreach ($response->find('div.blockset div.article--header h2 a') as  $title) {
        $titles[] = $title->plaintext;
    }
    $links = [];
    foreach ($response->find('div.blockset div.article--header h2 a') as $link) {

        $links[] ="https://theconversation.com/". $link->href;
    }
    $titles1=[];
    $bodies1=[];
    $dates1=[];

foreach($titles as $key1=>$title){
  //  $httpClient->load($links[$key1]);
     $titles1[]=$httpClient->load($links[$key1])->find('header.content-header-container div.content-header-block h1.entry-title',0);
    $bodies1[]=$httpClient->load($links[$key1])->find('div.entry-content',0)->plaintext;
    $dates1[]=$httpClient->load($links[$key1])->find('time',0)->plaintext;

}
$country="فرنسا";
$name="theconversation";
$type="أقتصادية";
$language="fr";
foreach($titles1 as $key=>$title1){
$data=array(
    //'title'=>$tr->translate($titles1[$key]),
    //'body'=>$tr->translate($bodies1[$key]),
    'title_fr'=>$titles1[$key],
    'body_fr'=>$bodies1[$key],
    'date'=>$dates1[$key],
    'type'=>$type,
    'language'=>$language,
    'countery_sources'=>$country,
    'countery_news'=>$country,
    'sources'=>$name,
    'created_at'=>Carbon::now());
    News::insert($data);

}


    }
    public function theconversationen(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $tr = new GoogleTranslate('ar');
        $response = $httpClient->load('https://theconversation.com/ca');
       foreach ($response->find('div.blockset div.article--header h2 a') as  $title) {
        $titles[] = $title->plaintext;
    }
    $links = [];
    foreach ($response->find('div.blockset div.article--header h2 a') as $link) {

        $links[] ="https://theconversation.com/". $link->href;
    }
    $titles1=[];
    $bodies1=[];
    $dates1=[];

foreach($titles as $key1=>$title){
  //  $httpClient->load($links[$key1]);
     $titles1[]=$httpClient->load($links[$key1])->find('header.content-header-container div.content-header-block h1.entry-title',0);
    $bodies1[]=$httpClient->load($links[$key1])->find('div.entry-content',0)->plaintext;
    $dates1[]=$httpClient->load($links[$key1])->find('time',0)->plaintext;

}
$country="فرنسا";
$name="theconversation";
$type="أقتصادية";
$language="en";
foreach($titles1 as $key=>$title1){
$data=array(
    //'title'=>$tr->translate($titles1[$key]),
    //'body'=>$tr->translate($bodies1[$key]),
    'title_en'=>$titles1[$key],
    'body_en'=>$bodies1[$key],
    'date'=>$dates1[$key],
    'type'=>$type,
    'language'=>$language,
    'countery_sources'=>$country,
    'countery_news'=>$country,
    'sources'=>$name,
    'created_at'=>Carbon::now());
    News::insert($data);

}


    }
    public function alroeya(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();


        $response = $httpClient->load('https://www.alroeya.com/%D8%A7%D9%84%D8%B3%D9%8A%D8%A7%D8%B3%D8%A9');
        foreach ($response->find('div.col-sm-3 div.container-details-text a > p') as  $title) {
            $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('div.col-sm-3 div.container-details-text > a') as $link) {

          return  $links[] = $link->href;
        }

       // return $links;
      // return json_encode($titles, JSON_UNESCAPED_UNICODE);


        $titles1=[];
        $bodies1=[];
        $dates1=[];
    foreach($titles as $key1=>$title){
     //    $httpClient->load($links[$key1]);
          $titles1[]=$httpClient->load($links[$key1])->find('div.alroeyanew-article-details div.article-title-box h1.article-title',0)->plaintext;
          $bodies1[]=$httpClient->load($links[$key1])->find('article.article-details div.entry-content',0)->plaintext;
          $dates1[]=$httpClient->load($links[$key1])->find('article.article-details div.article-updates div.date-holder span',0)->plaintext;

    }

    }
    public function almadina(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();


        $response = $httpClient->load('https://www.al-madina.com/%D8%A7%D9%82%D8%AA%D8%B5%D8%A7%D8%AF');
        foreach ($response->find('div.sectionArticles a.title') as  $title) {
            $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('div.sectionArticles a.title') as $link) {

              $links[] = $link->href;
        }
         $titles;
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        return $httpClient->load("https://www.al-madina.com/article/750760/الإقتصاد/التأمينات-الاجتماعية-تحدد-آلية-تسوية-المعاش-في-نظام-تبادل-المنافع");
        foreach($titles as $key1=>$title){


            $titles1[]=$httpClient->load($links[$key1])->find('div.titleArticle h1',0)->plaintext;
            $bodies1[]=$httpClient->load($links[$key1])->find('div.article-entry div.bodyText',0)->plaintext;
            $dates1[]=$httpClient->load($links[$key1])->find('div.article-meta li.media_article_publish_time',0)->plaintext;

        }

    }

    public function makkahnewspaper(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
         $response = $httpClient->load('https://makkahnewspaper.com/%D8%A3%D8%B9%D9%85%D8%A7%D9%84');
        foreach ($response->find('div.holder-box__list div.holder-box a.sectionArticles p.box-details-text') as  $title) {
                $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('div.holder-box__list div.holder-box a.sectionArticles') as $link) {

                $links[] = $link->href;
        }

        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
          //  $httpClient->load($links[$key1]);
             $titles1[]=$httpClient->load($links[$key1])->find('header.entry-header h1.entry-title',0)->plaintext;
             $bodies1[]=$httpClient->load($links[$key1])->find('div.entry-content',0)->plaintext;
             $dates1[]=$httpClient->load($links[$key1])->find('span.post-meta-info time.timeago',0)->plaintext;

        }
    }
    public function twentyfour(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();

        $response = $httpClient->load('https://24.ae/section/4/%D9%85%D8%A7%D9%84-%D9%88%D8%A3%D8%B9%D9%85%D8%A7%D9%84');
        foreach ($response->find('div.news-ticker ul.news-ticker-list li a') as  $title) {
                 $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('div.news-ticker ul.news-ticker-list li a') as $link) {

               return $links[] = "https://24.ae/".$link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
          return  $httpClient->load($links[$key1]);
            $titles1[]=$httpClient->load($links[$key1])->find('article.post-content header.entry-header-outer div.entry-header h1.entry-title',0)->plaintext;
            $bodies1[]=$httpClient->load($links[$key1])->find('article.post-content div.entry-content',0)->plaintext;
            $dates1[]=$httpClient->load($links[$key1])->find('article.post-content header.entry-header-outer div.entry-header span.date',0)->plaintext;

        }


    }
    public function alakhbar(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();

        $response = $httpClient->load('https://alakhbar.info/?q=eco');
        foreach ($response->find('div.content div.node-content h1 a') as  $title) {
                $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('div.content div.node-content h1 a') as $link) {

                 $links[] = "https://alakhbar.info".$link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
            $httpClient->load($links[$key1]);
          $titles1[]=$httpClient->load($links[$key1])->find('div#content_article div#title h1',0)->plaintext;
          $bodies1[]=$httpClient->load($links[$key1])->find('div#content_article div.content article.content',0)->plaintext;
            $dates1[]=$httpClient->load($links[$key1])->find('div#content_article div.content span',0)->plaintext;

        }
        $country="موريتانية";
        $name="وكالة أنباء موريتانية مستقلة";
        $type="أقتصادية";
        $language="ar";
        foreach($titles1 as $key=>$title1){
        $data=array(
            'title'=>$titles1[$key],
            'body'=>$bodies1[$key],
            'date'=>$dates1[$key],
            'type'=>$type,
            'language'=>$language,
            'countery_sources'=>$country,
            'countery_news'=>$country,
            'sources'=>$name,
            'created_at'=>Carbon::now());
            News::insert($data);

    }
    }
    //---------------
    public function arabnews(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $tr = new GoogleTranslate('ar');

        $response = $httpClient->load('https://www.arabnews.fr/%C3%A9conomie');
        foreach ($response->find('div.article-item-title h3 a') as  $title) {
                 $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('div.article-item-title h3 a') as $link) {

                $links[] = "https://www.arabnews.fr".$link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
             $httpClient->load($links[$key1]);
               $titles1[]=$httpClient->load($links[$key1])->find('div.entry-article div.entry-title h1',0)->plaintext;
                $bodies1[]=$httpClient->load($links[$key1])->find('div.entry-article div.entry-content',0)->plaintext;
                $dates1[]=$httpClient->load($links[$key1])->find('div.entry-article time.datetime',0)->plaintext;
        }
        $country="شرق الاوسط";
        $name="arabnews";
        $type="أقتصاد";
        $language="fr";

foreach($titles1 as $key=>$title1){


    $data = array(
        'title'=>$tr->translate($titles1[$key]),
        'body'=>$tr->translate($bodies1[$key]),
                    'title_fr'=>$titles1[$key],
                    'body_fr'=>$bodies1[$key],
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
    public function arabnewsen(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $tr = new GoogleTranslate('ar');

        $response = $httpClient->load('https://www.arabnews.com/economy');
        foreach ($response->find('div.article-item-title h2 a') as  $title) {
                 $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('div.article-item-title h2 a') as $link) {

                $links[] = "https://www.arabnews.com".$link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
             $httpClient->load($links[$key1]);
               $titles1[]=$httpClient->load($links[$key1])->find('div.entry-article div.entry-title h1',0)->plaintext;
                $bodies1[]=$httpClient->load($links[$key1])->find('div.entry-article div.entry-content',0)->plaintext;
                $dates1[]=$httpClient->load($links[$key1])->find('div.entry-article div.entry-date',0)->plaintext;
        }
        $country="شرق الاوسط";
        $name="arabnews";
        $type="أقتصاد";
        $language="en";

foreach($titles1 as $key=>$title1){


    $data = array(
        'title'=>$tr->translate($titles1[$key]),
        'body'=>$tr->translate($bodies1[$key]),
                    'title_en'=>$titles1[$key],
                    'body_en'=>$bodies1[$key],
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
    //-----------------
    public function bthksa(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://bth-ksa.com/new/l/15/-%D8%B3%D9%8A%D8%A7%D8%B3%D9%8A%D9%87-%D9%88%D8%AF%D9%88%D9%84%D9%8A%D8%A9');
        foreach ($response->find('div.display-mods div.rownews div.caption h3.p4') as  $title) {
                 $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('div.display-mods div.rownews div.caption h3.p4 a') as $link) {

              $links[] = $link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
             $httpClient->load($links[$key1]);
             $titles1[]=$httpClient->load($links[$key1])->find('div#replaceme-1 h1.xlarge',0)->plaintext;
             $bodies1[]=$httpClient->load($links[$key1])->find('div#replaceme-1 div.bodycontent',0)->plaintext;
             $dates1[]=$httpClient->load($links[$key1])->find('span[itemprop="datePublished"]',0)->plaintext;
        }
        $country="المملكة العربية السعودية";
        $name="صحيفة بث";
        $type="أقتصاد";
        $language="ar";
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
    //--------------
    public function sputniknews(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $tr = new GoogleTranslate('ar');
        $response = $httpClient->load('https://sputniknews.com/business/');
        foreach ($response->find('div.list div.list__item div.list__content a.list__title') as  $title) {
                 $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('div.list div.list__item div.list__content a.list__title') as $link) {

              $links[] = "https://sputniknews.com".$link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
            $httpClient->load($links[$key1]);
            $titles1[]=$httpClient->load($links[$key1])->find('div.article div.article__header h1.article__title',0)->plaintext;
            $bodies1[]=$httpClient->load($links[$key1])->find('div.article div.article__body',0)->plaintext;
            $dates1[]=$httpClient->load($links[$key1])->find('div.article div.article__header div.article__info-date a',0)->plaintext;
        }
        $country="Moscow";
        $name=" sputniknews";
        $type="أقتصاد";
        $language="en";
foreach($titles1 as $key=>$title1){


    $data = array(
        'title'=>$tr->translate($titles1[$key]),
        'body'=>$tr->translate($bodies1[$key]),
                    'title_en'=>$titles1[$key],
                    'body_en'=>$bodies1[$key],
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
    public function sputniknewsar(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $tr = new GoogleTranslate('ar');
        $response = $httpClient->load('https://arabic.sputniknews.com/business/');
        foreach ($response->find('div.b-stories__title h2 a') as  $title) {
               $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('div.b-stories__title h2 a') as $link) {

               $links[] = "https://arabic.sputniknews.com".$link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
              $httpClient->load($links[$key1]);
              $titles1[]=$httpClient->load($links[$key1])->find('div.b-article__header-title  h1',0)->plaintext;
               $bodies1[]=$httpClient->load($links[$key1])->find('div.b-article__text',0)->plaintext;
                $dates1[]=$httpClient->load($links[$key1])->find('time.b-article__refs-date',0)->plaintext;
        }
        $country="Moscow";
        $name=" sputniknews";
        $type="أقتصاد";
        $language="ar";
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
    public function sputniknewspe(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $tr = new GoogleTranslate('ar');
        $response = $httpClient->load('https://ir.sputniknews.com/politics/');
        foreach ($response->find('div.b-stories__title h2 a') as  $title) {
               $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('div.b-stories__title h2 a') as $link) {

               $links[] = "https://ir.sputniknews.com".$link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
              $httpClient->load($links[$key1]);
              $titles1[]=$httpClient->load($links[$key1])->find('div.b-article__header-title  h1',0)->plaintext;
               $bodies1[]=$httpClient->load($links[$key1])->find('div.b-article__text',0)->plaintext;
                $dates1[]=$httpClient->load($links[$key1])->find('time.b-article__refs-date',0)->plaintext;
        }
        $country="Moscow";
        $name=" sputniknews";
        $type="سياسي";
        $language="pe";
foreach($titles1 as $key=>$title1){


    $data = array(
                    'title'=>$tr->translate($titles1[$key]),
                    'body'=>$tr->translate($bodies1[$key]),
                    'title_pe'=>$titles1[$key],
                    'body_pe'=>$bodies1[$key],
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
    public function almnatiq(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();

        $response = $httpClient->load('http://almnatiq.net/category/%d8%a7%d9%84%d8%a7%d9%82%d8%aa%d8%b5%d8%a7%d8%af/');
        foreach ($response->find('div.section-e div.fourth a.single-post h2.the-title') as  $title) {
                 $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('div.section-e div.fourth a.single-post') as $link) {

                 $links[] = $link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
            $httpClient->load($links[$key1]);
            $titles1[]=$httpClient->load($links[$key1])->find('article.single-post header.entry-header div.title-block h1.main-title',0)->plaintext;
            $bodies1[]=$httpClient->load($links[$key1])->find('article.single-post div.entry-content',0)->plaintext;
            $dates1[]=$httpClient->load($links[$key1])->find('article.single-post header.entry-header div.title-block time',0)->plaintext;

        }
        $country="المملكة العربية السعودية";
        $name="صحيفة المناطق السعودية";
        $type="أقتصادية";
        $language="ar";
        foreach($titles1 as $key=>$title1){
        $data=array(
            'title'=>$titles1[$key],
            'body'=>$bodies1[$key],
            'date'=>$dates1[$key],
            'type'=>$type,
            'language'=>$language,
            'countery_sources'=>$country,
            'countery_news'=>$country,
            'sources'=>$name,
            'created_at'=>Carbon::now());
            News::insert($data);

    }
    }

    //-----------------

    public function bawabaa(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();

        $response = $httpClient->load('https://bawabaa.org/sections/business/economy/');
        foreach ($response->find('div.jeg_posts article.jeg_post h3.jeg_post_title a') as  $title) {
               $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('div.jeg_posts article.jeg_post h3.jeg_post_title a') as $link) {

                $links[] = $link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
                $httpClient->load($links[$key1]);
             $titles1[]=$httpClient->load($links[$key1])->find('div.jeg_inner_content div.entry-header h1.jeg_post_title',0)->plaintext;
            $bodies1[]=$httpClient->load($links[$key1])->find('div.jeg_inner_content div.entry-content div.content-inner',0)->plaintext;
             $dates1[]=$httpClient->load($links[$key1])->find('div.jeg_inner_content div.entry-header div.jeg_meta_date a',0)->plaintext;

        }
        $country="شرق الاوسط";
        $name="بوابة الاخبار";
        $type="أقتصادية";
        $language="ar";
        foreach($titles1 as $key=>$title1){
        $data=array(
            'title'=>$titles1[$key],
            'body'=>$bodies1[$key],
            'date'=>$dates1[$key],
            'type'=>$type,
            'language'=>$language,
            'countery_sources'=>$country,
            'countery_news'=>$country,
            'sources'=>$name,
            'created_at'=>Carbon::now());
            News::insert($data);

    }
    }
    public function albiladdaily(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();

        $response = $httpClient->load('https://albiladdaily.com/category/%d8%a5%d9%82%d8%aa%d8%b5%d8%a7%d8%af/');
        foreach ($response->find('article.posts-list__item h5.entry-title a') as  $title) {
                $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('article.posts-list__item h5.entry-title a') as $link) {

                 $links[] = $link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
             $httpClient->load($links[$key1]);
             $titles1[]=$httpClient->load($links[$key1])->find('article.post h1.entry-title',0)->plaintext;
             $bodies1[]=$httpClient->load($links[$key1])->find('article.post div.entry-content',0)->plaintext;
             $dates1[]=$httpClient->load($links[$key1])->find('article.post span.post__date a',0)->plaintext;

        }
        $country="المملكة العربية السعودية";
        $name="صحيفة البلاد";
        $type="أقتصادية";
        $language="ar";
        foreach($titles1 as $key=>$title1){
        $data=array(
            'title'=>$titles1[$key],
            'body'=>$bodies1[$key],
            'date'=>$dates1[$key],
            'type'=>$type,
            'language'=>$language,
            'countery_sources'=>$country,
            'countery_news'=>$country,
            'sources'=>$name,
            'created_at'=>Carbon::now());
            News::insert($data);

    }

    }
    public function alekhbarya(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();

        $response = $httpClient->load('https://alekhbarya.com/category/%d8%a7%d9%82%d8%aa%d8%b5%d8%a7%d8%af/');
        foreach ($response->find('div.post-details h2.post-title a') as  $title) {
                $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('div.post-details h2.post-title a') as $link) {

              $links[] = $link->href;
        }

        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
            $httpClient->load($links[$key1]);
            $titles1[]=$httpClient->load($links[$key1])->find('article.post-content header.entry-header-outer div.entry-header h1.entry-title',0)->plaintext;
            $bodies1[]=$httpClient->load($links[$key1])->find('article.post-content div.entry-content',0)->plaintext;
            $dates1[]=$httpClient->load($links[$key1])->find('article.post-content header.entry-header-outer div.entry-header span.date',0)->plaintext;

        }
        $country="العراق";
        $name="alekhbarya";
        $type="أقتصادية";
        $language="ar";
        foreach($titles1 as $key=>$title1){
        $data=array(
            'title'=>$titles1[$key],
            'body'=>$bodies1[$key],
            'date'=>$dates1[$key],
            'type'=>$type,
            'language'=>$language,
            'countery_sources'=>$country,
            'countery_news'=>$country,
            'sources'=>$name,
            'created_at'=>Carbon::now());
            News::insert($data);

    }

    }

public function baghdadtoday(){

    require '../vendor/autoload.php';
    $httpClient = new \simplehtmldom\HtmlWeb();

    $response = $httpClient->load('https://baghdadtoday.news/category/6/%D8%B3%D9%8A%D8%A7%D8%B3%D8%A9?pageindex=1');
    foreach ($response->find('div.inner-news-section div.sub-news a p') as  $title) {
            $titles[] = $title->plaintext;
    }

    $links = [];
    foreach ($response->find('div.inner-news-section div.sub-news a') as $link) {

          $links[] = "https://baghdadtoday.news".$link->href;
    }

    $titles1=[];
    $bodies1=[];
    $dates1=[];
    foreach($titles as $key1=>$title){
        $httpClient->load($links[$key1]);
         $titles1[]=$httpClient->load($links[$key1])->find('h3',0)->plaintext;
         $bodies1[]=$httpClient->load($links[$key1])->find('div.entry-content',0)->plaintext;
         $dates1[]=$httpClient->load($links[$key1])->find('header.entry-header div.entry-meta span.updated',0)->plaintext;

    }

}

    public function iraqakhbar(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();


          $response = $httpClient->load('https://iraqakhbar.com/business-news');
        foreach ($response->find('header.entry-header h2.entry-title a') as  $title) {
                $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('header.entry-header h2.entry-title a') as $link) {

                $links[] = $link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
             $httpClient->load($links[$key1]);
             $titles1[]=$httpClient->load($links[$key1])->find('header.entry-header h1.entry-title',0)->plaintext;
             $bodies1[]=$httpClient->load($links[$key1])->find('div.entry-content',0)->plaintext;
             $dates1[]=$httpClient->load($links[$key1])->find('header.entry-header div.entry-meta span.updated',0)->plaintext;

        }

        $country="العراق";
        $name="اخبار العراق";
        $type="سياسية";
        $language="ar";
        foreach($titles1 as $key=>$title1){
        $data=array(
            'title'=>$titles1[$key],
            'body'=>$bodies1[$key],
            'date'=>$dates1[$key],
            'type'=>$type,
            'language'=>$language,
            'countery_sources'=>$country,
            'countery_news'=>$country,
            'sources'=>$name,
            'created_at'=>Carbon::now());
            News::insert($data);

    }
    }
    public function dotalkhaleej(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();


        $response = $httpClient->load('https://dotalkhaleej.co/economy');
        foreach ($response->find('header.entry-header h2.entry-title a') as  $title) {
                $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('header.entry-header h2.entry-title a') as $link) {

                $links[] = "https://dotalkhaleej.co".$link->href;
        }
       $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
            $httpClient->load($links[$key1]);
             $titles1[]=$httpClient->load($links[$key1])->find('header.entry-header h1.entry-title',0)->plaintext;
             $bodies1[]=$httpClient->load($links[$key1])->find('div.entry-content',0)->plaintext;
             $dates1[]=$httpClient->load($links[$key1])->find('span.post-meta-info time.timeago',0)->plaintext;

        }

        $country="الخليج العربي";
        $name="دوت الخليج";
        $type="أقتصادية";
        $language="ar";
        foreach($titles1 as $key=>$title1){
        $data=array(
            'title'=>$titles1[$key],
            'body'=>$bodies1[$key],
            'date'=>$dates1[$key],
            'type'=>$type,
            'language'=>$language,
            'countery_sources'=>$country,
            'countery_news'=>$country,
            'sources'=>$name,
            'created_at'=>Carbon::now());
            News::insert($data);

    }
    }
    public function akhbaralaan(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();


        $response = $httpClient->load('https://www.akhbaralaan.net/business');
        foreach ($response->find('div.single_post_text h4 a') as  $title) {
                $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('div.single_post_text h4 a') as $link) {

            $links[] = "https://www.akhbaralaan.net".$link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
             $httpClient->load($links[$key1]);
             $titles1[]=$httpClient->load($links[$key1])->find('div.card div.single_post_heading h1',0)->plaintext;
             $bodies1[]=$httpClient->load($links[$key1])->find('div.card',0)->plaintext;
             $dates1[]=$httpClient->load($links[$key1])->find('div.card strong small.d2',0)->plaintext;

        }
        $country="الامارات العربية المتحدة";
        $name="أخبار الآن";
        $type="أقتصادية";
        $language="ar";
        foreach($titles1 as $key=>$title1){
        $data=array(
            'title'=>$titles1[$key],
            'body'=>$bodies1[$key],
            'date'=>$dates1[$key],
            'type'=>$type,
            'language'=>$language,
            'countery_sources'=>$country,
            'countery_news'=>$country,
            'sources'=>$name,
            'created_at'=>Carbon::now());
            News::insert($data);
    }
    }
    public function albayan(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();


        $response = $httpClient->load('https://www.albayan.ae/world/political-issues');
        foreach ($response->find('div.section section.text h3 a') as  $title) {
            $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('div.section section.text h3 a') as $link) {

            $links[] = "https://www.albayan.ae".$link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
            $httpClient->load($links[$key1]);
            $titles1[]=$httpClient->load($links[$key1])->find('div.articledetails h1.title',0)->plaintext;
            $bodies1[]=$httpClient->load($links[$key1])->find('div.articledetails div.articlecontent',0)->plaintext;
            $dates1[]=$httpClient->load($links[$key1])->find('div.articledetails div.publish-date time',0)->plaintext;

        }
        $country="الامارات العربية المتحدة";
        $name="صحيفة البيان";
        $type="سياسية";
        $language="ar";
        foreach($titles1 as $key=>$title1){
        $data=array(
            'title'=>$titles1[$key],
            'body'=>$bodies1[$key],
            'date'=>$dates1[$key],
            'type'=>$type,
            'language'=>$language,
            'countery_sources'=>$country,
            'countery_news'=>$country,
            'sources'=>$name,
            'created_at'=>Carbon::now());
            News::insert($data);
    }

    }
    public function albawabhnews(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();


        $response = $httpClient->load('https://www.albawabhnews.com/category/72');
        foreach ($response->find('div.cont div.item-card div.txt-cont h3') as  $title) {
            $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('div.cont div.item-card a') as $link) {

            $links[] = "https://www.albawabhnews.com".$link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
        $httpClient->load($links[$key1]);
            $titles1[]=$httpClient->load($links[$key1])->find('article.cont h1',0)->plaintext;
             $bodies1[]=$httpClient->load($links[$key1])->find('article.cont div.paragraph-list',0)->plaintext;
            $dates1[]=$httpClient->load($links[$key1])->find('article.cont div.publish time',0)->plaintext;

        }
        $country="مصر";
        $name="البوابة نيوز";
        $type="سياسية";
        $language="ar";
        foreach($titles1 as $key=>$title1){
        $data=array(
            'title'=>$titles1[$key],
            'body'=>$bodies1[$key],
            'date'=>$dates1[$key],
            'type'=>$type,
            'language'=>$language,
            'countery_sources'=>$country,
            'countery_news'=>$country,
            'sources'=>$name,
            'created_at'=>Carbon::now());
            News::insert($data);
    }

    }
public function alkhaleej(){
    require '../vendor/autoload.php';
    $httpClient = new \simplehtmldom\HtmlWeb();


    $response = $httpClient->load('https://www.alkhaleej.ae/%D8%B3%D9%8A%D8%A7%D8%B3%D8%A9');
    foreach ($response->find('div.group-right h3.teaser-title a') as  $title) {
        $titles[] = $title->plaintext;
    }

    $links = [];
    foreach ($response->find('div.group-right h3.teaser-title a') as $link) {

        $links[] = "https://www.alkhaleej.ae".$link->href;
    }
    $titles1=[];
    $bodies1=[];
    $dates1=[];
    foreach($titles as $key1=>$title){
    $httpClient->load($links[$key1]);
        $titles1[]=$httpClient->load($links[$key1])->find('div.basic-info-wrapper h1.page-title',0)->plaintext;
        $bodies1[]=$httpClient->load($links[$key1])->find('div.article-content-wrapper div.field--type-text-with-summary',0)->plaintext;
        $dates1[]=$httpClient->load($links[$key1])->find('div.basic-info-wrapper div.field--name-node-post-date',0)->plaintext;

    }
    $country="الامارات العربية المتحدة";
    $name="alkhaleej";
    $type="سياسية";
    $language="ar";
foreach($titles1 as $key=>$title1){
    $data=array(
        'title'=>$titles1[$key],
        'body'=>$bodies1[$key],
        'date'=>$dates1[$key],
        'type'=>$type,
        'language'=>$language,
        'countery_sources'=>$country,
        'countery_news'=>$country,
        'sources'=>$name,
        'created_at'=>Carbon::now());
        News::insert($data);
}


}
    public function elyamnelaraby(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();


        $response = $httpClient->load('https://www.elyamnelaraby.com/List/2/%D8%A3%D9%82%D8%AA%D8%B5%D8%A7%D8%AF');
        foreach ($response->find('div.news-list div.item-li a div.txt-cont h3') as  $title) {
            $titles[] = $title->plaintext;
        }

        $links = [];
        foreach ($response->find('div.news-list div.item-li a') as $link) {

            $links[] = $link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
    foreach($titles as $key1=>$title){
        // $links[$key1];
        return  $httpClient->load($links[$key1]);
       return   $titles1[]=$httpClient->load($links[$key1])->find('article.cont h1.primary-title',0)->plaintext;
          $bodies1[]=$httpClient->load($links[$key1])->find('article.article-details div.entry-content',0)->plaintext;
          $dates1[]=$httpClient->load($links[$key1])->find('article.article-details div.article-updates div.date-holder span',0)->plaintext;

    }
    }
    public function eremnews(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
         $response = $httpClient->load('https://www.eremnews.com/category/economy');
        foreach ($response->find('div.four-entry article.entry h3.entry-title a') as  $title) {
            $titles[] = $title->plaintext;
     }


      $links = [];
      foreach ($response->find('div.four-entry article.entry h3.entry-title a') as $link) {

          $links[] = $link->href;
      }

      $titles1=[];
      $bodies1=[];
      $dates1=[];
  foreach($titles as $key1=>$title){
        $httpClient->load($links[$key1]);
        $titles1[]=$httpClient->load($links[$key1])->find('article.article-details h1.article-title',0)->plaintext;
        $bodies1[]=$httpClient->load($links[$key1])->find('article.article-details div.entry-content',0)->plaintext;
        $dates1[]=$httpClient->load($links[$key1])->find('article.article-details div.article-updates div.date-holder span',0)->plaintext;

  }

$country="أبو ظبي";
$name="إرم نيوز";
$type="أقتصادية";
$language="ar";
foreach($titles1 as $key=>$title1){
    $data=array(



        'title'=>$titles1[$key],
        'body'=>$bodies1[$key],
        'date'=>$dates1[$key],
        'type'=>$type,
        'language'=>$language,
        'countery_sources'=>$country,
        'countery_news'=>$country,
        'sources'=>$name,
        'created_at'=>Carbon::now());
    News::insert($data);
}


    }
    public function bna(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://www.bna.bh/GenerateRssFeed.aspx?categoryId=176');
    foreach ($response->find('item title') as  $title) {
          $titles[] = $title->plaintext;
   }
    $links = [];
    foreach ($response->find('link') as $link) {

      return  $links[] = $link->plaintext;
    }

    }
    public function ina(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://www.ina.iq/political/');
    foreach ($response->find('div.news-wrapper div.inner-news-block div.para p a') as  $title) {
          $titles[] = $title->plaintext;
   }

    $links = [];
    foreach ($response->find('div.inner-news-block div.para p a') as $link) {

        $links[] = $link->href;
    }
    $titles1=[];
    $bodies1=[];
    $dates1=[];
foreach($titles as $key1=>$title){
     $httpClient->load($links[$key1]);
      $titles1[]=$httpClient->load($links[$key1])->find('div.news-wrapper h1.main-title a',0)->plaintext;
      $bodies1[]=$httpClient->load($links[$key1])->find('div.news-wrapper div.news-details div.news-text',0)->plaintext;
      $dates1[]=$httpClient->load($links[$key1])->find('div.news-wrapper div.news-details ul.info',0)->plaintext;

}
$country="العراق";
$name="ina";
$type="السياسية";
$language="ar";
foreach($titles1 as $key=>$title1){
    $data=array(



        'title'=>$titles1[$key],
        'body'=>$bodies1[$key],
        'date'=>$dates1[$key],
        'type'=>$type,
        'language'=>$language,
        'countery_sources'=>$country,
        'countery_news'=>$country,
        'sources'=>$name,
        'created_at'=>Carbon::now());
    News::insert($data);
}
    }
    public function okaz(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://www.okaz.com.sa/economy');
        foreach ($response->find('section.section li.update a') as  $title) {
            $titles[] = $title->title;
       }

        $links = [];
        foreach ($response->find('section.section li.update a') as $link) {

            $links[] = $link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
        //  $httpClient->load($links[$key1]);
            $titles1[]=$httpClient->load($links[$key1])->find('header.article-head h1.autoHeight',0)->plaintext;
            $bodies1[]=$httpClient->load($links[$key1])->find('div.article-entry div.bodyText',0)->plaintext;
            $dates1[]=$httpClient->load($links[$key1])->find('div.article-meta li.media_article_publish_time',0)->plaintext;

        }


$country="المملكة العربية السعودية";
$name="okaz";
$type="أقتصادية";
$language="ar";
foreach($titles1 as $key=>$title1){
    $data=array(



        'title'=>$titles1[$key],
        'body'=>$bodies1[$key],
        'date'=>$dates1[$key],
        'type'=>$type,
        'language'=>$language,
        'countery_sources'=>$country,
        'countery_news'=>$country,
        'sources'=>$name,
        'created_at'=>Carbon::now());
    News::insert($data);
}


    }
    public function sana(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();


        $response = $httpClient->load('http://www.sana.sy/?cat=122');
        foreach ($response->find('article.item-list h2.post-box-title a') as  $title) {
            $titles[] = $title->plaintext;
       }

        $links = [];
        foreach ($response->find('article.item-list h2.post-box-title a') as $link) {

            $links[] = $link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
          $httpClient->load($links[$key1]);
            $titles1[]=$httpClient->load($links[$key1])->find('div.content h1.post-title span',0)->plaintext;
            $bodies1[]=$httpClient->load($links[$key1])->find('div.content div.entry',0)->plaintext;
            $dates1[]=$httpClient->load($links[$key1])->find('div.content span.tie-date',0)->plaintext;

        }


$country="مصر";
$name="sana";
$type="أقتصادية";
$language="ar";
foreach($titles1 as $key=>$title1){
    $data=array(
        'title'=>$titles1[$key],
        'body'=>$bodies1[$key],
        'date'=>$dates1[$key],
        'type'=>$type,
        'language'=>$language,
        'countery_sources'=>$country,
        'countery_news'=>$country,
        'sources'=>$name,
        'created_at'=>Carbon::now());
        News::insert($data);
}
    }
    //-----------------------


    public function sanafr(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $tr = new GoogleTranslate('ar');



        $response = $httpClient->load('http://www.sana.sy/fr/?cat=485');
        foreach ($response->find('h2.post-box-title a') as  $title) {
            $titles[] = $title->plaintext;
       }
       $links = [];
       foreach ($response->find('h2.post-box-title a') as $link) {

           $links[] = $link->href;
       }
       $titles1=[];
       $bodies1=[];
       $dates1=[];
       foreach($titles as $key1=>$title){
         $httpClient->load($links[$key1]);
           $titles1[]=$httpClient->load($links[$key1])->find('div.content h1.post-title span',0)->plaintext;
           $bodies1[]=$httpClient->load($links[$key1])->find('div.content div.entry',0)->plaintext;
           $dates1[]=$httpClient->load($links[$key1])->find('div.content span.tie-date',0)->plaintext;

       }



    $country="مصر";
    $name="sana";
    $type="أقتصادية";
    $language="ar";
    $languagesecond="fr";
    foreach($titles1 as $key=>$title1){
    $data=array(
        'title'=>$tr->translate($titles1[$key]),
        'body'=>$tr->translate($bodies1[$key]),
        'title_fr'=>$titles1[$key],
        'body_fr'=>$bodies1[$key],
        'date'=>$dates1[$key],
        'type'=>$type,
        'language'=>$languagesecond,
        'countery_sources'=>$country,
        'countery_news'=>$country,
        'sources'=>$name,
        'created_at'=>Carbon::now());
        News::insert($data);
    }

    }
    //-------------------
    public function shorouknews(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://www.shorouknews.com/Economy');
        foreach ($response->find('ul.listing div.text a') as  $title) {
                 $titles[] = $title->plaintext;
            }

        $links = [];
        foreach ($response->find('ul.listing div.text a') as $link) {

            $links[] = "https://www.shorouknews.com/".$link->href;
        }
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){

       $httpClient->load($links[$key1]);
            $titles1[]=$httpClient->load($links[$key1])->find('div.innerNews h1',0)->plaintext;
            $bodies1[]=$httpClient->load($links[$key1])->find('div.innerNews div.eventContent',0)->plaintext;
            $dates1[]=$httpClient->load($links[$key1])->find('div.innerNews div.date span',0)->plaintext;

        }
        $country="مصر";
        $name="shorouknews";
        $type="أقتصادية";
        $language="ar";
        foreach($titles1 as $key=>$title1){
            $data=array(



                'title'=>$titles1[$key],
                'body'=>$bodies1[$key],
                'date'=>$dates1[$key],
                'type'=>$type,
                'language'=>$language,
                'countery_sources'=>$country,
                'countery_news'=>$country,
                'sources'=>$name,
                'created_at'=>Carbon::now());
            News::insert($data);
        }

    }
    public function theguardian(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://www.theguardian.com/uk/business');
        $titles=[];
        foreach ($response->find('section#business ul.u-unstyled div.fc-item__container a.u-faux-block-link__overlay') as  $title) {
        return     $titles[] = $title->plaintext;
        }

    $links = [];
    foreach ($response->find('section#business div.fc-item__container a.u-faux-block-link__overlay') as $link) {

        $links[] = $link->href;
    }
    $titles1=[];
    $bodies1=[];
    $dates1=[];
    foreach($titles as $key1=>$title){


  return $httpClient->load($links[$key1]);
       return $titles1[]=$httpClient->load($links[$key1])->find('div.content__header div.content__main-column h1.content__headline',0)->plaintext;
        $bodies1[]=$httpClient->load($links[$key1])->find('div.o-article__body div.content__main div.js-liveblog-body-content',0)->plaintext;
        $dates1[]=$httpClient->load($links[$key1])->find('div.c-article-contributors time.c-article-date',0)->plaintext;

    }

    }
    public function youm7(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://www.youm7.com/Section/%D8%A7%D9%82%D8%AA%D8%B5%D8%A7%D8%AF-%D9%88%D8%A8%D9%88%D8%B1%D8%B5%D8%A9/297/1');
        $titles=[];
            foreach ($response->find('div.section-news div.bigOneSec h3 a') as  $title) {
                 $titles[] = $title->plaintext;
            }

        $links = [];
        foreach ($response->find('div.section-news div.bigOneSec h3 a') as $link) {

            $links[] = "https://www.youm7.com/".$link->href;
        }

        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){


      return $httpClient->load($links[$key1]);
           return $titles1[]=$httpClient->load($links[$key1])->find('div.articleHeader h1')->plaintext;
            $bodies1[]=$httpClient->load($links[$key1])->find('div.o-article__body div.c-article-content',0)->plaintext;
            $dates1[]=$httpClient->load($links[$key1])->find('div.c-article-contributors time.c-article-date',0)->plaintext;

        }

    }

    public function alainpolitics(){
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://al-ain.com/section/politics/');
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
$language="ar";

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

         $N= News::where('#')->insert($data);
         if($N){
return "yes";
         }else{
return "no";
         }

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

$links = [];
foreach ($response->find('div.comp_1.comp.id_644 div.comp_1_inner_cont div.comp_1_cont  div.comp_1_content_container div.comp_1_item a.comp_1_item_inner_cont') as $link) {

     $links[] = "https://www.skynewsarabia.com".$link->href;

}
 //return $links= json_encode($links, JSON_UNESCAPED_UNICODE);
//return $links;
$titles1=[];
$bodies1=[];
$dates1=[];
foreach($titles as $key1=>$title){
    return $httpClient->load($links[0]);
    $titles1[]=$httpClient->load($links[$key1])->find('header.o-article__header h1.c-article-title',0)->plaintext;
     $bodies1[]=$httpClient->load($links[$key1])->find('div.o-article__body div.c-article-content',0)->plaintext;
     $dates1[]=$httpClient->load($links[$key1])->find('div.c-article-contributors time.c-article-date',0)->plaintext;

}

$country="الإمارات العربية المتحدة";
$name=" skynewsarabia";
$type="أقتصادية";
$language="ar";

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

    public function irr(){

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
    //--------------------------------------------------------------------------------------
    public function irbusiness(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://www.voanews.com/economy-business');

// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('div.grid div.teaser div.teaser__content div.teaser__title a.teaser__title-link span') as  $title) {
     $titles[] = $title->plaintext;
}


$links = [];

foreach ($response->find('div.grid div.teaser div.teaser__content div.teaser__title a.teaser__title-link') as $link) {

    $links[] = 'https://www.voanews.com/'.$link->href;
}



$response=[];
$titles1=[];
$bodies1=[];
$dates1=[];

foreach($links as $key1=>$link){
     $httpClient->load($links[$key1]);

     return $titles1[] = $httpClient->load($links[$key1])->find('main[id=main-content] div[id=block-voa-content] div.article__main div.page-header h1.page-header__title',0);

}



$country="إيران";
$name=" voanews";
$type="economy";
$language="إيران";
foreach($titles1 as $key=>$title1){

    $data = array(
                    'title'=>$titles1[$key],

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
    //--------------------------roters

       //--------------------------------------------------------------------------------------
       public function reuters(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $tr = new GoogleTranslate('ar');


        $response = $httpClient->load('https://www.reuters.com/business/');

// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('div.SpacingContainer__container___2kvuUN div.StoryCollection__story___3EY8PG a.story-card div.MediaStoryCard__body___1Iz8IK h6.Text__text___3eVx1j') as  $title) {
     $titles[] = $title->plaintext;
}


$links = [];

foreach ($response->find('div.SpacingContainer__container___2kvuUN div.StoryCollection__story___3EY8PG a.story-card') as $link) {

    $links[] = 'https://www.reuters.com'.$link->href;
}



$response=[];
$titles1=[];
$bodies1=[];
$dates1=[];

foreach($links as $key1=>$link){
     $httpClient->load($links[$key1]);

      $titles1[] = $httpClient->load($links[$key1])->find('div.ArticleHeader__container___3rO4Ad div.ArticleHeader__heading___3ibi0Q h1.Text__text___3eVx1j',0)->plaintext;

}
foreach($links as $key1=>$link){
     $httpClient->load($links[$key1]);

      $bodies1[] = $httpClient->load($links[$key1])->find('div.Article__container___7jklW_ div.ArticleBody__container___D-h4BJ div.ArticleBody__content___2gQno2',0)->plaintext;

}
foreach($links as $key1=>$link){
    $httpClient->load($links[$key1]);

     $dates1[] = $httpClient->load($links[$key1])->find('div.Article__container___7jklW_ div.ArticleHeader__container___3rO4Ad time.Text__text___3eVx1j',0)->plaintext;

}



$country="all";
$name="reuters";
$type="economy";
$language="en";
foreach($titles1 as $key=>$title1){


    $data = array(
        'title'=>$tr->translate($titles1[$key]),
        'body'=>$tr->translate($bodies1[$key]),
                    'title_en'=>$titles1[$key],
                    'body_en'=>$bodies1[$key],
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
    //-----------------------------------------------------end








    //--------------------------------------------------------------------------------------------
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

    $links[] = "https://www.mc-doualiya.com" .$link->href;
}
$dates=[];
$titles1=[];
$bodies1=[];
$dates1=[];
foreach($titles as $key1=>$title){
  //  return $httpClient->load($links[$key1]);
    $titles1[]=$httpClient->load($links[$key1])->find('div.t-content h1.t-content__title',0)->plaintext;
     $bodies1[]=$httpClient->load($links[$key1])->find('div.t-content__body p',0)->plaintext;
     $dates1[]=$httpClient->load($links[$key1])->find('div.t-content__dates p.m-pub-dates span.m-pub-dates__date time',0)->plaintext;

}
$country="فرنسا";
$language="ar";
$name=" mc-doualiya";
$type="رياضية";
foreach($titles1 as $key=>$title1){
    $data=array(

        'title'=>$titles1[$key],
        'body'=>$bodies1[$key],
        'date'=>$dates1[$key],
        'type'=>$type,
        'language'=>$language,
        'countery_sources'=>$country,
        'countery_news'=>$country,
        'sources'=>$name,
        'created_at'=>Carbon::now());
    News::insert($data);
}

    }

    public function euronews(){
         $tr = new GoogleTranslate('ar');
         $tr->translate('english');
        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://www.euronews.com/news/business');
$titles=[];
foreach ($response->find('div.o-block-listing__articles article div.m-object__body h3.m-object__title a') as  $title) {
    $titles[] = $title->plaintext;
}
$links = [];
foreach ($response->find('div.o-block-listing__articles article div.m-object__body h3.m-object__title a') as $link) {
    $links[] = 'https://www.euronews.com/'.$link->href;
}
$titles1=[];
$bodies1=[];
$dates1=[];
foreach($titles as $key1=>$title){
    $titles1[]=$httpClient->load($links[$key1])->find('header.o-article__header h1.c-article-title',0)->plaintext;
     $bodies1[]=$httpClient->load($links[$key1])->find('div.o-article__body div.c-article-content',0)->plaintext;
     $dates1[]=$httpClient->load($links[$key1])->find('div.c-article-contributors time.c-article-date',0)->plaintext;
}
$country="euroba";
$name="euronews";
$type="أقتصادية";
$language="en";
foreach($titles1 as $key=>$title1){
    $data=array(
        'title'=>$tr->translate($titles1[$key]),
        'body'=>$tr->translate($bodies1[$key]),
        'title_en'=>$titles1[$key],
        'body_en'=>$bodies1[$key],
        'date'=>$dates1[$key],
        'type'=>$type,
        'language'=>$language,
        'countery_sources'=>$country,
        'countery_news'=>$country,
        'sources'=>$name,
        'created_at'=>Carbon::now());
    News::insert($data);
}
    }
    public function euronewsper(){
        $tr = new GoogleTranslate('ar');

       require '../vendor/autoload.php';
       $httpClient = new \simplehtmldom\HtmlWeb();
       $response = $httpClient->load('https://per.euronews.com/news/business');
$titles=[];
foreach ($response->find('div.o-block-listing__articles article div.m-object__body h3.m-object__title a') as  $title) {
   $titles[] = $title->plaintext;
}
$links = [];
foreach ($response->find('div.o-block-listing__articles article div.m-object__body h3.m-object__title a') as $link) {
   $links[] = 'https://per.euronews.com/'.$link->href;
}
$titles1=[];
$bodies1=[];
$dates1=[];
foreach($titles as $key1=>$title){
   $titles1[]=$httpClient->load($links[$key1])->find('header.o-article__header h1.c-article-title',0)->plaintext;
    $bodies1[]=$httpClient->load($links[$key1])->find('div.o-article__body div.c-article-content',0)->plaintext;
    $dates1[]=$httpClient->load($links[$key1])->find('div.c-article-contributors time.c-article-date',0)->plaintext;
}
$country="euroba";
$name="euronews";
$type="أقتصادية";
$language="tr";
foreach($titles1 as $key=>$title1){
   $data=array(
       'title'=>$tr->translate($titles1[$key]),
       'body'=>$tr->translate($bodies1[$key]),
       'title_pe'=>$titles1[$key],
       'body_pe'=>$bodies1[$key],
       'date'=>$dates1[$key],
       'type'=>$type,
       'language'=>$language,
       'countery_sources'=>$country,
       'countery_news'=>$country,
       'sources'=>$name,
       'created_at'=>Carbon::now());
   News::insert($data);
}
   }
    public function euronewssport(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
     return   $response = $httpClient->load('https://arabic.euronews.com/news/sport');

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
       return $response = $httpClient->load('https://shafaq.com/ar/%D8%A7%D9%82%D8%AA%D8%B5%D9%80%D8%A7%D8%AF?rss=1');

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
        $titles1=[];
        $bodies1=[];
        $dates1=[];
        foreach($titles as $key1=>$title){
          return $httpClient->load('https://www.shafaq.com/ar/%D8%B3%DB%8C%D8%A7%D8%B3%D8%A9/%D8%B1-%D9%8A%D8%B3-%D8%A7%D9%84%D8%AC%D9%85%D9%87%D9%88%D8%B1%D9%8A%D8%A9-%D9%8A%D8%AA%D9%88%D8%B9%D8%AF-%D8%A7%D9%84%D9%85%D8%AC%D8%A7%D9%85%D9%8A%D8%B9-%D8%A7%D9%84-%D8%B1%D9%87%D8%A7%D8%A8%D9%8A%D8%A9-%D9%84%D9%86-%D9%8A%D8%B8%D9%84-%D9%84%D9%83%D9%85-%D8%B4%D8%A8%D8%B1%D8%A7-%D9%81%D9%8A-%D8%A7%D9%84%D8%B9%D8%B1%D8%A7%D9%828');
            $titles1[]=$httpClient->load($links[$key1])->find('header.o-article__header h1.c-article-title',0)->plaintext;
            $bodies1[]=$httpClient->load($links[$key1])->find('div.o-article__body div.c-article-content',0)->plaintext;
            $dates1[]=$httpClient->load($links[$key1])->find('div.c-article-contributors time.c-article-date',0)->plaintext;

        }
        $country=" ";
        $name="shafq";
        $type="أقتصادية";
        return view('resources.resources',compact('titles','dates','links','country','name','type','descriptions'));

    }
    public function aawsat(){

        require '../vendor/autoload.php';
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://aawsat.com/home/international/section/economy');

// echo the title
#echo $response->find('title', 0)->plaintext . PHP_EOL . PHP_EOL;
$titles=[];
foreach ($response->find('div.media-type-3 div.media div.media-body a') as  $title) {
     $titles[] = $title->plaintext;
}
// get the dates into an array
$links =[];
foreach ($response->find('div.media-type-3 div.media div.media-body a') as  $link) {
    $links[] = "https://aawsat.com".$link->href;
}

$dates=[];

foreach ($response->find('article.article div#article_content div.node-info div#update_date') as  $date) {
    $dates[] = $date->plaintext;
}
$titles1=[];
$bodies1=[];
$dates1=[];
foreach($titles as $key1=>$title){
  //  return $httpClient->load($links[$key1]);
   $httpClient->load($links[$key1]);
   $titles1[]=$httpClient->load($links[$key1])->find('div#article_content  h2',0)->plaintext;
     $bodies1[]=$httpClient->load($links[$key1])->find('div#article_content div.node_new_body p',0)->plaintext;
      $dates1[]=$httpClient->load($links[$key1])->find('div#article_content div.node-info div#update_date',0)->plaintext;

}
$country="المملكة العربية السعودية";
$language="ar";
$name="الوسيط";
$type="أقتصادية";
foreach($titles1 as $key=>$title1){
    $data=array(

        'title'=>$titles1[$key],
        'body'=>$bodies1[$key],
        'date'=>$dates1[$key],
        'type'=>$type,
        'language'=>$language,
        'countery_sources'=>$country,
        'countery_news'=>$country,
        'sources'=>$name,
        'created_at'=>Carbon::now());
    News::insert($data);

    }
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
