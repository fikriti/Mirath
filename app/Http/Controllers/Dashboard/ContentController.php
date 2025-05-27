<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ContentRequest;
use App\Models\Section;
use App\Services\ContentService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ContentController extends Controller
{
    use AuthorizesRequests;

    protected $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $perPage = $request->query('perPage', 10);

        $contents = $this->contentService->indexContent($search, $perPage);

        return view('contents.index', compact('contents'));
    }

    public function create()
    {
        $sections = Section::all();


        return view('contents.create', compact('sections'));
    }

    public function store(ContentRequest $request)
    {
        // $this->authorize('create', \App\Models\Content::class);

        $result = $this->contentService->storeContent($request->validated());

        return isset($result['message'])
            ? redirect()->route('contents.index')->with('success', $result['message'])
            : redirect()->back()->with('error', 'حدث خطأ أثناء إنشاء المحتوى.');
    }

    public function edit($id)
    {
        $content = $this->contentService->editContent($id);

        // if (!$content) {
        //     return redirect()->route('contents.index')->with('error', 'المحتوى غير موجود.');
        // }
        $sections = Section::all();
        return view('contents.edit', compact('content', 'sections'));
    }

    public function update(ContentRequest $request, $id)
    {
        // $this->authorize('update', \App\Models\Content::class);

        $result = $this->contentService->updateContent($request->validated(), $id);

        return isset($result['message'])
            ? redirect()->route('contents.index')->with('success', $result['message'])
            : redirect()->back()->with('error', 'حدث خطأ أثناء تحديث المحتوى.');
    }

    public function destroy($id)
    {
        // $this->authorize('delete', \App\Models\Content::class);

        $result = $this->contentService->destroyContent($id);

        return isset($result['message'])
            ? redirect()->route('contents.index')->with('success', $result['message'])
            : redirect()->back()->with('error', 'حدث خطأ أثناء حذف المحتوى.');
    }
}
