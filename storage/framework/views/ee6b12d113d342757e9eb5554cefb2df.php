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
    <div class="p-6">
        <div class="mb-5">
            <h1 class="text-2xl font-bold text-gray-800">Data Izin &amp; Sakit</h1>
            <p class="text-gray-500 text-sm">Pantau riwayat pengajuan izin dan statusnya.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-5 py-4 bg-gradient-to-r from-blue-600 to-sky-600">
                <div class="flex items-center justify-between gap-4">
                    <div class="text-white">
                        <p class="text-sm opacity-90">Total Pengajuan</p>
                        <p class="text-2xl font-bold">
                            <?php echo e($izins->count()); ?>

                        </p>
                    </div>
                    <div class="hidden sm:block text-white/90 text-sm text-right">
                        <p class="font-semibold">Pembaruan:</p>
                        <p class="opacity-90">Terakhir: <?php echo e(now()->format('d M Y')); ?></p>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-xs font-semibold text-gray-500">
                            <th class="p-3">Nama</th>
                            <th class="p-3">Tanggal</th>
                            <th class="p-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__empty_1 = true; $__currentLoopData = $izins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $izin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3">
                                    <div class="font-semibold text-gray-800"><?php echo e($izin->user->name); ?></div>
                                    <div class="text-xs text-gray-500">ID: #<?php echo e($izin->id); ?></div>
                                </td>
                                <td class="p-3">
                                    <div class="text-sm font-medium text-gray-800"><?php echo e($izin->created_at ? $izin->created_at->format('d M Y') : '-'); ?></div>
                                </td>
                                <td class="p-3">
                                    <?php
                                        $status = strtolower($izin->status ?? '');
                                        $label = ucfirst($izin->status ?? '-');
                                    ?>
                                    <?php if($status === 'pending'): ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-semibold"><?php echo e($label); ?></span>
                                    <?php elseif($status === 'disetujui'): ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold"><?php echo e($label); ?></span>
                                    <?php elseif($status === 'ditolak'): ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-800 text-xs font-semibold"><?php echo e($label); ?></span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-semibold"><?php echo e($label); ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="3" class="p-6 text-center">
                                    <div class="mx-auto w-max">
                                        <div class="text-4xl">📭</div>
                                        <p class="mt-2 font-semibold text-gray-700">Tidak ada data izin</p>
                                        <p class="text-sm text-gray-500">Silakan ajukan izin terlebih dahulu.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
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
<?php endif; ?><?php /**PATH D:\presensi-app\resources\views/user/izin/index.blade.php ENDPATH**/ ?>