@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    {{-- page header --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-white">Edit Evaluation</h1>
            <p class="mt-2 text-sm text-[#A3A3A3]">
                Manage IR4.0 and IR5.0 evaluation values in the same structure shown to users.
            </p>
        </div>

        {{-- add criterion button --}}
        <a
            href="{{ route('admin.criteria.create') }}"
            class="inline-flex items-center justify-center rounded-xl bg-white px-4 py-2 text-sm font-medium text-black transition hover:bg-[#E5E5E5]"
        >
            + Add Criterion
        </a>
    </div>

    {{-- success message --}}
    @if(session('success'))
        <div class="rounded-xl border border-green-800 bg-green-950 px-4 py-3 text-green-200">
            {{ session('success') }}
        </div>
    @endif

    {{-- no criteria state --}}
    @if($criteria->isEmpty())
        <div class="rounded-2xl border border-[#262626] bg-[#0A0A0A] p-6">
            <p class="font-medium text-[#D4D4D4]">No criteria found.</p>
        </div>
    @else
        {{-- evaluation table --}}
        <div class="overflow-hidden rounded-3xl border border-[#262626] bg-[#0A0A0A]">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-[#262626]">
                            <th class="px-6 py-5 text-left text-sm font-semibold text-[#A3A3A3]">Criterion</th>
                            <th class="px-6 py-5 text-center text-sm font-semibold text-[#A3A3A3]">IR4.0</th>
                            <th class="px-6 py-5 text-center text-sm font-semibold text-[#A3A3A3]">IR5.0</th>
                            <th class="px-6 py-5 text-right text-sm font-semibold text-[#A3A3A3]">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($criteria as $criterion)
                            @php
                                // get ir4 value
                                $ir4 = $criterion->evaluations->firstWhere('revolution', 'ir4');

                                // get ir5 value
                                $ir5 = $criterion->evaluations->firstWhere('revolution', 'ir5');

                                // set badge style
                                $badgeClasses = function ($value) {
                                    return match($value) {
                                        'Meets' => 'border-green-700/50 bg-green-900/30 text-green-300',
                                        'Partial' => 'border-yellow-700/50 bg-yellow-900/30 text-yellow-300',
                                        'Unclear' => 'border-red-700/50 bg-red-900/30 text-red-300',
                                        'Does Not Meet' => 'border-zinc-600 bg-zinc-800 text-zinc-200',
                                        default => 'border-zinc-700 bg-zinc-900 text-zinc-300',
                                    };
                                };
                            @endphp

                            <tr class="border-b border-[#1F1F1F] last:border-b-0">
                                <td class="px-6 py-5 align-middle">
                                    <div class="font-medium text-white">
                                        {{ $criterion->name }}
                                    </div>
                                </td>

                                {{-- ir4 select --}}
                                <td class="px-6 py-5 align-middle text-center">
                                    @if($ir4)
                                        <form method="POST" action="{{ route('admin.evaluation.update.value', $ir4) }}">
                                            @csrf
                                            @method('PUT')

                                            <select
                                                name="value"
                                                onchange="this.form.submit()"
                                                class="rounded-full border px-4 py-2 text-sm font-medium outline-none transition {{ $badgeClasses($ir4->value) }}"
                                            >
                                                <option value="Meets" @selected($ir4->value === 'Meets')>Meets</option>
                                                <option value="Partial" @selected($ir4->value === 'Partial')>Partial</option>
                                                <option value="Unclear" @selected($ir4->value === 'Unclear')>Unclear</option>
                                                <option value="Does Not Meet" @selected($ir4->value === 'Does Not Meet')>Does Not Meet</option>
                                            </select>
                                        </form>
                                    @else
                                        {{-- add ir4 value --}}
                                        <form method="POST" action="{{ route('admin.evaluation.store') }}">
                                            @csrf
                                            <input type="hidden" name="criterion_id" value="{{ $criterion->id }}">
                                            <input type="hidden" name="revolution" value="ir4">
                                            <select
                                                name="value"
                                                onchange="this.form.submit()"
                                                class="rounded-full border border-[#404040] bg-[#111111] px-4 py-2 text-sm text-white"
                                            >
                                                <option value="">Add</option>
                                                <option value="Meets">Meets</option>
                                                <option value="Partial">Partial</option>
                                                <option value="Unclear">Unclear</option>
                                                <option value="Does Not Meet">Does Not Meet</option>
                                            </select>
                                        </form>
                                    @endif
                                </td>

                                {{-- ir5 select --}}
                                <td class="px-6 py-5 align-middle text-center">
                                    @if($ir5)
                                        <form method="POST" action="{{ route('admin.evaluation.update.value', $ir5) }}">
                                            @csrf
                                            @method('PUT')

                                            <select
                                                name="value"
                                                onchange="this.form.submit()"
                                                class="rounded-full border px-4 py-2 text-sm font-medium outline-none transition {{ $badgeClasses($ir5->value) }}"
                                            >
                                                <option value="Meets" @selected($ir5->value === 'Meets')>Meets</option>
                                                <option value="Partial" @selected($ir5->value === 'Partial')>Partial</option>
                                                <option value="Unclear" @selected($ir5->value === 'Unclear')>Unclear</option>
                                                <option value="Does Not Meet" @selected($ir5->value === 'Does Not Meet')>Does Not Meet</option>
                                            </select>
                                        </form>
                                    @else
                                        {{-- add ir5 value --}}
                                        <form method="POST" action="{{ route('admin.evaluation.store') }}">
                                            @csrf
                                            <input type="hidden" name="criterion_id" value="{{ $criterion->id }}">
                                            <input type="hidden" name="revolution" value="ir5">
                                            <select
                                                name="value"
                                                onchange="this.form.submit()"
                                                class="rounded-full border border-[#404040] bg-[#111111] px-4 py-2 text-sm text-white"
                                            >
                                                <option value="">Add</option>
                                                <option value="Meets">Meets</option>
                                                <option value="Partial">Partial</option>
                                                <option value="Unclear">Unclear</option>
                                                <option value="Does Not Meet">Does Not Meet</option>
                                            </select>
                                        </form>
                                    @endif
                                </td>

                                {{-- row actions --}}
                                <td class="px-6 py-5 align-middle">
                                    <div class="flex justify-end gap-3">
                                        <a
                                            href="{{ route('admin.criteria.edit', $criterion) }}"
                                            class="text-sm font-medium text-white hover:text-[#D4D4D4]"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('admin.evaluation.destroy', $criterion) }}"
                                            onsubmit="return confirm('Delete this criterion and its evaluation values?')"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="text-sm font-medium text-red-400 hover:text-red-300"
                                            >
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>
@endsection