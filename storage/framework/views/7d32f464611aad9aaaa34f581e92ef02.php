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
    
    <div class="flex items-start justify-between mb-5">
        <div>
            <h1 class="text-[17px] font-semibold text-gray-900">Permissions</h1>
            <p class="text-[12px] text-gray-400 mt-0.5">Manage user roles and their permissions</p>

            
            <?php if(session('success')): ?>
                <div
                    class="mb-3 px-4 py-2 bg-green-100 text-green-700 text-[12.5px] rounded-lg border border-green-200">
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

        </div>
        <a href="<?php echo e(route('roles.create')); ?>"
           class="inline-flex items-center gap-2 bg-indigo-500 hover:bg-indigo-600 text-white
                  text-[12.5px] font-semibold px-4 py-2 rounded-lg transition">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 14 14">
                <path d="M7 1v12M1 7h12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            New Role
        </a>
    </div>

    
    <div class="bg-white rounded-xl border border-black/[0.08] overflow-hidden">
        
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

        
        <table class="w-full border-collapse">
            <thead>
            <tr class="border-b border-black/[0.07]">
                <th class="text-left px-5 py-2.5 text-[10.5px] font-semibold uppercase tracking-[0.07em] text-gray-300">
                    #
                </th>
                <th class="text-left px-5 py-2.5 text-[10.5px] font-semibold uppercase tracking-[0.07em] text-gray-300">
                    Role
                </th>
                <th class="text-left px-5 py-2.5 text-[10.5px] font-semibold uppercase tracking-[0.07em] text-gray-300">
                    Permissions
                </th>
                <th class="text-left px-5 py-2.5 text-[10.5px] font-semibold uppercase tracking-[0.07em] text-gray-300">
                    Created
                </th>
                <th class="text-left px-5 py-2.5 text-[10.5px] font-semibold uppercase tracking-[0.07em] text-gray-300">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b border-black/[0.05] hover:bg-gray-50/60 transition last:border-0">
                    
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-2.5">
                            <span class="text-[13px] font-semibold text-gray-900">
                            <?php echo e($loop->iteration); ?>

                        </span>
                        </div>
                    </td>
                    
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-2.5">
                            <span class="text-[13px] font-semibold text-gray-900">
                            <?php echo e($role->name ?? 'Name is empty'); ?>

                        </span>
                        </div>
                    </td>

                    
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-2.5">
                            <span class="text-[13px] font-semibold text-gray-900">
                              <div class="md:col-span-2">
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                                    <?php $__empty_1 = true; $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <span class="perm-badge"><?php echo e($permission->name); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <span class="no-perms">No permissions</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </span>
                        </div>
                    </td>
                    
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-2.5">
                            <span class="text-[13px] font-semibold text-gray-900">
                            <?php echo e($role->created_at ?? 'Date is empty'); ?>

                        </span>
                        </div>
                    </td>
                    
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-1">
                            <a href="<?php echo e(route('roles.edit',$role->id)); ?>"
                               class="w-7 h-7 rounded-lg border border-black/10 flex items-center justify-center
                                          text-gray-400 hover:bg-gray-100 transition">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 16 16">
                                    <path d="M11 2l3 3-9 9H2v-3z" stroke="currentColor" stroke-width="1.4"
                                          stroke-linejoin="round"/>
                                </svg>
                            </a>
                            <form method="POST" action="<?php echo e(route('roles.destroy',$role->id)); ?>"
                                  onsubmit="return confirm('Do you delete this role?')"
                            >
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="w-7 h-7 rounded-lg border border-black/10 flex items-center justify-center
                                    text-gray-400 hover:bg-red-50 hover:text-red-500 hover:border-red-200 transition">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 16 16">
                                        <path d="M3 5h10M6 5V3h4v2M6 8v5M10 8v5"
                                              stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                                    </svg>
                                </button>
                            </form>
                            <a href="<?php echo e(route('roles.show',$role->id)); ?>"
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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
        </table>
    </div>
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
<?php /**PATH C:\xampp\htdocs\ELMS\resources\views/roles/index.blade.php ENDPATH**/ ?>