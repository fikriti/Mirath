<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SectionRequest;
use App\Models\Section;
use App\Services\SectionService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SectionController extends Controller
{
    use AuthorizesRequests;

    protected $sectionService;

    public function __construct(SectionService $sectionService)
    {
        $this->sectionService = $sectionService;
    }

    public function index(Request $request)
    {
        $searchSection = $request->query('search');
        $perPage = $request->query('perPage', 10);

        $sections = $this->sectionService->indexSection($searchSection, $perPage);

        return view('sections.index', compact('sections'));
    }

    public function create()
    {
        $sections = Section::all();
        // dd("ppop");
        return view('sections.create', compact('sections'));
    }

    public function store(SectionRequest $request)
    {
        // $this->authorize('create', \App\Models\Section::class);

        $result = $this->sectionService->storeSection($request->validated());

        return isset($result['message'])
            ? redirect()->route('sections.index')->with('success', $result['message'])
            : redirect()->back()->with('error', 'حدث خطأ أثناء إنشاء القسم.');
    }

    public function edit($id)
    {
        $section = $this->sectionService->editSection($id);

        // if (!$section) {
        //     return redirect()->route('sections.index')->with('error', 'القسم غير موجود.');
        // }
        $sections = Section::all();

        return view('sections.edit', compact('section', 'sections'));
    }

    public function update(SectionRequest $request, $id)
    {
        // $this->authorize('update', \App\Models\Section::class);

        $result = $this->sectionService->updateSection($request->validated(), $id);

        return isset($result['message'])
            ? redirect()->route('sections.index')->with('success', $result['message'])
            : redirect()->back()->with('error', 'حدث خطأ أثناء تحديث القسم.');
    }

    public function destroy($id)
    {
        // $this->authorize('delete', \App\Models\Section::class);

        $result = $this->sectionService->destroySection($id);

        return isset($result['message'])
            ? redirect()->route('sections.index')->with('success', $result['message'])
            : redirect()->back()->with('error', 'حدث خطأ أثناء حذف القسم.');
    }
}
