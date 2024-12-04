<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
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
            $posts = Post::isActive()
                ->withCount([
                    'likeUsers as total_likes' => function ($query) {
                        $query->where('likes.status', 1);
                    },
                    'commentUsers as total_comments' => function ($query) {
                        $query->where('comments.status', 1);
                    },
                ])
                ->paginate(10);
            // $posts = Post::isActive()
            //     ->withCount(['likeUsers as likes_count', 'commentUsers as comments_count'])
            //     ->toSql();

            return response()->json([
                'message' => 'posts data',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $posts
            ]);
        } catch (Exception $e) {
            return response()->json([
                'massege' => $e,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['user_id'] = auth()->user()->id;
            $data = Post::create($validatedData);
            $data->updateAvatar($request);

            return response()->json([
                'message' => __('site.create_successfully'),
                'code' => Response::HTTP_CREATED,
                'error' => false,
                'data' => $data
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

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            $validatedData = $request->validated();
            $validatedData['user_id'] = auth()->user()->id;
            $post->update($validatedData);
            $post->updateAvatar($request);

            return response()->json([
                'message' => __('site.update_successfully'),
                'code' => Response::HTTP_CREATED,
                'error' => false,
                'data' => $post
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            $event = Post::findOrFail($id);
            $event->delete();

            return response()->json([
                'message' => __('site.delete_successfully'),
                'code' => Response::HTTP_OK,
                'error' => false,
                'data' => []
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

            $user->likePosts()->attach($post->id, ['status' => 1]);

            return response()->json([
                'massege' => 'liked',
                'status' => Response::HTTP_OK,
                'error' => false,
                'data' => $post
            ]);
        } catch (Exception $e) {
            return response()->json([
                'massege' => 'An error occurred',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ], 500);
        }
    }

    public function comment(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            $user = auth()->user();
            // $user = User::find(1);

            $user->commentPosts()->attach($post->id, ['status' => 1, 'comment' => $request->input('comment')]);

            return response()->json([
                'massege' => 'commented',
                'status' => Response::HTTP_OK,
                'error' => false,
                'data' => $post
            ]);
        } catch (Exception $e) {
            return response()->json([
                'massege' => 'An error occurred',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ], 500);
        }
    }

    public function myPost()
    {
        try {
            $data = auth()->user()->posts()->paginate(10);
            // dd(auth()->user());
            return response()->json([
                'message' => 'my posts data .',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $data
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

    public function getPostComment($id)
    {
        try {
            // جلب المنشور مع التعليقات المفلترة والتقسيم
            $post = Post::findOrFail($id);

            $comments = $post->commentUsers()
                ->where('comments.status', 1)
                ->select('users.id', 'users.name', 'users.email', 'comments.comment', 'comments.created_at', 'comments.status')
                ->orderBy('comments.created_at', 'desc')
                ->get();

            return response()->json([
                'message' => 'Post comments retrieved successfully.',
                'status' => Response::HTTP_OK,
                'error' => false,
                'data' => $comments
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred: ' . $e->getMessage(),
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ], 500);
        }
    }
}
