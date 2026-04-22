<x-app-layout>
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-1.5 text-[11.5px] text-gray-400 mb-4">
        <a href="" class="text-indigo-500 font-medium hover:underline">Users</a>
        <span class="text-gray-300">›</span>
        <span class="text-gray-600">Create user</span>
    </nav>

    <div class="flex items-start justify-between mb-4">
        <div>
            <h1 class="text-[17px] font-semibold text-gray-900">Create User</h1>
            <p class="text-[12px] text-gray-400 mt-0.5">Create users carefully ensuring accurate information and proper
                role assignment.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="grid gap-3" style="grid-template-columns: 1fr 300px; align-items: start;">

            {{-- ── Left Column ─────────────────────── --}}
            <div class="space-y-3">
                {{-- Role Details --}}
                <div class="bg-white rounded-xl border border-black/[0.08] overflow-hidden">
                    <div class="px-5 py-3.5 border-b border-black/[0.07]">
                        <p class="text-[13px] font-semibold text-gray-900">Users Details</p>
                        <p class="text-[11.5px] text-gray-400 mt-0.5">Basic information about this users</p>
                    </div>
                    <div class="px-5 py-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            {{-- Name --}}
                            <div>
                                <label class="block text-[12px] font-medium text-gray-600 mb-1.5">
                                    User Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       placeholder="e.g. HR Manager"
                                       class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2
                          text-[13px] text-gray-900 placeholder-gray-400
                          focus:outline-none focus:ring-2 focus:ring-indigo-400/20
                          focus:border-indigo-400 focus:bg-white transition">
                            </div>

                            {{-- Email --}}
                            <div>
                                <label class="block text-[12px] font-medium text-gray-600 mb-1.5">
                                    User Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                       placeholder="e.g. example@gmail.com"
                                       class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2
                          text-[13px] text-gray-900 placeholder-gray-400
                          focus:outline-none focus:ring-2 focus:ring-indigo-400/20
                          focus:border-indigo-400 focus:bg-white transition">
                            </div>

                            <div>
                                <label class="block text-[12px] font-medium text-gray-600 mb-1.5">
                                    Select Role <span class="text-red-500">*</span>
                                </label>

                                <select name="role"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2
               text-[13px] text-gray-900
               focus:outline-none focus:ring-2 focus:ring-indigo-400/20
               focus:border-indigo-400 focus:bg-white transition">

                                    <option value="">-- Select Role --</option>
                                    @foreach($roles as $role)
                                        <option class="text-black" value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}> {{ $role->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-[12px] font-medium text-gray-600 mb-1.5">
                                    User Name <span class="text-red-500">*</span>
                                </label>
                                <input type="password" name="password" value="{{ old('password') }}"
                                       placeholder="e.g. HR Manager"
                                       class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2
                          text-[13px] text-gray-900 placeholder-gray-400
                          focus:outline-none focus:ring-2 focus:ring-indigo-400/20
                          focus:border-indigo-400 focus:bg-white transition">
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Permissions --}}
                <div class="bg-white rounded-xl border border-black/[0.08] overflow-hidden">


                    <p class="text-[10.5px] font-semibold uppercase tracking-[0.07em] text-gray-300
                                  px-5 py-2.5 border-b border-black/[0.04] bg-gray-50/50">
                        Permission Save
                    {{-- Success Message --}}
                    @if(session('success'))
                        <div
                            class="mb-3 px-4 py-2 bg-green-100 text-green-700 text-[12.5px] rounded-lg border border-green-200">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Error Message --}}
                    @if($errors->any())
                        <div
                            class="mb-3 px-4 py-2 bg-red-100 text-red-700 text-[12.5px] rounded-lg border border-red-200">
                            <ul class="list-disc pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        </p>


                        {{-- Footer --}}
                        <div
                            class="flex items-center justify-end gap-2 px-5 py-3.5 border-t border-black/[0.07] bg-gray-50/60">
                            <a href=""
                               class="px-4 py-1.5 text-[12.5px] font-medium text-gray-500
                                  border border-black/[0.12] rounded-lg hover:bg-gray-100 transition">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center gap-2 bg-indigo-500 hover:bg-indigo-600
                                   text-white text-[12.5px] font-semibold px-5 py-1.5 rounded-lg transition">
                                Save Permission
                            </button>
                        </div>
                </div>
            </div>

            {{-- ── Right Column ─────────────────────── --}}
            <div class="space-y-3">
                {{-- Summary --}}
                <div class="bg-white rounded-xl border border-black/[0.08] overflow-hidden">
                    <div class="px-4 py-3 border-b border-black/[0.07]">
                        <p class="text-[13px] font-semibold text-gray-900">Summary</p>
                    </div>
                    <div class="divide-y divide-black/[0.05]">
                        <div class="flex items-center justify-between px-4 py-2.5">
                            <span class="text-[11.5px] text-gray-400">Status</span>
                            <span class="text-[10.5px] font-semibold bg-green-100 text-green-800
                                         px-2 py-0.5 rounded-full">Active</span>
                        </div>
                        <div class="flex items-center justify-between px-4 py-2.5">
                            <span class="text-[11.5px] text-gray-400">Permissions selected</span>
                            <span class="text-[12px] font-semibold text-indigo-500" id="perm-count">0</span>
                        </div>
                        <div class="flex items-center justify-between px-4 py-2.5">
                            <span class="text-[11.5px] text-gray-400">Assigned users</span>
                            <span class="text-[12px] font-semibold text-gray-700">0</span>
                        </div>
                        <div class="flex items-center justify-between px-4 py-2.5">
                            <span class="text-[11.5px] text-gray-400">Created by</span>
                            <span class="text-[12px] font-semibold text-gray-700">ahhh yy</span>
                        </div>
                    </div>
                </div>

                {{-- Tips --}}
                <div class="bg-white rounded-xl border border-black/[0.08] overflow-hidden">
                    <div class="px-4 py-3 border-b border-black/[0.07]">
                        <p class="text-[13px] font-semibold text-gray-900">Tips</p>
                    </div>
                    <div class="px-4 py-3.5 text-[12px] text-gray-400 leading-relaxed">
                        Keep roles focused on a single responsibility. Avoid granting broad permissions
                        unless absolutely necessary. Use descriptive names so teammates understand the
                        scope at a glance.
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('scripts')
        <script>
            // Live permission counter
            const boxes = document.querySelectorAll('input[name="permissions[]"]');
            const counter = document.getElementById('perm-count');
            const update = () => counter.textContent = [...boxes].filter(b => b.checked).length + ' / ' + boxes.length;
            boxes.forEach(b => b.addEventListener('change', update));
            update();

            // Select all toggle
            let allSelected = false;
            document.getElementById('select-all-btn').addEventListener('click', function () {
                allSelected = !allSelected;
                boxes.forEach(b => {
                    b.checked = allSelected;
                    b.dispatchEvent(new Event('change'));
                });
                // sync Alpine toggles
                document.querySelectorAll('[x-data]').forEach(el => {
                    if (el._x_dataStack) el._x_dataStack[0].on = allSelected;
                });
                this.textContent = allSelected ? 'Deselect All' : 'Select All';
                update();
            });
        </script>
    @endpush

</x-app-layout>
