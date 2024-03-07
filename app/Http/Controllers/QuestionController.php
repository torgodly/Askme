<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        return Question::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([

        ]);

        return Question::create($data);
    }

    public function show(Question $question)
    {
        return $question;
    }

    public function update(Request $request, Question $question)
    {
        $data = $request->validate([

        ]);

        $question->update($data);

        return $question;
    }

    public function destroy(Question $question)
    {
        $question->delete();

        return response()->json();
    }
}
