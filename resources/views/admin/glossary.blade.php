@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-start justify-between gap-4 flex-wrap">
        <div>
            <h1 class="text-2xl font-semibold text-white">Edit Glossary</h1>
            <p class="mt-2 text-sm text-[#A3A3A3]">
                Manage glossary terms and definitions.
            </p>
        </div>

        <a
            href="{{ route('admin.glossary.create') }}"
            class="px-4 py-2 rounded-xl bg-white text-black text-sm font-medium hover:bg-[#E5E5E5] transition"
        >
            + Add Definition
        </a>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div class="bg-green-950 border border-green-800 text-green-200 rounded-xl px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- Empty --}}
    @if($terms->isEmpty())
        <div class="bg-[#0A0A0A] border border-[#262626] rounded-2xl p-6">
            <p class="text-[#D4D4D4] font-medium">No glossary terms found.</p>
            <p class="text-sm text-[#A3A3A3] mt-1">Add your first definition to begin.</p>
        </div>
    @else
        <div class="space-y-3">
            @foreach($terms as $term)
                <div class="bg-[#0A0A0A] border border-[#262626] rounded-2xl px-5 py-4 flex items-start justify-between gap-4 hover:border-[#404040] transition">

                    <div class="min-w-0">
                        <h2 class="text-base font-semibold text-white">
                            {{ $term->term }}
                        </h2>

                        <p class="mt-1 text-sm text-[#A3A3A3] line-clamp-2">
                            {{ $term->definition }}
                        </p>
                    </div>

                    <a
                        href="{{ route('admin.glossary.edit', $term) }}"
                        class="shrink-0 text-sm font-medium text-white hover:underline"
                    >
                        Edit →
                    </a>

                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection