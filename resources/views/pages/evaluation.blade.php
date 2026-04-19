@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- page header --}}
    <div>
        <h1 class="text-2xl font-semibold text-[#111827]">
            Evaluation: IR4.0 and IR5.0
        </h1>
        <p class="mt-2 text-base text-[#374151]">
            This is a proof-of-concept evaluation summary showing how IR4.0 and IR5.0 align with historically derived criteria.
        </p>
    </div>

    {{-- evaluation table container --}}
    <div class="rounded-3xl border border-[#D1D5DB] bg-[#F9FAFB] p-6">
        @if($criteria->isEmpty())
            {{-- empty state --}}
            <p class="text-sm text-[#6B7280]">No evaluation criteria available.</p>
        @else
            <table class="w-full">
                <thead>
                    <tr class="border-b border-[#E5E7EB]">
                        <th class="py-3 text-left text-sm font-semibold text-[#6B7280]">Criterion</th>
                        <th class="py-3 text-center text-sm font-semibold text-[#6B7280]">IR4.0</th>
                        <th class="py-3 text-center text-sm font-semibold text-[#6B7280]">IR5.0</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($criteria as $criterion)
                        @php
                            // build ir4 key
                            $keyIr4 = strtolower(trim($criterion->title)) . '|ir4';

                            // build ir5 key
                            $keyIr5 = strtolower(trim($criterion->title)) . '|ir5';

                            // get ir4 evaluation
                            $ir4 = $evaluationMap->get($keyIr4);

                            // get ir5 evaluation
                            $ir5 = $evaluationMap->get($keyIr5);

                            // badge style function
                            $badgeClass = fn($value) => match($value) {
                                'Meets' => 'bg-green-100 text-green-800 border-green-200',
                                'Partial' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                'Unclear' => 'bg-red-100 text-red-800 border-red-200',
                                default => 'bg-gray-100 text-gray-600 border-gray-200',
                            };
                        @endphp

                        <tr class="border-b border-[#F3F4F6] last:border-b-0">
                            {{-- criterion title --}}
                            <td class="py-4 text-sm text-[#111827]">
                                {{ $criterion->title }}
                            </td>

                            {{-- ir4 value --}}
                            <td class="py-4 text-center">
                                <span class="inline-flex rounded-full border px-3 py-1 text-sm {{ $ir4 ? $badgeClass($ir4->value) : '' }}">
                                    {{ $ir4->value ?? '—' }}
                                </span>
                            </td>

                            {{-- ir5 value --}}
                            <td class="py-4 text-center">
                                <span class="inline-flex rounded-full border px-3 py-1 text-sm {{ $ir5 ? $badgeClass($ir5->value) : '' }}">
                                    {{ $ir5->value ?? '—' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</div>
@endsection