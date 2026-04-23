<x-app-layout>

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-1.5 text-[11.5px] text-gray-400 mb-4">
        <a href="" class="text-indigo-500 font-medium hover:underline">Roles</a>
        <span class="text-gray-300">›</span>
        <span class="text-gray-600">Roles Details</span>
    </nav>

    <form>
        <div class="grid gap-3" style="grid-template-columns: 1fr 300px; align-items: start;">

            {{-- ── Left Column ─────────────────────── --}}
            <div class="space-y-3">
                {{-- Role Details --}}
                <div class="bg-white rounded-xl border border-black/[0.08] overflow-hidden">
                    <div class="px-5 py-3.5 border-b border-black/[0.07]">
                        <p class="text-[13px] font-semibold text-gray-900">Role Details</p>
                        <p class="text-[11.5px] text-gray-400 mt-0.5">Basic information about this role with Permissions</p>
                    </div>
                    <div class="px-5 py-4 space-y-4">
                        {{-- Name --}}
                        <div>
                            <label class="block text-[11.5px] font-semibold text-gray-500 mb-1.5">
                                Permission Name <span class="text-red-400">*</span>
                            </label>
                            <div class="w-full bg-[#f9f9fb] rounded-lg px-3 py-2
                                text-[12.5px] text-gray-900 border border-gray-200">
                                {{ old('name', $role->name) }}
                            </div>
                        </div>
                    </div>
                    <div class="px-5 py-4 space-y-4">
                        @foreach($Permissions as $permission)
                            <div class="flex items-center">
                                <input
                                    type="checkbox"
                                    name="Permissions[]"
                                    disabled
                                    value="{{ $permission->name }}"
                                    id="perm_{{ $permission->id }}"
                                    class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                />
                                <label for="perm_{{ $permission->id }}" class="ml-2 text-gray-700">{{ $permission->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
    </form>

    @push('scripts')
        <script>
            // Live permission counter
            const boxes = document.querySelectorAll('input[name="Permissions[]"]');
            const counter = document.getElementById('perm-count');
            const update = () => counter.textContent = [...boxes].filter(b => b.checked).length + ' / ' + boxes.length;
            boxes.forEach(b => b.addEventListener('change', update));
            update();

            // Select all toggle
            let allSelected = false;
            document.getElementById('select-all-btn').addEventListener('click', function () {
                allSelected = !allSelected;
                boxes.forEach(b => { b.checked = allSelected; b.dispatchEvent(new Event('change')); });
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
