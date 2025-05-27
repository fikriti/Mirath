<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * عرض الصفحة الرئيسية مع الأقسام
     */
    public function index(): View
    {
        $mainSections = Section::with('children')->whereNull('section_id')->get();

        return view('welcome', compact('mainSections'));
    }
    //  public function show(Section $section): View
    //     {
    //         // تحميل كل الأقسام الفرعية
    //         $children = $section->children()->with('contents')->get();

    //         // اختار أول قسم فرعي عنده محتوى
    //         $activeChild = $children->first(function ($child) {
    //             return $child->contents->isNotEmpty();
    //         });

    //         // $mainSections = Section::with(['children.contents', 'contents'])
    //         //     ->whereNull('section_id')
    //         //     ->get()
    //         //     ->filter(function ($section) {
    //         //         // القسم نفسه فيه محتوى أو أحد أولاده فيه محتوى
    //         //         return $section->contents->isNotEmpty() ||
    //         //             $section->children->some(fn($child) => $child->contents->isNotEmpty());
    //         //     });
    //             $mainSections = Section::with('children')->whereNull('section_id')->get();


    //         return view('show', compact('section', 'children', 'activeChild','mainSections'));
    //     }

    // public function show(Section $section): View
    // {
    //     // الأقسام الفرعية (children) مع محتوياتهم
    //     $children = $section->children()->with('contents')->get();

    //     // أول قسم فيه محتوى أو أول واحد فقط كـ fallback
    //     $activeChild = $children->first(fn($child) => $child->contents->isNotEmpty()) ?? $children->first();

    //     $mainSections = Section::with('children')->whereNull('section_id')->get();

    //     return view('show', compact('section', 'children', 'activeChild', 'mainSections'));
    // }
    public function show(Section $section): View
    {
        $sec = $section;

        // الأقسام الرئيسية (اللي مالهاش قسم أب)
        $mainSections = Section::with('children')->whereNull('section_id')->get();

        // التأكد إذا القسم اللي دخلنا عليه عنده أقسام فرعية
        $children = $section->children()->with('contents')->get();

        // لو القسم ده عنده أبناء، يبقى قسم رئيسي
        if ($children->isNotEmpty()) {
            // نحدد أول قسم فرعي فيه محتوى أو نختار أول واحد كـ fallback
            $activeChild = $children->first(fn($child) => $child->contents->isNotEmpty()) ?? $children->first();
            $contents = $activeChild?->contents ?? collect();
        } else {
            // قسم فرعي
            $children = collect(); // empty collection
            $activeChild = null;
            $contents = $section->contents; // هات المحتوى اللي مرتبط بالقسم نفسه
        }

        return view('show', compact('section', 'children', 'activeChild', 'mainSections', 'sec', 'contents'));
    }
}
