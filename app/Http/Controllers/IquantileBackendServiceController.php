<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DAL\CreateDAL;
use App\Http\Controllers\DAL\ViewDAL;
use App\Http\Controllers\DAO\DaoFactory;
use Illuminate\Http\Request;

class IquantileBackendServiceController extends Controller
{
    public function add_user(Request $request)
    {
        $auth_token = $request->auth_token;

        $create_dal = new CreateDAL;
        $response_data = $create_dal->add_user($request);

        //dd($request->author);

        if ($response_data!= 'username and email already taken!') {

            $response_message = "User added!";

            $dao = new DaoFactory;

            $payload = array();
            $payload["auth_token"] = $auth_token;
            $payload["response"] = $response_message;
            $payload["new_created_user"] = $response_data;
            $response = $dao->make_response(200, $payload);
            return $response;
        } else {
            $response_message = $response_data;

            $dao = new DaoFactory;

            $payload = array();
            $payload["auth_token"] = $auth_token;
            $payload["response"] = $response_message;
            $response = $dao->make_response(400, $payload);
            return $response;
        }
    }

    public function login(Request $request)
    {
        $user_id = $request->user_id;
        $password = $request->password;

        $view_dal = new ViewDAL;
        $response_data = $view_dal->login($user_id,$password);

        //dd($request->author);

        if (count($response_data)>0) {

            $response_message = "User fetched!";

            $dao = new DaoFactory;

            $payload = array();

            $payload["response"] = $response_message;
            $payload["new_created_user"] = $response_data;
            $response = $dao->make_response(200, $payload);
            return $response;
        } else {
            $response_message = 'Incorrect credential.';

            $dao = new DaoFactory;

            $payload = array();

            $payload["response"] = $response_message;
            $response = $dao->make_response(400, $payload);
            return $response;
        }
    }

    public function insert_videos(Request $request)
    {
        $auth_token = $request->auth_token;

        $create_dal = new CreateDAL;
        $response_video_array = $create_dal->create_video($request);

        //dd($request->author);

        if (count($response_video_array) > 0) {

            $response_message = "Data inserted successfully!";

            $dao = new DaoFactory;

            $payload = array();
            $payload["auth_token"] = $auth_token;
            $payload["response"] = $response_message;
            $payload["new_created_video"] = $response_video_array;
            $response = $dao->make_response(200, $payload);
            return $response;
        } else {
            $response_message = "Data insertion failed!";

            $dao = new DaoFactory;

            $payload = array();
            $payload["auth_token"] = $auth_token;
            $payload["response"] = $response_message;
            $response = $dao->make_response(400, $payload);
            return $response;
        }
    }

    public function video_lists(Request $request)
    {
        $auth_token = $request->auth_token;

        $view_dal = new ViewDAL;
        $video_lists = $view_dal->get_all_videos();

        if (count($video_lists) > 0) {
            $response_message = "Video lists fetched successfully!";

            $dao = new DaoFactory;

            $payload = array();
            $payload["auth_token"] = $auth_token;
            $payload["response"] = $response_message;
            $payload["video_lists"] = $video_lists;
            $response = $dao->make_response(200, $payload);
            return $response;
        } else {
            $response_message = "Video lists fetching failed!";

            $dao = new DaoFactory;

            $payload = array();
            $payload["auth_token"] = $auth_token;
            $payload["response"] = $response_message;
            $response = $dao->make_response(400, $payload);
            return $response;
        }
    }

    public function get_single_video(Request $request)
    {
        $auth_token = $request->auth_token;

        $view_dal = new ViewDAL;
        $single_video_info = $view_dal->get_single_video($request->video_id);

        if (count($single_video_info) > 0) {
            $response_message = "Video fetched successfully!";

            $dao = new DaoFactory;

            $payload = array();
            $payload["auth_token"] = $auth_token;
            $payload["response"] = $response_message;
            $payload["single_video_info"] = $single_video_info;
            $response = $dao->make_response(200, $payload);
            return $response;
        } else {
            $response_message = "Video fetching failed!";

            $dao = new DaoFactory;

            $payload = array();
            $payload["auth_token"] = $auth_token;
            $payload["response"] = $response_message;
            $response = $dao->make_response(400, $payload);
            return $response;
        }
    }

    public function add_comment(Request $request)
    {
        
        $create_dal = new CreateDAL;
        $response_data = $create_dal->add_comment($request);

        //dd($request->author);

        if (count($response_data)>0) {

            $response_message = "Comment added!";

            $dao = new DaoFactory;

            $payload = array();
            $payload["response"] = $response_message;
            $payload["updated_comment_lists"] = $response_data;
            $response = $dao->make_response(200, $payload);
            return $response;
        } else {
            $response_message = "Comment add failed!";

            $dao = new DaoFactory;

            $payload = array();
            $payload["response"] = $response_message;
            $response = $dao->make_response(400, $payload);
            return $response;
        }
    }

    public function get_video_comment(Request $request)
    {
        $view_dal = new ViewDAL;
        $comment_lists = $view_dal->get_video_comments($request->video_id);

        if (count($comment_lists) > 0) {
            $response_message = "comment lists fetched successfully!";

            $dao = new DaoFactory;

            $payload = array();
            $payload["response"] = $response_message;
            $payload["comment_lists"] = $comment_lists;
            $response = $dao->make_response(200, $payload);
            return $response;
        } else {
            $response_message = "comment lists fetching failed!";

            $dao = new DaoFactory;

            $payload = array();
            $payload["response"] = $response_message;
            $response = $dao->make_response(400, $payload);
            return $response;
        }
    }

}
