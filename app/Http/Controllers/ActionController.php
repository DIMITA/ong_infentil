<?php
namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category');
        $query = Action::active()->latest('date');
        if ($category) {
            $query->where('category', $category);
        }
        $actions = $query->paginate(12);
        $categories = ['sante' => 'Santé', 'education' => 'Éducation', 'nutrition' => 'Nutrition', 'protection' => 'Protection', 'urgence' => 'Urgence'];
        return view('pages.actions', compact('actions', 'categories', 'category'));
    }

    public function show(string $slug)
    {
        $action = Action::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('pages.action-show', compact('action'));
    }
}
