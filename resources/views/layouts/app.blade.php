<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $title ?? 'The Industrial Revolution Explorer' }}</title>

  {{-- assets --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#E5E7EB] text-[#111827]">

  {{-- header --}}
  <header class="sticky top-0 z-50 bg-[#111827] border-b border-[#1F2937]">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">

      {{-- logo --}}
      <a
        href="{{ route('home') }}"
        class="font-semibold tracking-tight {{ request()->routeIs('home') ? 'text-white' : 'text-[#E5E7EB] hover:text-white' }}">
        The IR Explorer
      </a>

      {{-- nav --}}
      <nav class="flex flex-wrap gap-2 text-sm">

        {{-- explore --}}
        <a
          href="{{ route('revolutions.index') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('revolutions.*') ? 'bg-[#1F2937] text-white' : 'text-[#E5E7EB] hover:bg-[#1F2937] hover:text-white' }}">
          Explore
        </a>

        {{-- compare --}}
        <a
          href="{{ route('analysis.compare') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('analysis.compare') ? 'bg-[#1F2937] text-white' : 'text-[#E5E7EB] hover:bg-[#1F2937] hover:text-white' }}">
          Compare
        </a>

        {{-- criteria --}}
        <a
          href="{{ route('analysis.criteria') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('analysis.criteria') ? 'bg-[#1F2937] text-white' : 'text-[#E5E7EB] hover:bg-[#1F2937] hover:text-white' }}">
          Criteria
        </a>

        {{-- evaluation --}}
        <a
          href="{{ route('analysis.evaluation') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('analysis.evaluation') ? 'bg-[#1F2937] text-white' : 'text-[#E5E7EB] hover:bg-[#1F2937] hover:text-white' }}">
          Evaluation
        </a>

        {{-- glossary --}}
        <a
          href="{{ route('glossary') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('glossary') ? 'bg-[#1F2937] text-white' : 'text-[#E5E7EB] hover:bg-[#1F2937] hover:text-white' }}">
          Glossary
        </a>

        {{-- edit --}}
        <a
          href="{{ route('admin.login') }}"
          class="p-2 rounded transition flex items-center justify-center
            {{ request()->routeIs('admin.*') ? 'bg-[#1F2937] text-white' : 'text-[#E5E7EB] hover:bg-[#1F2937] hover:text-white' }}"
          title="Admin"
        >
          {{-- Gear Icon --}}
          <svg xmlns="http://www.w3.org/2000/svg"
              class="w-5 h-5"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M10.343 3.94c.09-.542.56-.94 1.113-.94h1.088c.553 0 1.023.398 1.113.94l.09.544a1.125 1.125 0 001.648.813l.478-.276a1.125 1.125 0 011.42.165l.77.77c.39.39.445 1.01.165 1.42l-.276.478a1.125 1.125 0 00.813 1.648l.544.09c.542.09.94.56.94 1.113v1.088c0 .553-.398 1.023-.94 1.113l-.544.09a1.125 1.125 0 00-.813 1.648l.276.478c.28.41.225 1.03-.165 1.42l-.77.77a1.125 1.125 0 01-1.42.165l-.478-.276a1.125 1.125 0 00-1.648.813l-.09.544c-.09.542-.56.94-1.113.94h-1.088c-.553 0-1.023-.398-1.113-.94l-.09-.544a1.125 1.125 0 00-1.648-.813l-.478.276a1.125 1.125 0 01-1.42-.165l-.77-.77a1.125 1.125 0 01-.165-1.42l.276-.478a1.125 1.125 0 00-.813-1.648l-.544-.09A1.125 1.125 0 013 12.544v-1.088c0-.553.398-1.023.94-1.113l.544-.09a1.125 1.125 0 00.813-1.648l-.276-.478a1.125 1.125 0 01.165-1.42l.77-.77a1.125 1.125 0 011.42-.165l.478.276a1.125 1.125 0 001.648-.813l.09-.544z" />
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 15.75A3.75 3.75 0 1112 8.25a3.75 3.75 0 010 7.5z" />
          </svg>
        </a>
        
      </nav>
    </div>
  </header>

  {{-- main --}}
  <main class="max-w-6xl mx-auto px-4 py-8">
    @yield('content')
  </main>

</body>
</html>