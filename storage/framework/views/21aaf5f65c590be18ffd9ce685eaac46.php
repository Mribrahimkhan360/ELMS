<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    
    <nav class="flex items-center gap-1.5 text-[11.5px] text-gray-400 mb-4">
        <a href="" class="text-indigo-500 font-medium hover:underline">Admin</a>
        <span class="text-gray-300">›</span>
        <span class="text-gray-600">Admin Administration</span>
    </nav>

    <form method="POST" action="<?php echo e(route('administrations.update',$administration->id)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="grid gap-3" style="grid-template-columns: 1fr 300px; align-items: start;">

            
            <div class="space-y-3">
                
                <div class="bg-white rounded-xl border border-black/[0.08] overflow-hidden">
                    <div class="px-5 py-3.5 border-b border-black/[0.07]">
                        <p class="text-[13px] font-semibold text-gray-900">Leave Configure</p>
                        <p class="text-[11.5px] text-gray-400 mt-0.5">Please carefully submit your sick and casual leave requests using the form below. This information will be considered annually for all users.</p>
                    </div>
                    <div class="px-5 py-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            
                            <div>
                                <label class="block text-[12px] font-medium text-gray-600 mb-1.5">
                                    Sick<span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="sick" value="<?php echo e(old('sick', $administration->sick)); ?>"}"
                                       placeholder="e.g. 30"
                                       class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2
                          text-[13px] text-gray-900 placeholder-gray-400
                          focus:outline-none focus:ring-2 focus:ring-indigo-400/20
                          focus:border-indigo-400 focus:bg-white transition">
                            </div>

                            
                            <div>
                                <label class="block text-[12px] font-medium text-gray-600 mb-1.5">
                                    Casual <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="casual" value="<?php echo e(old('casual',$administration->casual)); ?>"
                                       placeholder="e.g. 30"
                                       class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2
                          text-[13px] text-gray-900 placeholder-gray-400
                          focus:outline-none focus:ring-2 focus:ring-indigo-400/20
                          focus:border-indigo-400 focus:bg-white transition">
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="bg-white rounded-xl border border-black/[0.08] overflow-hidden">


                    <div class="px-5 py-2.5 border-b border-black/[0.04] bg-gray-50/50">
                        <p class="text-[10.5px] font-semibold uppercase tracking-[0.07em] text-gray-300">
                            Administration Save
                        </p>

                        
                        <?php if(session('success')): ?>
                            <div class="mt-2 px-4 py-2 bg-green-100 text-green-700 text-[12.5px] rounded-lg border border-green-200">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>

                        
                        <?php if(session('error')): ?>
                            <div class="mt-2 px-4 py-2 bg-red-100 text-red-700 text-[12.5px] rounded-lg border border-red-200">
                                <?php echo e(session('error')); ?>

                            </div>
                        <?php endif; ?>
                    </div>

                    
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

            
            <div class="space-y-3">
                
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

    <?php $__env->startPush('scripts'); ?>
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
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\ELMS\resources\views/administrations/edit.blade.php ENDPATH**/ ?>