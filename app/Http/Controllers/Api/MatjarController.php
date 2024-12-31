<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MatjarCategory;
use App\Models\MatjarProduct;
use App\Models\MatjarTransaction;
use App\Models\UserProduct;
use App\Services\WalletService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MatjarController extends Controller
{
    public function getCategories()
    {
        try {
            $categories = MatjarCategory::isActive()
                ->paginate(8)
                ->through(fn($gift) => $gift->makeHidden(['created_at', 'updated_at', 'status', 'slug']));


            return response()->json([
                'message' => 'all categories data',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $categories
            ], Response::HTTP_ACCEPTED);
            //
        } catch (Exception $e) {
            return response()->json([
                'massege' => $e,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function showCategory($id)
    {
        try {
            $category = MatjarCategory::isActive()->find($id);

            return response()->json([
                'message' => 'show category data',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $category
            ], Response::HTTP_ACCEPTED);
            //
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => __('site.no_data_found')], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return response()->json([
                'massege' => $e,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getCategoryProducts($id)
    {
        try {

            $category = MatjarCategory::isActive()->findOrFail($id);

            $products = $category->products()
                ->select('id', 'name_en', 'name_ar', 'type_points', 'value_points', 'matjar_category_id')
                ->paginate(8)
                ->through(fn($product) => $product->makeHidden(['created_at', 'updated_at', 'status', 'slug']));

            return response()->json([
                'message' => 'get category products',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $products
            ], Response::HTTP_ACCEPTED);
            //
        } catch (ModelNotFoundException $e) {

            return response()->json([
                'message' => __('site.no_data_found'),
                'code' => Response::HTTP_NOT_FOUND,
                'error' => true,
                'data' => []
            ], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getProducts()
    {
        try {
            $products = MatjarProduct::isActive()
                ->paginate(8)
                ->through(fn($gift) => $gift->makeHidden(['created_at', 'updated_at', 'status', 'slug']));


            return response()->json([
                'message' => 'all products data',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $products
            ], Response::HTTP_ACCEPTED);
            //
        } catch (Exception $e) {
            return response()->json([
                'massege' => $e,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function showProduct($id)
    {
        try {
            $product = MatjarProduct::isActive()->find($id);

            return response()->json([
                'message' => 'product data',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $product
            ], Response::HTTP_ACCEPTED);
            //
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => __('site.no_data_found')], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return response()->json([
                'massege' => $e,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function userProducts()
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return response()->json([
                    'message' => 'user not authenticated',
                    'code' => Response::HTTP_UNAUTHORIZED,
                    'error' => true,
                    'data' => []
                ], Response::HTTP_UNAUTHORIZED);
            }

            $products = $user->matjarProducts()
                ->paginate(8);

            // إذا لم تكن هناك منتجات
            if ($products->isEmpty()) {
                return response()->json([
                    'message' => 'no products found',
                    'code' => Response::HTTP_OK,
                    'error' => false,
                    'data' => [],
                ], Response::HTTP_OK);
            }

            return response()->json([
                'message' => 'all products data',
                'code' => Response::HTTP_OK,
                'error' => false,
                'data' => $products,
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    public function BuyProduct(Request $request, WalletService $walletService)
    {
        $user = auth()->user();
        // $receiver = User::find($request->receiver_id);
        $product = MatjarProduct::find($request->product_id);
        $productType = $product->type_points; //diamonds


        if (!$user->wallet) {
            return response()->json([
                'message' => 'Wallet Not Found',
                'code' => Response::HTTP_BAD_REQUEST,
                'error' => true,
                'data' => []
            ], Response::HTTP_BAD_REQUEST);
        }

        $userBalance = $user->wallet->{$productType};

        if (!$product) {
            return response()->json([
                'message' => 'Invalid Product',
                'code' => Response::HTTP_BAD_REQUEST,
                'error' => true,
                'data' => []
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($userBalance < $product->value_points) {
            return response()->json([
                'message' => 'Not enough points',
                'code' => Response::HTTP_BAD_REQUEST,
                'error' => true,
                'data' => []
            ], Response::HTTP_BAD_REQUEST);
        }

        // send the Product
        UserProduct::create([
            'user_id' => $user->id,
            'matjar_product_id' => $product->id,
            'sent_at' => now()
        ]);

        // update data
        $user->wallet->update([$product->type_points => $userBalance - $product->value_points]);

        // store transactions
        MatjarTransaction::create([
            'user_id' => $user->id,
            'matjar_product_id' => $product->id,
            'points' => $product->value_points,
        ]);

        return response()->json([
            'message' => 'product bought successfully',
            'code' => Response::HTTP_OK,
            'error' => false,
            'data' => []
        ], Response::HTTP_OK);
    }
}
