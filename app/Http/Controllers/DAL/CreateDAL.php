<?php

namespace App\Http\Controllers\DAL;

use App\Videos;
use App\UsersModel;
use App\Comments;

use DB;
use File;

class CreateDAL
{
    public function create_video($request)
    {
        $video_author = $request->video_author;
        
        // Inserting videos
        $video = Videos::firstOrCreate([
            'video_author' => $video_author
        ]);
        // dd($video->id);

        // video file upload code
        $uploadedFiles = $request->video_file;

        /// upload video
        $upload_path = "../../iquantile_backend/video_gallery/$video->id/";
        $file_name = $uploadedFiles->getClientOriginalName();
        $generated_new_name = $video->id . '.' .  $uploadedFiles->getClientOriginalExtension();
        $uploadedFiles->move($upload_path, $generated_new_name);

        // update video_path in video_table
        $videoInfo = Videos::find($video->id);
        $videoInfo->video_path = "http://localhost/iquantile_backend/video_gallery/$video->id/" 
            . $video->id . '.' .  $uploadedFiles->getClientOriginalExtension();
        $videoInfo->save();


        if (count($video->toArray()) > 0) {
            return $video->toArray();
        } else {
            return NULL;
        }
    }

    public function add_user($request)
    {
        $user_id = $request->user_id;
        $email = $request->email;
        $password = $request->password;
        $auth_token = uniqid();
        $access_level = $request->access_level;
        $age = $request->age;

        // dd($auth_token);

        // check if username and email is taken already
        $userInfo = UsersModel::where('username','=',$user_id)
            ->where('email','=',$email)
            ->get();
        if(count($userInfo)>0){
            return "username and email already taken!";
        }else{
             // Inserting user
            $user = UsersModel::firstOrCreate([
                'username' => $user_id,
                'email' => $email,
                'password' => $password,
                'auth_token' => $auth_token,
                'access_level' => $access_level,
                'age' => $age
            ]);

            
            if (count($user->toArray()) > 0) {
                return $user->toArray();
            } else {
                return NULL;
            }
        }
        
       
    }

    public function add_comment($request)
    {
        $video_id = $request->video_id;
        $user_id = $request->user_id;
        $email = $request->email;
        $age = $request->age;
        $comment =  $request->comment;
        $rating = $request->rating;
        
        // insert comment into db
        $new_comment = Comments::firstOrCreate([
            'videos_id' => $video_id,
            'name' => $user_id,
            'email' => $email,
            'age' => $age,
            'comment' => $comment,
            'rating' => $rating
        ]);

        // returning updated comment lists
        $updated_comment_lists = Comments::where('videos_id','=',$video_id)
            ->orderBy('id', 'asc')
            ->get();

        if (count($updated_comment_lists->toArray()) > 0) {
            return $updated_comment_lists->toArray();
        } else {
            return NULL;
        }
    }
}
