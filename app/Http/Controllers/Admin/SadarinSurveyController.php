<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SadarinSurvey;
use App\Models\SadarinSurveyResponse;
use Illuminate\Http\Request;

class SadarinSurveyController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->search);

        $surveys = SadarinSurvey::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('survey_title', 'like', "%{$search}%")->orWhere('survey_description', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('survey_created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.survey.index', [
            'surveys' => $surveys,
            'search' => $search,
        ]);
    }

    public function create()
    {
        return view('admin.survey.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'survey_title' => ['required', 'string', 'max:255'],

            'survey_description' => ['nullable', 'string'],

            'survey_is_active' => ['nullable', 'boolean'],

            'survey_started_at' => ['nullable', 'date'],

            'survey_ended_at' => ['nullable', 'date', 'after_or_equal:survey_started_at'],
        ]);

        $validated['survey_is_active'] = $request->boolean('survey_is_active');

        SadarinSurvey::create($validated);

        return redirect()->route('sadarin.admin.survey.index')->with('success', 'Survey kepuasan berhasil dibuat.');
    }

    public function edit(SadarinSurvey $survey)
    {
        return view('admin.survey.edit', [
            'survey' => $survey,
        ]);
    }

    public function update(Request $request, SadarinSurvey $survey)
    {
        $validated = $request->validate([
            'survey_title' => ['required', 'string', 'max:255'],

            'survey_description' => ['nullable', 'string'],

            'survey_is_active' => ['nullable', 'boolean'],

            'survey_started_at' => ['nullable', 'date'],

            'survey_ended_at' => ['nullable', 'date', 'after_or_equal:survey_started_at'],
        ]);

        $validated['survey_is_active'] = $request->boolean('survey_is_active');

        $survey->update($validated);

        return redirect()->route('sadarin.admin.survey.index')->with('success', 'Survey kepuasan berhasil diperbarui.');
    }

    public function destroy(SadarinSurvey $survey)
    {
        $survey->delete();

        return redirect()->route('sadarin.admin.survey.index')->with('success', 'Survey kepuasan berhasil dihapus.');
    }

    public function responses($id)
    {
        $survey = SadarinSurvey::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | BASE QUERY RESPONSE
        |--------------------------------------------------------------------------
        */

        $responseQuery = SadarinSurveyResponse::query()->where('survey_response_survey_id', $survey->survey_id);

        /*
        |--------------------------------------------------------------------------
        | STATISTIK KEPUASAN
        |--------------------------------------------------------------------------
        */

        $totalResponse = (clone $responseQuery)->count();

        $totalRating = (clone $responseQuery)->whereNotNull('survey_response_rating')->count();

        $averageRating = (clone $responseQuery)->whereNotNull('survey_response_rating')->avg('survey_response_rating');

        $averageRating = $averageRating ? round($averageRating, 1) : 0;

        /*
        |--------------------------------------------------------------------------
        | DISTRIBUSI RATING
        |--------------------------------------------------------------------------
        */

        $ratingCounts = [];

        for ($rating = 5; $rating >= 1; $rating--) {
            $count = (clone $responseQuery)->where('survey_response_rating', $rating)->count();

            $percentage = $totalRating > 0 ? round(($count / $totalRating) * 100, 1) : 0;

            $ratingCounts[$rating] = [
                'count' => $count,
                'percentage' => $percentage,
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | RESPONSE LIST
        |--------------------------------------------------------------------------
        */

        $responses = (clone $responseQuery)->orderByDesc('survey_response_created_at')->paginate(25)->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view('admin.survey.responses', [
            'survey' => $survey,
            'responses' => $responses,
            'totalResponse' => $totalResponse,
            'totalRating' => $totalRating,
            'averageRating' => $averageRating,
            'ratingCounts' => $ratingCounts,
        ]);
    }
}