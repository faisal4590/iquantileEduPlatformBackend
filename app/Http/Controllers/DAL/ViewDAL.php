<?php

namespace App\Http\Controllers\DAL;

use App\Videos;
use App\Comments;
use App\UsersModel;

class ViewDAL
{
    public function get_all_videos()
    {
        // getting all videos with comments
        $video_lists = Videos::with('comments')
            ->orderBy('id', 'desc')
            ->get();

        if (count($video_lists->toArray()) > 0) {
            return $video_lists->toArray();
        } else {
            return NULL;
        }
    }

    public function get_single_video($video_id)
    {
        $video_info = Videos::with('comments')->find($video_id);

        if(count($video_info)>0){
            return $video_info->toArray();
        }else{
            return NULL;
        }
    }

    public function login($user_id,$password)
    {
        $user_info = UsersModel::where('username','=',$user_id)
            ->where('password','=',$password)   
            ->get();
        // dd($user_info);
        if(count($user_info)>0){
            return $user_info->toArray();
        }else{
            return NULL;
        }
    }

    public function get_video_comments($video_id)
    {
        // getting all comments under video
        $comment_lists = Comments::where('videos_id','=',$video_id)
            ->orderBy('id', 'asc')
            ->get();

        if (count($comment_lists->toArray()) > 0) {
            return $comment_lists->toArray();
        } else {
            return NULL;
        }
    }


}