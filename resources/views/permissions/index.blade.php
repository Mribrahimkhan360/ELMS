<x-app-layout>
    {{-- Page Top --}}
    <div class="flex items-start justify-between mb-5">
        <div>
            <h1 class="text-[17px] font-semibold text-gray-900">Permissions</h1>
            <p class="text-[12px] text-gray-400 mt-0.5">Manage user roles and their permissions</p>
        </div>
        <a href="{{ route('permissions.create') }}"
           class="inline-flex items-center gap-2 bg-indigo-500 hover:bg-indigo-600 text-white
                  text-[12.5px] font-semibold px-4 py-2 rounded-lg transition">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 14 14">
                <path d="M7 1v12M1 7h12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            New Permission
        </a>
    </div>

    {{-- Table Card --}}
    <div class="bg-white rounded-xl border border-black/[0.08] overflow-hidden">
        {{-- Card Header --}}
        <div class="flex items-center justify-between px-5 py-3.5 border-b border-black/[0.07]">
            <span class="text-[13px] font-semibold text-gray-900">All Roles</span>
            <div class="relative">
                <svg class="absolute left-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400 pointer-events-none"
                     fill="none" viewBox="0 0 16 16">
                    <circle cx="7" cy="7" r="4.5" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M10.5 10.5l2.5 2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
                <input type="search" placeholder="Search roles…"
                       class="bg-[#f4f5f7] border border-black/10 rounded-lg pl-8 pr-3 py-1.5
                           text-[12px] text-gray-700 placeholder-gray-400 focus:outline-none
                           focus:ring-2 focus:ring-indigo-400/30 focus:border-indigo-400 w-[190px] transition">
            </div>
        </div>

        {{-- Table --}}
        <table class="w-full border-collapse">
            <thead>
            <tr class="border-b border-black/[0.07]">
                <th class="text-left px-5 py-2.5 text-[10.5px] font-semibold uppercase tracking-[0.07em] text-gray-300">#</th>
                <th class="text-left px-5 py-2.5 text-[10.5px] font-semibold uppercase tracking-[0.07em] text-gray-300">Permissions</th>
                <th class="text-left px-5 py-2.5 text-[10.5px] font-semibold uppercase tracking-[0.07em] text-gray-300">Created</th>
                <th class="text-left px-5 py-2.5 text-[10.5px] font-semibold uppercase tracking-[0.07em] text-gray-300">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($permissions as $permission)
            <tr class="border-b border-black/[0.05] hover:bg-gray-50/60 transition last:border-0">
                {{-- ID --}}
                <td class="px-5 py-3.5">
                    <div class="flex items-center gap-2.5">
                        <span class="text-[13px] font-semibold text-gray-900">
                            {{ $loop->iteration }}
                        </span>
                    </div>
                </td>
                {{-- Role Name --}}
                <td class="px-5 py-3.5">
                    <div class="flex items-center gap-2.5">
                        <span class="text-[13px] font-semibold text-gray-900">
                            {{ $permission->name }}
                        </span>
                    </div>
                </td>
                {{-- created --}}
                <td class="px-5 py-3.5">
                    <div class="flex items-center gap-2.5">
                        <span class="text-[13px] font-semibold text-gray-900">
                            {{ $permission->created_at }}
                        </span>
                    </div>
                </td>
                {{-- Actions --}}
                <td class="px-5 py-3.5">
                    <div class="flex items-center gap-1">
                        <a href="{{ route('permissions.edit',$permission->id) }}"
                           class="w-7 h-7 rounded-lg border border-black/10 flex items-center justify-center
                                          text-gray-400 hover:bg-gray-100 transition">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 16 16">
                                <path d="M11 2l3 3-9 9H2v-3z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <form method="POST" action="{{ route('permissions.destroy', $permission->id) }}"
                              onsubmit="return confirm('Delete this Permission?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="w-7 h-7 rounded-lg border border-black/10 flex items-center justify-center
                                 text-gray-400 hover:bg-red-50 hover:text-red-500 hover:border-red-200 transition">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 16 16">
                                    <path d="M3 5h10M6 5V3h4v2M6 8v5M10 8v5"
                                          stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                                </svg>
                            </button>
                        </form>
                        <a href="{{ route('permissions.show',$permission->id) }}"
                           class="w-7 h-7 rounded-lg border border-black/10 flex items-center justify-center
                            text-gray-400 hover:bg-gray-100 transition">

                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 12s3.75-7.5 9.75-7.5S21.75 12 21.75 12s-3.75 7.5-9.75 7.5S2.25 12 2.25 12z"/>
                                <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 15a3 3 0 100-6 3 3 0 000 6z"/>
                            </svg>

                        </a>
                    </div>
                </td>

            </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</x-app-layout>
