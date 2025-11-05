<?php

namespace App\Http\Controllers\Backend\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Support\Facades\DB;
use Exception;

class SectionController extends Controller
{
    /**
     * Store new section
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $lastSection = Section::where('course_id', $request->course_id)
                ->orderBy('order', 'desc')
                ->first();

            $section = Section::create([
                'course_id' => $request->course_id,
                'title' => $request->title,
                'description' => $request->description,
                'order' => $lastSection ? $lastSection->order + 1 : 1,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Section created successfully',
                'section' => $section
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error creating section: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update section
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        try {
            $section = Section::findOrFail($id);
            $section->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Section updated successfully',
                'section' => $section
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating section'
            ], 500);
        }
    }

    /**
     * Delete section
     */
    public function destroy($id)
    {
        try {
            $section = Section::findOrFail($id);
            $section->delete();

            return response()->json([
                'success' => true,
                'message' => 'Section deleted successfully'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting section'
            ], 500);
        }
    }

    /**
     * Reorder sections
     */
    public function reorder(Request $request)
    {
        try {
            DB::beginTransaction();

            foreach ($request->sections as $index => $sectionId) {
                Section::where('id', $sectionId)->update(['order' => $index + 1]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Sections reordered successfully'
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error reordering sections'
            ], 500);
        }
    }
}

