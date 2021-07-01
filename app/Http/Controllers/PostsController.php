<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\skelbimas;
use App\models\komentaras;
use App\models\juodasis_sarasas;
use App\Models\kategorija;
use App\Models\User;
use App\Models\bookmarks;
use App\Models\ImageUpload;
use App\Models\queries;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Response;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
class PostsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = skelbimas::paginate(4);
        $visosKategorijos = kategorija::all();
        $data=ImageUpload::all();
        $count = $posts->count();
        return view('ruddit.posts',compact('posts','count','visosKategorijos'))->with('data',$data);
    }
    public function myposts(){
        $posts = skelbimas::where('fk_Naudotojasid',Auth::id())->paginate(4);
        $visosKategorijos = kategorija::all();
        $data=ImageUpload::all();
        $count = $posts->count();
        return view('ruddit.myposts',compact('posts','count','visosKategorijos'))->with('data',$data);
    }
    public function bookmarks(){

        $bposts=new skelbimas();
        $posts = skelbimas::all();
        $books=bookmarks::all()->where('name',Auth::id());
        $i=0;
        foreach($posts as $post){
            foreach($books as $book){
                if(($post->skelbimoNr==$book->postid)&&(Auth::id()==$book->name)){
                    $bposts[$i]=$post;
                    $i++;
                }
            }
        }
       // $bposts->paginate(4);
       // $posts=$bposts;
        $visosKategorijos = kategorija::all();
        $data=ImageUpload::all();
        $count = $posts->count();

        $posts=collect($bposts);

        return view('ruddit.bookposts',compact('posts','count','visosKategorijos'))->with('data',$data);
    }
    public function bookmark($id){
        $book=new bookmarks();
        $userr=User::find(Auth::id());
        $book->name=$userr->id;
        $book->postid=$id;
        $book->save();
        return back();
    }
    public function cheap(){
        $posts=skelbimas::where('brand','LIKE','%' . 'Apple' . '%')->where('price','<=',400)->paginate(4);
        $visosKategorijos = kategorija::all();
        $data=ImageUpload::all();
        $count = $posts->count();
        return view('ruddit.posts',compact('posts','count','visosKategorijos'))->with('data',$data);
    }
    public function gaming(){
        $posts=skelbimas::where('ramsize','>',4)->where('price','>=',400)->paginate(4);
        $visosKategorijos = kategorija::all();
        $data=ImageUpload::all();
        $count = $posts->count();
        $tasks = skelbimas::all();
        return view('ruddit.posts',compact('posts','count','visosKategorijos'))->with('data',$data);
    }
    public function filter(Request $request)
    {
       $posts = skelbimas::where('brand', 'LIKE', '%' . request()->brand . '%')
       ->when(request()->model, function($query) {
           $query->where('model', 'LIKE', '%' . request()->model . '%');})
       ->when(request()->screensize, function($query) {
           $query->where('screensize', 'LIKE', '%' . request()->screensize . '%');
       })
       ->when(request()->ramsize, function($query) {
           $query->where('ramsize', 'LIKE', '%' . request()->ramsize . '%');
       })
       ->when(request()->minprice, function($query) {
        $query->where('price', '>=',  request()->minprice );
        })
        ->when(request()->maxprice, function($query) {
            $query->where('price', '<=',  request()->maxprice );
        })->paginate(4);
        $visosKategorijos = kategorija::all();
        $count = $posts->count();
        $data=ImageUpload::all();
        $wa=0;
        if($request->my_checkbox){
            $bookai=queries::where('userid',Auth::id())->where('bookname',$request->bookname)->get();
            $counts = $bookai->count();
            if($counts==0){
            $bookn=new queries();
            $bookn->bookname= $request->bookname;
            $bookn->userid= Auth::id();
            $bookn->brand= $request->brand;
            $bookn->model= $request->model;
            $bookn->screensize= $request->screensize;
            $bookn->ramsize= $request->ramsize;
            $bookn->storagesize= $request->storagesize;
            $bookn->color= $request->color;
            $bookn->price= $request->price;
            $bookn->save();
            }
        }
        if($request->vl== 1){
        return view('ruddit.posts',compact('posts','count','visosKategorijos'))->with('data',$data);
        }
        elseif($request->vl==2){
            return response()->xml($posts);
        }
        elseif($request->vl==3){
            dd(Response::json($posts));
        }
    }
    public function bookfilter($id){
        $book=queries::find($id);
        $visosKategorijos = kategorija::all();
        $count = $book->count();
        $data=ImageUpload::all();
        $posts = skelbimas::where('brand', 'LIKE', '%' . $book->brand . '%')
       ->where('model', 'LIKE', '%' . $book->model . '%')->paginate(4);
       return view('ruddit.posts',compact('posts','count','visosKategorijos'))->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $visosKategorijos = kategorija::all();
        return view('ruddit.createPost',compact('visosKategorijos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            [
                'pavadinimas' =>$request->input('pavadinimas'),
                'brand' =>$request->input('brand'),
                'model' =>$request->input('model'),
                'screensize' =>$request->input('screensize'),
                'ramsize' =>$request->input('ramsize'),
                'storagesize' =>$request->input('storagesize'),
                'color' =>$request->input('color'),
                'price' =>$request->input('price')
            ],
            [
                'pavadinimas' =>'required|min:3|max:30|unique:post',
            ]
        );

        if ($validator->fails()) return Redirect::back()->withErrors($validator);
        else{
            $news = new skelbimas();
            $news->pavadinimas = $request->input('pavadinimas');
            $news->brand = $request->input('brand');
            $news->model = $request->input('model');
            $news->screensize = $request->input('screensize');
            $news->ramsize = $request->input('ramsize');
            $news->storagesize = $request->input('storagesize');
            $news->color = $request->input('color');
            $news->price = $request->input('price');
            $news->fk_KategorijakategorijosNr = $request->input('kategorija');
            $news->fk_Naudotojasid = Auth::id();   
        }
        $this->validate($request, ['business_imgs' => 'required', 'business_imgs.*' => 'required|image|max:1999']);
 
        if($request->hasfile('business_imgs'))
             {
                foreach($request->file('business_imgs') as $file)
                {
                     $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                     $path = public_path() . '/uploads/Img/MultipleImg/';
                     $file->move($path, $name);
                     $Imgdata[] = $name;
                }
             }
 
             else
             {
                 $banner_data = 'noimg';
             }
        $Data = new ImageUpload();
        $Data->business_name = $request->input('pavadinimas');
        $Data->business_imgs = json_encode($Imgdata);
        $Data->save();
        $news->save();
        return Redirect('/posts')->with('success','Listing has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post= skelbimas::find($id);
        $users=User::all();
        $data= ImageUpload::all()->where('business_name',$post->pavadinimas);


        return view('ruddit.content')->with('post',$post)
        ->with('users',$users)->with('kategorija',$post->kategorija)->with('autorius',$post->autorius)->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $skelbimas = skelbimas::find($id);
        $visosKategorijos = kategorija::all();
        $data=ImageUpload::all()->where('business_name', $skelbimas->pavadinimas);
        return view('ruddit.editPosts',compact('skelbimas','visosKategorijos'))->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
       
            $news = skelbimas::find($id);

         //   $news->pavadinimas = $request->input('pavadinimas');
            $news->brand = $request->input('brand');
            $news->model = $request->input('model');
            $news->screensize = $request->input('screensize');
            $news->ramsize = $request->input('ramsize');
            $news->storagesize = $request->input('storagesize');
            $news->color = $request->input('color');
            $news->price = $request->input('price');

            //$news->nuotrauka = $fileNameToStore;
            $news->fk_KategorijakategorijosNr = $request->input('kategorija');
            $news->fk_Naudotojasid = Auth::id();
        
        $this->validate($request, [ 'business_imgs.*' => 'required|image|max:1999']);

        if($request->hasfile('business_imgs'))
        {
           foreach($request->file('business_imgs') as $file)
           {
                $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                $path = public_path() . '/uploads/Img/MultipleImg/';
                $file->move($path, $name);
                $Imgdata[] = $name;
           }
        }

        else
        {
            $banner_data = 'noimg';
        }
   $Data = new ImageUpload();
   if($request->hasfile('business_imgs')){
    $Data->business_name = $news->pavadinimas;
   $Data->business_imgs = json_encode($Imgdata);
   $Data->save();
   }
        $news->save();
        return Redirect('/posts')->with('success','Listng has been updated!');

    }

    public function destroyImage($id,$pht){
        $data=ImageUpload::all();
        $i=0;
        $Imgdata=array();
        foreach($data as $key){
            foreach(json_decode($key->business_imgs, true) as $keys => $media_gallery){
                if($id==$key->id){
                    if($pht!=$media_gallery){
                    $Imgdata[$i]=$media_gallery;
                    $i++;
                    }
                }else{
                    break;
                }
            }
        }
        $datas=ImageUpload::find($id);
       $datas->business_imgs=$Imgdata;
       $datas->update();
        return back()->with('success','Selected photo has been removed!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = skelbimas::find($id);
        $books=bookmarks::all()->where('postid',$id);
        if($books->count()>0){
            foreach($books as $key){
                $key->delete();
            }
        }
        $post->delete();
        return Redirect('/posts')->with('success','Listing has been removed!');
    }

}
