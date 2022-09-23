<?php

namespace App\Http\Controllers;

use App\TwitterUsers;
use App\User;
use Illuminate\Http\Request;

class TwitterUsersController extends Controller
{
    //
    public function index(Request $request){
        $data = TwitterUsers::orderBy('id','DESC')->paginate(10);
        return view('admin.twitter.users.index',compact('data'));
}
public function show(Request $request,$id){
    $user = TwitterUsers::find($id);
    return view('admin.twitter.users.show',compact('user'));

}
public function create(Request $request){

}
public function store(Request $request){
   // return $request->name;

    $client = new \GuzzleHttp\Client();
     $url='http://127.0.0.1:5001/scrap_twitter/password/user/'.$request->name;
        $res = $client->request('GET',$url);
        $contents = $res->getBody()->getContents();
        $contents = json_decode($contents, true);


    $data=array(
        'name'=>$contents['name'],
        'bio'=> $contents['bio'],
        'private'=>$contents['private'],
        'location'=> $contents['location'],
        'user_url'=>$contents['user_url'],
        'join_date'=>$contents['join_date'],
        'verified'=>$contents['verified'],
        'number_of_followers'=>$contents['number_of_followers'],
        'number_of_followings'=>$contents['number_of_followings'],
        'user_liked'=>$contents['user_liked'],
        'number_of_media'=>$contents['number_of_media'],
        'number_of_tweets'=>$contents['number_of_tweets'],
        'profile_picture'=>$contents['profile_picture'],


    );
    TwitterUsers::insert($data);
    return redirect()->route('admin.twitter.users.index')
    ->with('success','تم أضافة بنجاح');




}

}

