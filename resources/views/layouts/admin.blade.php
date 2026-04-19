<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $title ?? 'Admin' }}</title>

  {{-- load assets --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-black text-white min-h-screen">

  {{-- header --}}
  <header class="sticky top-0 z-50 bg-black border-b border-[#262626]">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">

      {{-- logo link --}}
      <a
        href="{{ route('admin.index') }}"
        class="font-semibold tracking-tight text-white">
        IR Explorer Admin
      </a>

      {{-- navigation --}}
      <nav class="flex flex-wrap gap-2 text-sm">

        {{-- dashboard link --}}
        <a
          href="{{ route('admin.index') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('admin.index') ? 'bg-[#171717] text-white' : 'text-[#D4D4D4] hover:bg-[#171717] hover:text-white' }}">
          Dashboard
        </a>

        {{-- criteria link --}}
        <a
          href="{{ route('admin.criteria') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('admin.criteria*') ? 'bg-[#171717] text-white' : 'text-[#D4D4D4] hover:bg-[#171717] hover:text-white' }}">
          Criteria
        </a>

        {{-- evaluation link --}}
        <a
          href="{{ route('admin.evaluation') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('admin.evaluation*') ? 'bg-[#171717] text-white' : 'text-[#D4D4D4] hover:bg-[#171717] hover:text-white' }}">
          Evaluation
        </a>

        {{-- glossary link --}}
        <a
          href="{{ route('admin.glossary') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('admin.glossary*') ? 'bg-[#171717] text-white' : 'text-[#D4D4D4] hover:bg-[#171717] hover:text-white' }}">
          Glossary
        </a>

        {{-- logout form --}}
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

  {{-- main content --}}
  <main class="max-w-6xl mx-auto px-4 py-8">
    @yield('content')
  </main>

</body>
</html>