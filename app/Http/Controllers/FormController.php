<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormField;
use App\Models\FormView;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FormController extends Controller
{
    public function index()
    {
        return view('forms.index', [
            'forms' => auth()->user()->forms()
                ->withCount(['submissions', 'views'])
                ->latest()
                ->get()
        ]);
    }

    public function create()
    {
        return view('forms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'fields' => 'required|array',
            'fields.*.type' => 'required|in:text,date,textarea,radio,checkbox,rating',
            'fields.*.label' => 'required|string|max:255',
            'fields.*.options' => 'nullable|array',
            'fields.*.options.*' => 'nullable|string|max:255'
        ]);

        $form = $request->user()->forms()->create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(6),
        ]);

        foreach ($request->fields as $field) {
            $options = $field['options'] ?? [];
            
            // Handle rating type differently
            if ($field['type'] === 'rating') {
                $optionsValue = isset($options[0]) ? $options[0] : '5';
            } else {
                $optionsValue = json_encode($options);
            }

            $form->fields()->create([
                'label' => $field['label'],
                'type' => $field['type'],
                'options' => $optionsValue,
                'is_required' => $field['is_required'] ?? false,
                'order' => $field['order'] ?? 0,
            ]);
        }

        return redirect()->route('forms.index');
    }

    public function show(Form $form)
    {
        $form->increment('views');
        
        FormView::create([
            'form_id' => $form->id,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);

        return view('forms.show', compact('form'));
    }

    public function submit(Request $request, Form $form)
    {
        $validated = $request->validate([
            'fields' => 'required|array'
        ]);

        // Ensure rating values are integers
        foreach ($validated['fields'] as $fieldId => $value) {
            $field = FormField::find($fieldId);
            if ($field && $field->type === 'rating') {
                $validated['fields'][$fieldId] = (int)$value;
            }
        }

        $form->submissions()->create([
            'data' => $validated['fields']
        ]);

        return redirect()->back()->with('success', 'Form submitted successfully!');
    }

    public function edit(Form $form)
    {
        return view('forms.edit', compact('form'));
    }

    public function update(Request $request, Form $form)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'fields' => 'required|array',
            'fields.*.type' => 'required|in:text,date,textarea,radio,checkbox,rating',
            'fields.*.options' => 'nullable|string|max:255'
        ]);

        $form->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(6),
        ]);

        $form->fields()->delete();

        foreach ($request->fields as $field) {
            $form->fields()->create([
                'label' => $field['label'],
                'type' => $field['type'],
                'options' => $field['options'] ?? null,
                'is_required' => $field['is_required'] ?? false,
                'order' => $field['order'] ?? 0,
            ]);
        }

        return redirect()->route('forms.index');
    }

    public function destroy(Form $form)
    {
        $this->authorize('delete form', $form);
        
        $form->fields()->delete();
        $form->views()->delete();
        $form->submissions()->delete();
        $form->delete();

        return redirect()->route('forms.index')->with('success', 'Form deleted successfully.');
    }

    public function analytics(Form $form)
    {
        $form->loadCount(['views', 'submissions']);

        $viewsData = $form->views()
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date');

        $submissionsData = $form->submissions()
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date');

        $period = new \DatePeriod(
            now()->subDays(30),
            new \DateInterval('P1D'),
            now()
        );

        $viewsChartData = [];
        $submissionsChartData = [];

        foreach ($period as $date) {
            $dateString = $date->format('Y-m-d');
            $viewsChartData[$dateString] = $viewsData[$dateString] ?? 0;
            $submissionsChartData[$dateString] = $submissionsData[$dateString] ?? 0;
        }

        return view('forms.analytics', [
            'form' => $form,
            'viewsData' => $viewsChartData,
            'submissionsData' => $submissionsChartData
        ]);
    }
    public function qrcode(Form $form)
    {
        $url = route('forms.show', $form);
        $svg = QrCode::size(300)->generate($url);
        
        return response($svg)
            ->header('Content-Type', 'image/svg+xml')
            ->header('Content-Disposition', 'inline; filename="qrcode.svg"');
    }
}