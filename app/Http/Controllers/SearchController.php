<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    //Post search method in AJAX
    public function search(Request $request){
        if($request->ajax() && ($request->search !="")){
            $output = "";
            $posts = Post::where('title', 'LIKE', "%" . $request->search . "%")->orderBy('id')->get();
            if($posts){
                $output = "<dl>";
                $num = 0;
                foreach ($posts as $post){
                    $output .= "<dt class='border-top border-light'>" . ++$num . "\t<a href=" . route('post', $post->slug !='' ? $post->slug : $post->id) . ">$post->title by {$post->user['name']}</a></dt><dd>" . strip_tags(str_limit($post->content, 30)) . "</dd>";
                }
                $output .="</dl>";
                return Response($output);
            }
        }
    }

}
