<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use Auth;
use App\Handlers\ImageUploadHandler;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
	}
	
	// called scopeWithOrder()
	public function index(Request $request)
    {
        $topics = Topic::withOrder($request->order)->paginate(20);
        return view('topics.index', compact('topics'));
	}
	

	// No use of local scope designed in Topic Model
	// public function index()
	// {

	// 	$topics = Topic::with('user','category')->paginate(30);
	// 	return view('topics.index', compact('topics'));
	// }

    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }

	public function create(Topic $topic)
	{
		$categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
	}

	public function store(TopicRequest $request, Topic $topic)
    {
        $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->save();

        return redirect()->route('topics.show', $topic->id)->with('message', 'Created successfully.');
    }

	public function edit(Topic $topic)
	{
        $categories = Category::all();
        $this->authorize('update', $topic);
		return view('topics.create_and_edit', compact('topic','categories'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->route('topics.show', $topic->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('message', 'Deleted successfully.');
    }
    
    

	public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // initalize default value
        $data = [
            'success'   => false,
            'msg'       => 'upload failed!',
            'file_path' => ''
        ];
        // see whether it has image to upload
        if ($file = $request->upload_file) {
            // save to local
            $result = $uploader->save($request->upload_file, 'topics', \Auth::id(), 1024);
            // if image saved successfully
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "Upload Successfully.";
                $data['success']   = true;
            }
        }
        return $data;
    }
}