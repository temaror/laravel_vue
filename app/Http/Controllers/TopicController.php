<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicFormRequest;
use App\Models\Topic;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class TopicController extends Controller
{
    public function index(Request $request)
    {

        $topics = Topic::when($request->search, function ($query, $search){
            $query->where('name','LIKE', '%'.$search.'%');
        })
            ->paginate(3)
            ->withQueryString();
        return Inertia::render('Topics/index', [

            'topics' => $topics
        ]);
    }

    public function create()
    {
        return Inertia::render('Topics/Create');
    }

    public function store(TopicFormRequest $request)
    {
        if ($request->input('name') === null){
            $name = $request->file('file')->getClientOriginalName();
        } else {
            $name = $request->input('name');
        }
        $file = $request->file('file')->store('topics', 'public');
        $ext = $request->file('file')->getClientOriginalExtension();
        $size = $request->file('file')->getSize();
        $imageArr = ['image/gif','image/jpeg','image/pjpeg','image/png','image/tiff'];
        $typeMime = $request->file('file')->getClientMimeType();
        if (in_array($typeMime, $imageArr)){
            $image = 1;
        } else {
            $image = 0;
        }
        Topic::create([
            'name' => $name,
            'file' => $file,
            'ext' => $ext,
            'size' => $size,
            'image' => $image
        ]);

        return Redirect::route('topics.index');
    }
    public function edit(Topic $topic)
    {
        return Inertia::render('Topics/Edit', [
            'topic' => $topic,
            'file' => asset('storage/'.$topic->file)
        ]);
    }
    public function update(TopicFormRequest $request, Topic $topic)
    {
        $file = $topic->file;
        if ($request->file('file')) {
            Storage::delete('public/'. $topic->file);
            $file = $request->file('file')->store('topics', 'public');
        }
        $file = $request->file('file')->store('topics', 'public');
        $ext = $request->file('file')->getClientOriginalExtension();
        $size = $request->file('file')->getSize();
        $imageArr = ['image/gif','image/jpeg','image/pjpeg','image/png','image/tiff'];
        $typeMime = $request->file('file')->getClientMimeType();
        if (in_array($typeMime, $imageArr)){
            $image = 1;
        } else {
            $image = 0;
        }
        $topic->update([
            'name' => $request->input('name'),
            'file' => $file,
            'ext' => $ext,
            'size' => $size,
            'image' => $image
        ]);
        return Redirect::route('topics.index');
    }
    public function destroy(Topic $topic)
    {
        Storage::delete('public/'. $topic->file);
        $topic->delete();
        return Redirect::route('topics.index');
    }

    public function download(Topic $topic)
    {
        return Storage::disk('public')->download($topic->file, $topic->name.'.'.$topic->ext);

    }

}
