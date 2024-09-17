<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::isActive()->get();

            return response()->json([
                'message' => 'posts data',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $posts
            ]);
        } catch (Exception $e) {
            return response()->json([
                'massege' => 'An error occurred',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ]);
        }
    }

    public function like($id)
    {
        try {
            $post = Post::findOrFail($id);
            $user = auth()->user();
            $user = User::find(1);

            $user->likePosts()->attach($post->id, ['status' => 1]);

            return response()->json([
                'massege' => 'liked',
                'status' => Response::HTTP_OK,
                'error' => false,
                'data' => $post
            ]);
        } catch (Exception $e) {
            return response()->json([
                'massege' => 'An error occurred' . $e,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ]);
        }
    }

    public function comment(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            $user = auth()->user();
            $user = User::find(1);

            $user->commentPosts()->attach($post->id, ['status' => 1, 'comment' => $request->input('comment')]);

            return response()->json([
                'massege' => 'commented',
                'status' => Response::HTTP_OK,
                'error' => false,
                'data' => $post
            ]);
        } catch (Exception $e) {
            return response()->json([
                'massege' => 'An error occurred' . $e,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ]);
        }
    }
}
