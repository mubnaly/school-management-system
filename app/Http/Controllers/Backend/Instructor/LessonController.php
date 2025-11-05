<?php

namespace App\Http\Controllers\Backend\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Section;
use App\Models\Lesson;
use Illuminate\Support\Facades\DB;
use Exception;


class LessonController extends Controller
{
    /**
     * Store new lesson
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'section_id' => 'required|exists:sections,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'required|url',
            'duration' => 'required|integer|min:0',
            'is_preview' => 'boolean',
            'resources' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $lastLesson = Lesson::where('section_id', $request->section_id)
                ->orderBy('order', 'desc')
                ->first();

            $lesson = Lesson::create([
                'section_id' => $request->section_id,
                'title' => $request->title,
                'description' => $request->description,
                'video_url' => $request->video_url,
                'duration' => $request->duration,
                'is_preview' => $request->is_preview ?? false,
                'resources' => $request->resources,
                'order' => $lastLesson ? $lastLesson->order + 1 : 1,
            ]);

            // Update course statistics
            $section = Section::find($request->section_id);
            app('App\Http\Controllers\Backend\Course\CourseController')
                ->updateStatistics($section->course_id);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Lesson created successfully',
                'lesson' => $lesson
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error creating lesson: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update lesson
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'required|url',
            'duration' => 'required|integer|min:0',
            'is_preview' => 'boolean',
            'resources' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $lesson = Lesson::findOrFail($id);
            $lesson->update($validated);

            // Update course statistics
            $section = Section::find($lesson->section_id);
            app('App\Http\Controllers\Backend\Course\CourseController')
                ->updateStatistics($section->course_id);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Lesson updated successfully',
                'lesson' => $lesson
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error updating lesson'
            ], 500);
        }
    }

    /**
     * Delete lesson
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $lesson = Lesson::findOrFail($id);
            $sectionId = $lesson->section_id;
            $lesson->delete();

            // Update course statistics
            $section = Section::find($sectionId);
            app('App\Http\Controllers\Backend\Course\CourseController')
                ->updateStatistics($section->course_id);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Lesson deleted successfully'
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error deleting lesson'
            ], 500);
        }
    }

    /**
     * Reorder lessons
     */
    public function reorder(Request $request)
    {
        try {
            DB::beginTransaction();

            foreach ($request->lessons as $index => $lessonId) {
                Lesson::where('id', $lessonId)->update(['order' => $index + 1]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Lessons reordered successfully'
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error reordering lessons'
            ], 500);
        }
    }
}
