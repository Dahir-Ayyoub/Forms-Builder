@extends('layouts.app')
@section('content')
    <!-- Add custom styles -->
    <style>
        .stats-card {
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }

        .chart-container {
            transition: all 0.3s ease;
            position: relative;
        }

        .chart-container:hover {
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }

        .submissions-card {
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .submissions-card:hover {
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }

        .star-rating {
            display: inline-flex;
            gap: 2px;
        }

        .star-filled {
            color: #FBBF24;
            filter: drop-shadow(0 0 2px rgba(251, 191, 36, 0.3));
            transform-origin: center;
            animation: starPop 0.3s ease-out;
        }

        .star-empty {
            color: #E5E7EB;
        }

        @keyframes starPop {
            0% { transform: scale(0.8); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        .rating-badge {
            background: rgba(251, 191, 36, 0.1);
            border: 1px solid rgba(251, 191, 36, 0.2);
            border-radius: 12px;
            padding: 2px 8px;
            font-size: 0.75rem;
            color: #D97706;
        }

        .submission-item {
            transition: all 0.2s ease;
            border-radius: 8px;
            border: 1px solid transparent;
        }

        .submission-item:hover {
            background-color: rgba(59, 130, 246, 0.05);
            border-color: rgba(59, 130, 246, 0.1);
        }
    </style>

    <div class="container mx-auto px-4 py-8 bg-gray-50 min-h-screen">
        <!-- Header Section -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $form->title }}</h1>
                <p class="text-gray-500 mt-2">Analytics Dashboard</p>
            </div>
            <div class="bg-white px-4 py-2 rounded-lg shadow-sm text-sm text-gray-600">
                Last updated: {{ now()->format('M d, Y H:i') }}
            </div>
        </div>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="stats-card bg-white p-6 rounded-xl">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-500 font-medium">Total Views</h3>
                    <div class="p-2 bg-blue-50 rounded-lg">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-blue-600">{{ number_format($form->views_count) }}</p>
                <p class="text-sm text-gray-400 mt-2">Total page views</p>
            </div>

            <div class="stats-card bg-white p-6 rounded-xl">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-500 font-medium">Submissions</h3>
                    <div class="p-2 bg-green-50 rounded-lg">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-green-600">{{ number_format($form->submissions_count) }}</p>
                <p class="text-sm text-gray-400 mt-2">Total responses</p>
            </div>

            <div class="stats-card bg-white p-6 rounded-xl">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-500 font-medium">Conversion Rate</h3>
                    <div class="p-2 bg-purple-50 rounded-lg">
                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-purple-600">
                    @if($form->views_count > 0)
                        {{ number_format(($form->submissions_count / $form->views_count) * 100, 1) }}%
                    @else
                        0%
                    @endif
                </p>
                <p class="text-sm text-gray-400 mt-2">Submission rate</p>
            </div>
        </div>

        <!-- Charts -->
        {{-- <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="chart-container bg-white p-6 rounded-xl">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Views Trend</h2>
                <div class="h-64">
                    <canvas id="viewsChart"></canvas>
                </div>
            </div>
            
            <div class="chart-container bg-white p-6 rounded-xl">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Submissions Trend</h2>
                <div class="h-64">
                    <canvas id="submissionsChart"></canvas>
                </div>
            </div>
        </div> --}}

        <!-- Recent Submissions -->
        <div class="submissions-card bg-white p-6 rounded-xl">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Recent Submissions</h2>
                <span class="text-sm text-gray-500">Last 10 responses</span>
            </div>
            
            <div class="space-y-4">
                @forelse($form->submissions()->latest()->take(10)->get() as $submission)
                    <div class="submission-item p-4">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-medium text-gray-500">
                                {{ $submission->created_at->format('M d, Y H:i') }}
                            </span>
                            <span class="text-xs bg-blue-50 text-blue-600 px-3 py-1 rounded-full">
                                #{{ $submission->id }}
                            </span>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($submission->data as $fieldId => $value)
                                @php
                                    $field = $form->fields->firstWhere('id', $fieldId);
                                    $label = $field ? $field->label : 'Field ' . $fieldId;
                                @endphp
                                <div class="flex items-baseline gap-3">
                                    <span class="text-sm font-medium text-gray-600">{{ $label }}:</span>
                                    <span class="text-sm text-gray-800">
                                        @if($field && $field->type === 'rating')
                                            <div class="flex items-center gap-3">
                                                <div class="star-rating">
                                                    @for($i = 1; $i <= (int)$field->options; $i++)
                                                        <span class="{{ $i <= $value ? 'star-filled' : 'star-empty' }}">
                                                            {{ $i <= $value ? '★' : '☆' }}
                                                        </span>
                                                    @endfor
                                                </div>
                                                <span class="rating-badge">
                                                    {{ $value }}/{{ $field->options }}
                                                </span>
                                            </div>
                                        @elseif(is_array($value))
                                            <span class="text-gray-600">{{ implode(', ', $value) }}</span>
                                        @else
                                            <span class="text-gray-600">{{ $value ?? 'N/A' }}</span>
                                        @endif
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <div class="text-gray-400 mb-3">
                            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <p class="text-gray-500 text-lg">No submissions yet</p>
                        <p class="text-gray-400 text-sm mt-1">Submissions will appear here once users start responding</p>
                    </div>
                @endforelse
            </div>
        </div>

        @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const chartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day',
                            tooltipFormat: 'MMM d',
                            displayFormats: {
                                day: 'MMM d'
                            }
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            };

            // Views Chart
            new Chart(document.getElementById('viewsChart'), {
                type: 'line',
                data: {
                    labels: {!! json_encode(array_keys($viewsData)) !!},
                    datasets: [{
                        label: 'Views',
                        data: {!! json_encode(array_values($viewsData)) !!},
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.3,
                        fill: true,
                        pointBackgroundColor: '#3B82F6',
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: chartOptions
            });

            // Submissions Chart
            new Chart(document.getElementById('submissionsChart'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode(array_keys($submissionsData)) !!},
                    datasets: [{
                        label: 'Submissions',
                        data: {!! json_encode(array_values($submissionsData)) !!},
                        backgroundColor: 'rgba(16, 185, 129, 0.2)',
                        borderColor: '#10B981',
                        borderWidth: 2,
                        borderRadius: 4,
                        hoverBackgroundColor: 'rgba(16, 185, 129, 0.3)'
                    }]
                },
                options: chartOptions
            });
        </script>
        @endpush
    </div>
@endsection










{{-- @extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Analytics for {{ $form->title }}</h1>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm">Total Views</h3>
                <p class="text-2xl font-bold text-blue-600">{{ $form->views_count }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm">Total Submissions</h3>
                <p class="text-2xl font-bold text-green-600">{{ $form->submissions_count }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500 text-sm">Conversion Rate</h3>
                <p class="text-2xl font-bold text-purple-600">
                    @if($form->views_count > 0)
                        {{ number_format(($form->submissions_count / $form->views_count) * 100, 2) }}%
                    @else
                        0%
                    @endif
                </p>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Views Over Time (Last 30 Days)</h2>
                <div class="h-64">
                    <canvas id="viewsChart"></canvas>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Submissions Over Time (Last 30 Days)</h2>
                <div class="h-64">
                    <canvas id="submissionsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Recent Submissions</h2>
            <div class="space-y-4">
                @forelse($form->submissions()->latest()->take(10)->get() as $submission)
                    <div class="border-b pb-4">
                        <div class="text-sm text-gray-500 mb-2">
                            {{ $submission->created_at->format('M d, Y H:i') }}
                        </div>
                        <div class="space-y-1">
                            @foreach($submission->data as $fieldId => $value)
                                @php
                                    $field = $form->fields->firstWhere('id', $fieldId);
                                    $label = $field ? $field->label : 'Field ' . $fieldId;
                                @endphp
                                <div class="flex items-baseline space-x-2">
                                    <span class="font-medium text-sm text-gray-700">{{ $label }}:</span>
                                    <span class="text-gray-600">
                                        @if($field && $field->type === 'rating')
                                            <span class="flex items-center gap-2">
                                                <span class="flex">
                                                    @for($i = 1; $i <= (int)$field->options; $i++)
                                                        @if($i <= $value)
                                                            <span class="text-yellow-400">★</span>
                                                        @else
                                                            <span class="text-gray-300">☆</span>
                                                        @endif
                                                    @endfor
                                                </span>
                                                <span class="text-sm text-gray-500">({{ $value }}/{{ $field->options }})</span>
                                            </span>
                                        @elseif(is_array($value))
                                            {{ implode(', ', $value) }}
                                        @else
                                            {{ $value ?? 'N/A' }}
                                        @endif
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="text-gray-500 text-center py-4">
                        No submissions yet
                    </div>
                @endforelse
            </div>
        </div>

        @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Views Chart
            new Chart(document.getElementById('viewsChart'), {
                type: 'line',
                data: {
                    labels: {!! json_encode(array_keys($viewsData)) !!},
                    datasets: [{
                        label: 'Views',
                        data: {!! json_encode(array_values($viewsData)) !!},
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.05)',
                        tension: 0.1,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            type: 'time',
                            time: {
                                unit: 'day',
                                tooltipFormat: 'MMM d',
                                displayFormats: {
                                    day: 'MMM d'
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });

            // Submissions Chart
            new Chart(document.getElementById('submissionsChart'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode(array_keys($submissionsData)) !!},
                    datasets: [{
                        label: 'Submissions',
                        data: {!! json_encode(array_values($submissionsData)) !!},
                        backgroundColor: '#10B981'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            type: 'time',
                            time: {
                                unit: 'day',
                                tooltipFormat: 'MMM d',
                                displayFormats: {
                                    day: 'MMM d'
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        </script>
        @endpush
    </div>
@endsection --}}