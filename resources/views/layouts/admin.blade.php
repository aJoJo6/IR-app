<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $title ?? 'Admin' }}</title>

  {{-- assets --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-black text-white min-h-screen">

  {{-- header --}}
  <header class="sticky top-0 z-50 bg-black border-b border-[#262626]">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">

      {{-- logo --}}
      <a
        href="{{ route('admin.index') }}"
        class="font-semibold tracking-tight text-white">
        IR Explorer Admin
      </a>

      {{-- nav --}}
      <nav class="flex flex-wrap gap-2 text-sm">

        <a
          href="{{ route('admin.index') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('admin.index') ? 'bg-[#171717] text-white' : 'text-[#D4D4D4] hover:bg-[#171717] hover:text-white' }}">
          Dashboard
        </a>

        <a
          href="{{ route('admin.criteria') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('admin.criteria*') ? 'bg-[#171717] text-white' : 'text-[#D4D4D4] hover:bg-[#171717] hover:text-white' }}">
          Criteria
        </a>

        <a
          href="{{ route('admin.evaluation') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('admin.evaluation*') ? 'bg-[#171717] text-white' : 'text-[#D4D4D4] hover:bg-[#171717] hover:text-white' }}">
          Evaluation
        </a>

        <a
          href="{{ route('admin.glossary') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('admin.glossary*') ? 'bg-[#171717] text-white' : 'text-[#D4D4D4] hover:bg-[#171717] hover:text-white' }}">
          Glossary
        </a>

        <form method="POST" action="{{ route('admin.logout') }}">
          @csrf
          <button
            type="submit"
            class="px-3 py-2 rounded transition text-[#D4D4D4] hover:bg-[#171717] hover:text-white">
            Logout
          </button>
        </form>

      </nav>
    </div>
  </header>

  {{-- main --}}
  <main class="max-w-6xl mx-auto px-4 py-8">
    @yield('content')
  </main>

</body>
</html>