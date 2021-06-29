<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator ;
use App\Post;
use App\Commentaires;
use App\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {

        $i=Auth::user();
        $posts=Post::all();
        $tab=[];

        foreach($posts as $p){
            $t=[];
            foreach($p->commentaires as $k){
                $username=DB::select('select username,photo from users where id = ?', [$k->user_id]);
            array_push($t,array(
                'text'=>$k->text,
                'commentaire_user'=>$username
            ));
            }
        array_push($tab,array("id" =>$p->id,
        'userPhoto'=> $p->users->photo,
        'user'=> $p->users->username,
        'titre'=>$p->titre,
        'text'=>$p->text,
        'photo'=>$p->photo,
        'video'=>$p->video,
        'categorie'=>$p->categorie,
        'langue'=>$p->langue,
        'region'=> $p->region,
        'commentaires'=> $t
            ));
        }
        $param=array("id" =>$i->id,
        'username'=>$i->username,
        'photo'=>$i->photo,
        'posts'=>$tab
        );

        return response()->json($param,200);
    }


    public function store(Request $request)
    {
        $post=Post::create($request->all());
        return response()->json($post, 200);
    }

    public function show($id)
    {
        return response()->json(Post::find($id), 201);
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        return response()->json($post, 200);

    }


    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(null,204);
    }


    public function addPhoto(Request $request,$id){
        $input=$request->all();
        $validate=Validator::make($input,[
            'photo'=>'required|image'
        ]);
        if($validate->fails()){
            return response()->json(400);
        }
        $photo=$request->photo;
        $newPhoto=time().$photo->getClientOriginalName();
        $photo->move('uploads/posts',$newPhoto);
        DB::update(
            'update posts set photo = ? where id = ? ',
            ["C:/xampp/htdocs/apitest/public/uploads/posts/$newPhoto" , $id]
        );
        $succes['photo']="C:/xampp/htdocs/apitest/public/uploads/posts/$newPhoto";
        return response()->json('success',200);
    }
}
