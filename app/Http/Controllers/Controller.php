<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function counts($user) {
        $count_microposts = $user->microposts()->count();

        //フォロー・アンフォローのカウントを追加
        $count_followings = $user->followings()->count();
        $count_followers = $user->followers()->count();
        
        //お気に入りのカウントを追加
        $count_favorites = $user->favorites()->count();
        
        
        
        return [
            'count_microposts' => $count_microposts,
            
             //フォロー・アンフォローのカウントを追加
            'count_followings' => $count_followings,
            'count_followers' => $count_followers,
            
        //お気に入りのカウントを追加
            'count_favorites' => $count_favorites,
        ];
    }
    
    
     public function post_counts($post) {
         //お気に入られのカウントを追加
         $count_favored = $post->favored()->count();
         
         return [
             //お気に入られのカウントを追加
            'count_favored' => $count_favored,
         ];
     }
    
}
