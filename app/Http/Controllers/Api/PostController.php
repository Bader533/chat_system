<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostApiRequest;
use App\Http\Requests\PostRequest;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * get all posts.
     */
    public function index()
    {
        try {
            $posts = Post::with(['user:id,name'])->isActive()->select(['id', 'title_en', 'title_ar', 'description_en', 'description_ar', 'avatar', 'user_id'])
                ->withCount([
                    'likeUsers as total_likes' => function ($query) {
                        $query->where('likes.status', 1);
                    },
                    'commentUsers as total_comments' => function ($query) {
                        $query->where('comments.status', 1);
                    },
                ])
                ->paginate(10);
            $posts->getCollection()->transform(function ($post) {
                $post->created_at_human = Carbon::parse($post->created_at)->diffForHumans();
                return $post;
            });

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
                'massege' => 'Error' . $e,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
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
                'massege' => 'An error occurred' . $e,
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

            $post = Post::find($id);

            if (!$post) {
                return response()->json([
                    'message' => 'The post not exist',
                    'code' => Response::HTTP_OK,
                    'error' => false,
                    'data' => []
                ]);
            }

            $post->delete();

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
            $post = Post::find($id);
            if (!$post) {
                return response()->json([
                    'message' => 'The post not exist',
                    'status' => Response::HTTP_BAD_REQUEST,
                    'error' => false,
                    'data' => $post
                ], Response::HTTP_BAD_REQUEST);
            }
            $user = auth()->user();

            // التحقق من وجود الإعجاب
            $likeExists = $user->likePosts()->where('post_id', $post->id)->where('likes.status', 1)->exists();

            if ($likeExists) {
                // حذف الإعجاب
                $user->likePosts()->detach($post->id);

                return response()->json([
                    'message' => 'Like removed successfully',
                    'status' => Response::HTTP_OK,
                    'error' => false,
                    'data' => $post
                ]);
            }

            // إضافة الإعجاب
            $user->likePosts()->attach($post->id, ['status' => 1]);

            return response()->json([
                'message' => 'Liked successfully',
                'status' => Response::HTTP_OK,
                'error' => false,
                'data' => $post
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occurred' . $e,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ], 500);
        }
    }

    public function getPostlikes(Request $request)
    {
        try {
            $likesQuery = Like::with('user:id,name,avatar')->where('post_id', $request->postId);

            if ($request->count && !$request->perpage) {
                $likes = $likesQuery->take($request->count)->get();
            } elseif (!$request->count && $request->perpage) {
                $likes = $likesQuery->paginate($request->perpage);
            } else {
                $likes = $likesQuery->get();
            }

            if ($likes->isEmpty()) {
                return response()->json([
                    'message' => 'No Likes',
                    'status' => Response::HTTP_BAD_REQUEST,
                    'error' => false,
                    'data' => []
                ], Response::HTTP_BAD_REQUEST);
            }

            return response()->json([
                'message' => 'user Like',
                'status' => Response::HTTP_OK,
                'error' => false,
                'data' => $likes
            ]);
            //
        } catch (Exception $e) {

            return response()->json([
                'message' => 'An error occurred',
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

    /**
     * add new comment
     */
    public function comment(Request $request, $id)
    {
        try {
            $post = Post::find($id);
            $user = auth()->user();
            if (!$post) {
                return response()->json([
                    'message' => 'The post not exist',
                    'code' => Response::HTTP_OK,
                    'error' => false,
                    'data' => []
                ]);
            }

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

    /**
     * get post comments
     */
    public function getPostComment(Request $request)
    {
        try {

            $commentsQuery = Comment::with('user:id,name,avatar')
                ->where('post_id', $request->post_id)
                ->where('status', 1);

            if (!$commentsQuery) {
                return response()->json([
                    'message' => 'The post does not exist',
                    'status' => Response::HTTP_NOT_FOUND,
                    'error' => true,
                    'data' => []
                ]);
            }

            if ($request->count && !$request->perpage) {
                $comments = $commentsQuery->take($request->count)->get();
            } elseif (!$request->count && $request->perpage) {
                $comments = $commentsQuery->paginate($request->perpage);
            } else {
                $comments = $commentsQuery->get();
            }

            $comments->transform(function ($comment) {
                $comment->created_at_human = Carbon::parse($comment->created_at)->diffForHumans();
                return $comment;
            });

            return response()->json([
                'message' => 'Post comments retrieved successfully.',
                'status' => Response::HTTP_OK,
                'error' => false,
                'data' => $comments
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occurred: ' . $e->getMessage(),
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ], 500);
        }
    }

    /**
     * delete comment
     */
    public function deleteComment($commentId)
    {
        try {
            $comment = Comment::find('id', $commentId);

            if (!$comment) {
                return response()->json([
                    'massege' => 'The comment not exist',
                    'code' => Response::HTTP_BAD_REQUEST,
                    'error' => true,
                    'data' => []
                ], Response::HTTP_BAD_REQUEST);
            }

            return response()->json([
                'message' => 'the comment deleted',
                'code' => Response::HTTP_ACCEPTED,
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

    // public function updateDescription(PostApiRequest $request, $id)
    // {
    //     try {
    //         $post = Post::findOrFail($id);
    //         $validatedData = $request->validated();
    //         $validatedData['user_id'] = auth()->user()->id;
    //         $post->update($validatedData);
    //         $post->updateAvatar($request);

    //         return response()->json([
    //             'message' => __('site.update_successfully'),
    //             'code' => Response::HTTP_CREATED,
    //             'error' => false,
    //             'data' => $post
    //         ]);
    //     } catch (Exception $e) {
    //         return response()->json([
    //             'massege' => 'An error occurred',
    //             'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
    //             'error' => true,
    //             'data' => []
    //         ]);
    //     }
    // }
}
