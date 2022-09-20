<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Http\Request;

class Q2 extends Controller
{
    /**
     * Tribe Q2.
     *
     * @return \Illuminate\View\View
     */
    public function q2(Request $request)
    {
        $postId = $request->input('postId');
        $rawId = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $body = $request->input('body');

        // Get all comments endpoints and get count by postId.
        $rawComments = Http::get('https://jsonplaceholder.typicode.com/comments');
        $comments = json_decode($rawComments);
        $listCommentPostId = [];

        // Put all id in array.
        foreach ($comments as $key => $val) {
            similar_text($name, $val->name, $per1);
            similar_text($email, $val->email, $per2);
            similar_text($body, $val->body, $per3);

            if ($postId == $val->postId) {
                array_push($listCommentPostId, $val);
            } elseif ($rawId == $val->id) {
                array_push($listCommentPostId, $val);
            } elseif ($per1 > 40) {
                array_push($listCommentPostId, $val);
            } elseif ($per2 > 40) {
                array_push($listCommentPostId, $val);
            } elseif ($per3 > 40) {
                array_push($listCommentPostId, $val);
            }
        }

        // Change list array to a json format
        $endResult = json_encode($listCommentPostId);
        return response($endResult, 200)->header('Content-Type', 'json');
    }
}
