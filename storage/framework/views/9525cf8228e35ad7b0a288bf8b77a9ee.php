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
        <a href="" class="text-indigo-500 font-medium hover:underline">Leave</a>
        <span class="text-gray-300">›</span>
        <span class="text-gray-600">Leave Apply</span>
    </nav>

    <div class="flex items-start justify-between mb-4">
        <div>
            <h1 class="text-[17px] font-semibold text-gray-900">Create Leave</h1>
            <p class="text-[12px] text-gray-400 mt-0.5">Before starting, kindly review all the instructions on this page carefully.</p>
        </div>
    </div>

    
    <?php if(session('success')): ?>
        <div class="mb-3 px-4 py-2 bg-green-100 text-green-700 text-[12.5px] rounded-lg border border-green-200">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <?php if($errors->any()): ?>
        <div class="mb-3 px-4 py-2 bg-red-100 text-red-700 text-[12.5px] rounded-lg border border-red-200">
            <ul class="list-disc pl-5">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('leave.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="grid grid-cols-1 lg:grid-cols-[1fr_300px] gap-3 items-start">

            
            <div class="space-y-3">
                
                <div class="bg-white rounded-xl border border-black/[0.08] overflow-hidden">
                    <div class="px-5 py-3.5 border-b border-black/[0.07]">
                        <p class="text-[13px] font-semibold text-gray-900">Leave Apply</p>
                    </div>
                    <div class="px-5 py-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                            
                            <div>
                                <label class="block text-[12px] font-medium text-gray-600 mb-1.5">
                                    From Date <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="form_date"
                                       value="<?php echo e(old('form_date')); ?>"
                                       class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2
                                              text-[13px] text-gray-900 placeholder-gray-400
                                              focus:outline-none focus:ring-2 focus:ring-indigo-400/20
                                              focus:border-indigo-400 focus:bg-white transition">
                            </div>

                            
                            <div>
                                <label class="block text-[12px] font-medium text-gray-600 mb-1.5">
                                    To Date <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="to_date"
                                       value="<?php echo e(old('to_date')); ?>"
                                       class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2
                                              text-[13px] text-gray-900 placeholder-gray-400
                                              focus:outline-none focus:ring-2 focus:ring-indigo-400/20
                                              focus:border-indigo-400 focus:bg-white transition">
                            </div>

                            
                            <div>
                                <label class="block text-[12px] font-medium text-gray-600 mb-1.5">
                                    Leave Type <span class="text-red-500">*</span>
                                </label>
                                <select name="leave_type"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2
                                               text-[13px] text-gray-900
                                               focus:outline-none focus:ring-2 focus:ring-indigo-400/20
                                               focus:border-indigo-400 focus:bg-white transition">
                                    <option value="">-- Select Leave Type --</option>
                                    <option value="sick" <?php echo e(old('leave_type') == 'sick' ? 'selected' : ''); ?>>Sick</option>
                                    <option value="casual" <?php echo e(old('leave_type') == 'casual' ? 'selected' : ''); ?>>Casual</option>
                                </select>
                            </div>

                            
                            <div>
                                <label class="block text-[12px] font-medium text-gray-600 mb-1.5">
                                    Upload Attachment
                                </label>
                                <input type="file" name="attachment"
                                       class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2
                                              text-[13px] text-gray-900
                                              focus:outline-none focus:ring-2 focus:ring-indigo-400/20
                                              focus:border-indigo-400 focus:bg-white transition
                                              file:mr-3 file:py-1 file:px-3 file:rounded-md file:border-0
                                              file:text-[12px] file:font-medium file:bg-indigo-50 file:text-indigo-600
                                              hover:file:bg-indigo-100 file:cursor-pointer">
                            </div>

                        </div>

                        
                        <div class="mt-4">
                            <label class="block text-[12px] font-medium text-gray-600 mb-1.5">
                                Reason <span class="text-red-500">*</span>
                            </label>
                            <textarea
                                name="reason"
                                rows="4"
                                placeholder="Write your reason clearly..."
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2
                                       text-[13px] text-gray-900 placeholder-gray-400
                                       focus:outline-none focus:ring-2 focus:ring-indigo-400/20
                                       focus:border-indigo-400 focus:bg-white transition resize-none"
                            ><?php echo e(old('reason')); ?></textarea>
                        </div>
                    </div>
                </div>

                
                <div class="bg-white rounded-xl border border-black/10 shadow-sm overflow-hidden">
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-3 px-6 py-4">

                        
                        <a href=""
                           class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-gray-600
                  bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-gray-800
                  transition duration-200 ease-in-out">
                            Cancel
                        </a>

                        
                        <button type="submit"
                                class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-white
                       bg-indigo-600 rounded-lg shadow-sm hover:bg-indigo-700 active:scale-[0.98]
                       transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            Submit Leave
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
                            <span class="text-[10.5px] font-semibold bg-green-100 text-green-800 px-2 py-0.5 rounded-full">Active</span>
                        </div>
                        <div class="flex items-center justify-between px-4 py-2.5">
                            <span class="text-[11.5px] text-gray-400">Leave Days</span>
                            <span class="text-[12px] font-semibold text-indigo-500" id="leave-days">—</span>
                        </div>
                        <div class="flex items-center justify-between px-4 py-2.5">
                            <span class="text-[11.5px] text-gray-400">Leave Type</span>
                            <span class="text-[12px] font-semibold text-gray-700" id="leave-type-label">—</span>
                        </div>
                        <div class="flex items-center justify-between px-4 py-2.5">
                            <span class="text-[11.5px] text-gray-400">Created by</span>
                            <span class="text-[12px] font-semibold text-gray-700"><?php echo e(auth()->user()->name); ?></span>
                        </div>
                    </div>
                </div>

                
                <div class="bg-white rounded-xl border border-black/[0.08] overflow-hidden">
                    <div class="px-4 py-3 border-b border-black/[0.07]">
                        <p class="text-[13px] font-semibold text-gray-900">Tips</p>
                    </div>
                    <div class="px-4 py-3.5 space-y-2">
                        <p class="flex items-start gap-2 text-[12px] text-gray-400 leading-relaxed">
                            <span class="text-indigo-400 mt-0.5">•</span>
                            Apply for leave at least 2 days in advance when possible.
                        </p>
                        <p class="flex items-start gap-2 text-[12px] text-gray-400 leading-relaxed">
                            <span class="text-indigo-400 mt-0.5">•</span>
                            Attach a medical certificate for sick leave longer than 2 days.
                        </p>
                        <p class="flex items-start gap-2 text-[12px] text-gray-400 leading-relaxed">
                            <span class="text-indigo-400 mt-0.5">•</span>
                            Write a clear reason so your manager can review quickly.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </form>

    <?php $__env->startPush('scripts'); ?>
        <script>
            // Live leave-days counter in summary
            const fromInput  = document.querySelector('input[name="form_date"]');
            const toInput    = document.querySelector('input[name="to_date"]');
            const daysLabel  = document.getElementById('leave-days');
            const typeSelect = document.querySelector('select[name="leave_type"]');
            const typeLabel  = document.getElementById('leave-type-label');

            function updateSummary() {
                const from = new Date(fromInput.value);
                const to   = new Date(toInput.value);
                if (fromInput.value && toInput.value && to >= from) {
                    const diff = Math.round((to - from) / (1000 * 60 * 60 * 24)) + 1;
                    daysLabel.textContent = diff + (diff === 1 ? ' day' : ' days');
                } else {
                    daysLabel.textContent = '—';
                }
            }

            function updateType() {
                const opt = typeSelect.options[typeSelect.selectedIndex];
                typeLabel.textContent = opt.value ? opt.text : '—';
            }

            fromInput.addEventListener('change', updateSummary);
            toInput.addEventListener('change', updateSummary);
            typeSelect.addEventListener('change', updateType);
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
<?php /**PATH C:\xampp\htdocs\ELMS\resources\views/leave/create.blade.php ENDPATH**/ ?>