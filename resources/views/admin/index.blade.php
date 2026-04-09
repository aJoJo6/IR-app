@extends('layouts.admin')

@section('content')
<div class="space-y-8">

  {{-- header --}}
  <div>
    <h1 class="text-3xl font-semibold text-white">Admin</h1>
    <p class="mt-2 text-sm text-[#A3A3A3]">
      Manage revolutions, sections, criteria, evaluation, and glossary content.
    </p>
  </div>

  {{-- flash --}}
  @if(session('success'))
    <div class="bg-green-950 border border-green-800 text-green-200 rounded-2xl px-4 py-3">
      {{ session('success') }}
    </div>
  @endif

  {{-- top blocks --}}
  <div class="grid lg:grid-cols-4 gap-6">

    {{-- revolutions block --}}
    <section class="bg-[#0A0A0A] border border-[#262626] rounded-2xl p-6">
      <h2 class="text-xl font-semibold text-white">Industrial Revolutions</h2>
      <p class="mt-2 text-sm text-[#A3A3A3]">
        Edit revolutions, summaries, images, and section content.
      </p>
    </section>

    {{-- criteria block --}}
    <a
      href="{{ route('admin.criteria') }}"
      class="block bg-[#0A0A0A] border border-[#262626] rounded-2xl p-6 hover:border-[#404040] hover:bg-[#111111] transition"
    >
      <h2 class="text-xl font-semibold text-white">Criteria</h2>
      <p class="mt-2 text-sm text-[#A3A3A3]">
        Edit criteria content.
      </p>
    </a>

    {{-- evaluation block --}}
    <a
      href="{{ route('admin.evaluation') }}"
      class="block bg-[#0A0A0A] border border-[#262626] rounded-2xl p-6 hover:border-[#404040] hover:bg-[#111111] transition"
    >
      <h2 class="text-xl font-semibold text-white">Evaluation</h2>
      <p class="mt-2 text-sm text-[#A3A3A3]">
        Edit evaluation content.
      </p>
    </a>

    {{-- glossary block --}}
    <a
      href="{{ route('admin.glossary') }}"
      class="block bg-[#0A0A0A] border border-[#262626] rounded-2xl p-6 hover:border-[#404040] hover:bg-[#111111] transition"
    >
      <h2 class="text-xl font-semibold text-white">Glossary</h2>
      <p class="mt-2 text-sm text-[#A3A3A3]">
        Edit glossary terms and add definitions.
      </p>
    </a>

  </div>

  {{-- revolutions list --}}
  <section class="bg-[#0A0A0A] border border-[#262626] rounded-2xl p-6 space-y-4">
    <h2 class="text-xl font-semibold text-white">Industrial Revolutions</h2>

    <div class="space-y-4">
      @foreach($revolutions as $revolution)
        <div class="bg-[#111111] border border-[#262626] rounded-2xl p-5">
          <div class="flex items-start justify-between gap-4 flex-wrap">
            <div>
              <h3 class="font-semibold text-white">
                {{ $revolution->label }} — {{ $revolution->title }}
              </h3>
              <p class="mt-1 text-sm text-[#A3A3A3]">{{ $revolution->years }}</p>
            </div>

            <a
              href="{{ route('admin.revolutions.edit', $revolution) }}"
              class="px-4 py-2 rounded-lg border border-[#404040] text-sm text-white hover:bg-[#171717] transition"
            >
              Edit revolution
            </a>
          </div>

          <div class="mt-4 grid md:grid-cols-2 gap-3">
            @foreach($revolution->sections as $section)
              <div class="border border-[#262626] rounded-xl p-4 flex items-start justify-between gap-4 bg-[#0F0F0F]">
                <div>
                  <h4 class="font-medium text-white">{{ $section->section_title }}</h4>
                  <p class="mt-1 text-sm text-[#A3A3A3]">
                    {{ \Illuminate\Support\Str::limit($section->body, 100) }}
                  </p>
                </div>

                <a
                  href="{{ route('admin.sections.edit', $section) }}"
                  class="text-sm font-medium text-white hover:underline whitespace-nowrap"
                >
                  Edit
                </a>
              </div>
            @endforeach
          </div>
        </div>
      @endforeach
    </div>
  </section>

</div>
@endsection