<?php

namespace App\Http\Controllers\Backend\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use App\Models\Section;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Exception;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display all courses
     */
    public function index()
    {
        try {
            $courses = Course::with(['instructor:id,name', 'categories:id,name'])
                ->select('id', 'title', 'instructor_id', 'price', 'discount_price', 'level', 'status', 'featured', 'total_lessons', 'total_duration', 'created_at')
                ->when(Auth::user()->role === 'instructor', function ($query) {
                    return $query->where('instructor_id', Auth::id());
                })
                ->latest()
                ->paginate(15);

            return view('backend.course.index', compact('courses'));
        } catch (Exception $e) {
            return redirect()->route('dashboard')->with([
                'message' => 'Error loading courses: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Show create course form
     */
    public function create()
    {
        $categories = Cache::remember('categories_active', 3600, function () {
            return Category::where('is_active', 1)->select('id', 'name')->get();
        });

        $instructors = Cache::remember('instructors_list', 3600, function () {
            return User::where('role', 'instructor')
                ->where('status', 1)
                ->select('id', 'name')
                ->get();
        });

        return view('backend.course.create', compact('categories', 'instructors'));
    }

    /**
     * Store new course
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'required|string',
            'instructor_id' => 'required|exists:users,id',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'level' => 'required|in:beginner,intermediate,advanced,professional',
            'language' => 'required|string|max:50',
            'certificate_included' => 'required|boolean',
            'requirements' => 'nullable|string',
            'what_you_learn' => 'nullable|string',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'promo_video' => 'nullable|url',
        ]);

        try {
            DB::beginTransaction();

            $course = new Course();
            $course->title = $request->title;
            $course->slug = Str::slug($request->title);
            $course->short_description = $request->short_description;
            $course->description = $request->description;
            $course->instructor_id = $request->instructor_id;
            $course->price = $request->price;
            $course->discount_price = $request->discount_price;
            $course->level = $request->level;
            $course->language = $request->language;
            $course->certificate_included = $request->certificate_included;
            $course->promo_video = $request->promo_video;
            $course->status = 'draft';
            $course->featured = false;

            // Handle requirements and learning outcomes
            if ($request->requirements) {
                $course->requirements = json_encode(array_filter(explode("\n", $request->requirements)));
            }
            if ($request->what_you_learn) {
                $course->what_you_learn = json_encode(array_filter(explode("\n", $request->what_you_learn)));
            }

            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $filename = time() . '_' . Str::slug($request->title) . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move(public_path('upload/course_thumbnails'), $filename);
                $course->thumbnail = $filename;
            }

            $course->save();

            // Attach categories
            $course->categories()->attach($request->categories);

            DB::commit();

            return redirect()->route('courses.show', $course->id)->with([
                'message' => 'Course created successfully!',
                'alert-type' => 'success'
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with([
                'message' => 'Error creating course: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Show course details with curriculum
     */
    public function show($id)
    {
        try {
            $course = Course::with([
                'instructor:id,name,email',
                'categories:id,name',
                'sections' => function ($query) {
                    $query->orderBy('order')->with(['lessons' => function ($q) {
                        $q->orderBy('order');
                    }]);
                }
            ])->findOrFail($id);

            // Check authorization
            if (Auth::user()->role === 'instructor' && $course->instructor_id !== Auth::id()) {
                abort(403, 'Unauthorized access');
            }

            return view('backend.course.show', compact('course'));

        } catch (Exception $e) {
            return redirect()->route('courses.index')->with([
                'message' => 'Course not found',
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $course = Course::with('categories')->findOrFail($id);

        // Check authorization
        if (Auth::user()->role === 'instructor' && $course->instructor_id !== Auth::id()) {
            abort(403);
        }

        $categories = Cache::remember('categories_active', 3600, function () {
            return Category::where('is_active', 1)->select('id', 'name')->get();
        });

        $instructors = Cache::remember('instructors_list', 3600, function () {
            return User::where('role', 'instructor')
                ->where('status', 1)
                ->select('id', 'name')
                ->get();
        });

        return view('backend.course.edit', compact('course', 'categories', 'instructors'));
    }

    /**
     * Update course
     */
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        // Check authorization
        if (Auth::user()->role === 'instructor' && $course->instructor_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'required|string',
            'instructor_id' => 'required|exists:users,id',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'level' => 'required|in:beginner,intermediate,advanced,professional',
            'language' => 'required|string|max:50',
            'certificate_included' => 'required|boolean',
            'requirements' => 'nullable|string',
            'what_you_learn' => 'nullable|string',
            'categories' => 'required|array|min:1',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'promo_video' => 'nullable|url',
            'status' => 'required|in:draft,published,unpublished',
            'featured' => 'boolean',
        ]);

        try {
            DB::beginTransaction();

            $course->title = $request->title;
            $course->slug = Str::slug($request->title);
            $course->short_description = $request->short_description;
            $course->description = $request->description;
            $course->instructor_id = $request->instructor_id;
            $course->price = $request->price;
            $course->discount_price = $request->discount_price;
            $course->level = $request->level;
            $course->language = $request->language;
            $course->certificate_included = $request->certificate_included;
            $course->promo_video = $request->promo_video;
            $course->status = $request->status;
            $course->featured = $request->has('featured');

            if ($request->requirements) {
                $course->requirements = json_encode(array_filter(explode("\n", $request->requirements)));
            }
            if ($request->what_you_learn) {
                $course->what_you_learn = json_encode(array_filter(explode("\n", $request->what_you_learn)));
            }

            if ($request->hasFile('thumbnail')) {
                // Delete old thumbnail
                if ($course->thumbnail) {
                    @unlink(public_path('upload/course_thumbnails/' . $course->thumbnail));
                }
                $thumbnail = $request->file('thumbnail');
                $filename = time() . '_' . Str::slug($request->title) . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move(public_path('upload/course_thumbnails'), $filename);
                $course->thumbnail = $filename;
            }

            $course->save();
            $course->categories()->sync($request->categories);

            DB::commit();

            return redirect()->route('courses.show', $course->id)->with([
                'message' => 'Course updated successfully!',
                'alert-type' => 'success'
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with([
                'message' => 'Error updating course: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Delete course
     */
    public function destroy($id)
    {
        try {
            $course = Course::findOrFail($id);

            // Check authorization
            if (Auth::user()->role === 'instructor' && $course->instructor_id !== Auth::id()) {
                abort(403);
            }

            DB::beginTransaction();

            // Delete thumbnail
            if ($course->thumbnail) {
                @unlink(public_path('upload/course_thumbnails/' . $course->thumbnail));
            }

            $course->delete();

            DB::commit();

            return redirect()->route('courses.index')->with([
                'message' => 'Course deleted successfully!',
                'alert-type' => 'success'
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'message' => 'Error deleting course: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Update course statistics
     */
    public function updateStatistics($courseId)
    {
        $course = Course::findOrFail($courseId);

        $totalLessons = Lesson::whereHas('section', function ($query) use ($courseId) {
            $query->where('course_id', $courseId);
        })->count();

        $totalDuration = Lesson::whereHas('section', function ($query) use ($courseId) {
            $query->where('course_id', $courseId);
        })->sum('duration');

        $course->update([
            'total_lessons' => $totalLessons,
            'total_duration' => $totalDuration
        ]);

        return $course;
    }
}
