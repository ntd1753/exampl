<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    protected function saveImageIntoPost($imgPath, $post): void
    {
                $image = new Image();
                $image["model_type"] = 'post';
                $image["model_id"] = $post->id;
                $image["path"] = $imgPath;
                $image["name"] = $imgPath;
                $image["alt"] = $imgPath;
                $image->save();
    }
    protected function fillDataToPost($item, $input, $is_create) : void
    {
        $item["name"] = $input["name"] ?? "";
        $item["slug"] = $input["slug"] ?? Str::slug($item["name"]);
        $item["description"] = $input["description"] ?? "";
        $item["content"] = $input["content"] ?? "";
        $item["seo_title"] = $input["seo_title"] ?? "";
        $item["seo_keywords"] = $input["seo_keywords"] ?? "";
        $item["seo_description"] = $input["seo_description"] ?? "";
        $item["category_id"] = $input["category_id"] ?? null;
        if ($is_create)
        {
            $item["views"] = 0;
            $item["rating_number"] = 0;
            $item["rating_value"] = 0;
        }
        $item->save();
    }
    public function index(): Factory|View|Application
    {
        return view('post.index');
    }

    public function add(): Factory|View|Application
    {
        return view("post.add");
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_keywords' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
            'images' => 'required'
        ]);

        // Kiểm tra lỗi validate
        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validate->errors()
            ], 422);
        }
        $item = new Post();
        $input = $request->all();
        $this->fillDataToPost($item, $input, true);
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            // Đặt tên cho file ảnh dựa trên một tiêu chí nhất định, ví dụ: timestamp và original filename
            $filename = time() . '_' . $image->getClientOriginalName();
            // Lưu ảnh với tên file mới vào thư mục storage/app/public/images
            $path = $image->storeAs('public/images', $filename);
            // Chuyển đổi đường dẫn lưu trữ cho phù hợp khi trả về client
            $publicPath = 'storage/images/' . $filename;
            $this->saveImageIntoPost($publicPath, $item);
        }

        return response()->json([
            'success' => true,
            'message' => 'success',
        ], 200);
    }

}
