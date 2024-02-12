<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Community;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class CommunityPostController extends Controller
{
    public function create(Community $community)
    {
        return Inertia::render('Communities/Posts/Create', compact('community')); //
    }

    public function store(StorePostRequest $request, Community $community)
    {
        $post = $community->posts()->create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            // Не устанавливаем изображение сразу, так как его нужно сначала загрузить и оптимизировать
        ]);

        if ($request->hasFile('image')) {
            $filename = $post->id . '.jpg'; 
            $imagePath = $request->file('image')->storeAs('posts', $filename, 'public');
    
            $path = storage_path('app/public/' . $imagePath);
            if (filesize($path) > 10) { 
                ImageOptimizer::optimize($path);
            }
    
            $post->update(['image' => $imagePath]);
        }

        return Redirect::route('frontend.communities.show', $community->slug);
    }

    public function edit(Community $community, Post $post)
    {
        $this->authorize('update', $post);
        return Inertia::render('Communities/Posts/Edit', compact('community', 'post')); //
    }

    public function update(StorePostRequest $request, Community $community, Post $post)
    {
        $this->authorize('update', $post);
    
        $data = $request->validated();
        unset($data['image']); // Удаляем изображение из массива данных, чтобы не обновлять его напрямую
    
        // Проверяем, было ли запрошено удаление изображения
        if ($request->filled('delete_image') && $request->input('delete_image') == true) {
            if ($post->image) {
                Storage::delete('public/' . $post->image);
                $data['image'] = null; // Обнуляем путь к изображению в базе данных
            }

        } elseif ($request->hasFile('image')) {
            // Удаляем старое изображение, если оно есть
            if ($post->image) {
                Storage::delete('public/' . $post->image);
            }
    
            // Загружаем и сохраняем новое изображение
            $filename = $post->id . '.jpg';
            $imagePath = $request->file('image')->storeAs('posts', $filename, 'public');
    
            $path = storage_path('app/public/' . $imagePath);
            if (filesize($path) > 10) {
                ImageOptimizer::optimize($path);
            }
    
            $data['image'] = $imagePath;
        }
    
        $post->update($data);
    
        return Redirect::route('frontend.communities.posts.show', [$community->slug, $post->slug]);
    }
    
    

    public function destroy(Community $community, Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return Redirect::route('frontend.communities.show', $community->slug);
    }
}
