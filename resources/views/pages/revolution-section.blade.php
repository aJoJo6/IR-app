@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <nav class="text-xs text-[#6B7280]">
        <a href="{{ route('home') }}" class="hover:text-[#111827]">Home</a>
        <span class="mx-1">/</span>
        <a href="{{ route('revolutions.index') }}" class="hover:text-[#111827]">Explore</a>
        <span class="mx-1">/</span>
        <a href="{{ route('revolutions.show', $revolution['id']) }}" class="hover:text-[#111827]">
            {{ $revolution['label'] }}
        </a>
        <span class="mx-1">/</span>
        <span class="text-[#111827]">{{ $sectionTitle }}</span>
    </nav>

    <div>
        <p class="text-sm text-[#6B7280]">
            {{ $revolution['label'] }} • {{ $revolution['years'] }}
        </p>

        <h1 class="mt-1 text-2xl font-semibold text-[#111827]">
            {{ $sectionTitle }}
        </h1>

        <p class="mt-2 text-sm text-[#374151]">
            {{ $revolution['title'] }}
        </p>
    </div>

    @if($sectionImages->isNotEmpty())
        <div class="rounded-2xl border border-[#D1D5DB] bg-[#F9FAFB] p-4">
            <h2 class="text-sm font-medium text-[#111827]">Gallery</h2>

            <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($sectionImages as $image)
                    <figure class="space-y-2">
                        <img
                            src="{{ asset('storage/' . $image->image_path) }}"
                            alt="{{ $sectionTitle }}"
                            class="h-48 w-full rounded-xl border border-[#D1D5DB] object-cover"
                        >
                    </figure>
                @endforeach
            </div>
        </div>
    @endif

    <div class="rounded-2xl border border-[#D1D5DB] bg-[#F9FAFB] p-5">
        <div class="prose prose-sm max-w-none text-[#111827]">
            {!! nl2br(e($sectionContent)) !!}
        </div>
    </div>

    @if(!empty($categories))
        <div class="rounded-2xl border border-[#D1D5DB] bg-[#F9FAFB] p-4">
            <h2 class="text-sm font-medium text-[#111827]">Other sections</h2>

            <div class="mt-3 flex flex-wrap gap-2">
                @foreach($categories as $key => $label)
                    <a
                        href="{{ route('revolutions.section', [$revolution['id'], $key]) }}"
                        class="rounded-lg border px-3 py-2 text-sm transition
                            {{ $sectionKey === $key
                                ? 'border-[#111827] bg-[#111827] text-white'
                                : 'border-[#D1D5DB] bg-white text-[#111827] hover:bg-[#F3F4F6]' }}"
                    >
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <div>
        <a
            href="{{ route('revolutions.show', $revolution['id']) }}"
            class="inline-flex items-center rounded-lg border border-[#D1D5DB] bg-white px-4 py-2 text-sm font-medium text-[#111827] transition hover:bg-[#F3F4F6]"
        >
            ← Back to {{ $revolution['label'] }}
        </a>
    </div>

</div>
@endsection