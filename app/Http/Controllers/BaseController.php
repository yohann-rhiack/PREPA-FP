<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Cycle;
use App\Models\Subject;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Summary;
use App\Models\Type;
use App\Models\Test;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Plan;
use App\Models\User;
use App\Models\Attempt;
use App\Models\Subscription;
use Exception;

abstract class BaseController extends Controller
{
    protected $model;

    public function index()
    {
        try {
            return response()->json(['status' => 'success', 'data' => $this->model::all()], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $entity = new $this->model();
            foreach ($request->except('_token') as $key => $value) {
                $entity->$key = $value;
            }
            $entity->save();
            return response()->json(['status' => 'success', 'data' => $entity], 201);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $entity = $this->model::findOrFail($id);
            return response()->json(['status' => 'success', 'data' => $entity], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $entity = $this->model::findOrFail($id);
            foreach ($request->except('_token') as $key => $value) {
                $entity->$key = $value ?? $entity->$key;
            }
            $entity->save();
            return response()->json(['status' => 'success', 'data' => $entity], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $entity = $this->model::findOrFail($id);
            $entity->delete();
            return response()->json(['status' => 'success', 'message' => 'Entity deleted'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}

class SchoolController extends BaseController { 
    protected $model = School::class; 

    public function showDashboard($id)
    {
        try {
            $entity = $this->model::findOrFail($id);
            return view('frontend.ecole', compact('title', 'entity'));
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 404);
        }
    }

}
class CycleController extends BaseController { protected $model = Cycle::class; }
class SubjectController extends BaseController { protected $model = Subject::class; }
class CourseController extends BaseController { protected $model = Course::class; }
class ChapterController extends BaseController { protected $model = Chapter::class; }
class SummaryController extends BaseController { protected $model = Summary::class; }
class TypeController extends BaseController { protected $model = Type::class; }
class TestController extends BaseController { protected $model = Test::class; }
class QuizController extends BaseController { protected $model = Quiz::class; }
class AnswerController extends BaseController { protected $model = Answer::class; }
class PlanController extends BaseController { protected $model = Plan::class; }
class UserController extends BaseController { protected $model = User::class; }
class AttemptController extends BaseController { protected $model = Attempt::class; }
class SubscriptionController extends BaseController { protected $model = Subscription::class; }
