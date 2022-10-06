<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\User;

class Q1 extends Controller
{
    /**
     * Tribe Q1.
     *
     * @return \Illuminate\View\View
     */
    public function q1()
    {
        // Get all comments endpoints and get count by postId.
        $rawComments = Http::get('https://jsonplaceholder.typicode.com/comments');
        $comments = json_decode($rawComments);
        $listCommentPostId = [];

        
        // Put all id in array.
        foreach ($comments as $key => $val) {
            dd($val);
            array_push($listCommentPostId, $val->postId);
        }


        dd(array_count_values($listCommentPostId));

        // Get all posts endpoint
        $rawPosts = Http::get('https://jsonplaceholder.typicode.com/posts');
        $posts = json_decode($rawPosts);
        $listPosts = [];

        foreach ($posts as $key => $val) {
            $totalComments = 0;
            // Get total comment base on post id
            foreach (array_count_values($listCommentPostId) as $key2 => $val2) {
                if ($val->id == $key2) {
                    $totalComments = $val2;
                }
            }

            // Serialize endpoint.
            $temp = array("post_id" => $val->id, "post_title" => $val->title, "post_body" => $val->body, "total_number_of_comments" => $totalComments);

            array_push($listPosts, $temp);
        }

        // Sorting list of post base on total comment.
        usort($listPosts, function($x, $y) {
            if ($x['total_number_of_comments'] == $y['total_number_of_comments']) return 0;
            return ($x['total_number_of_comments'] < $y['total_number_of_comments']) ? 1 : -1;
        });

        // Change list array to a json format
        $endResult = json_encode($listPosts);

        //// Uncomment this to return Web view;
        // return view('q1', [
        //     'test' => json_decode($endResult),
        //     'countPostId' => array_count_values($listCommentPostId)
        // ]);

        return response($endResult, 200)
                  ->header('Content-Type', 'json');
    }
}
