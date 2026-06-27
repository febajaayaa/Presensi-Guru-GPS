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

<div class="flex min-h-screen bg-gradient-to-br from-gray-100 to-gray-200">

<?php
$user = auth()->user();
?>

    <!-- SIDEBAR -->
    <div class="w-64 bg-gradient-to-b from-blue-800 to-blue-900 text-white p-5 flex flex-col justify-between shadow-xl">
        <div>
            <a href="<?php echo e(route('profile.edit')); ?>" class="flex items-center gap-3 mb-8 hover:bg-blue-700 p-2 rounded-lg transition">
    
    <img src="<?php echo e(auth()->check() && auth()->user()->photo
    ? asset('storage/'.auth()->user()->photo)
    : 'https://i.pravatar.cc/50'); ?>" 
class="rounded-full w-10 h-10 object-cover">

<div>
    <h2 class="font-semibold"><?php echo e($user->name ?? 'Guest'); ?></h2>
    <p class="text-sm opacity-80">Mahasiswa PTI</p>
</div>

</a>

            <div class="space-y-2">
                 <a href="<?php echo e(route('dashboard')); ?>"
               class="block p-2 py-2 rounded-lg hover:bg-blue-700"
               <?php echo e(request()->routeIs('dashboard') ? 'bg-white text-blue-800 font-semibold' : 'hover:bg-blue-700'); ?>">
                Beranda
            </a>

                <a href="<?php echo e(route('izin.form')); ?>" class="block p-2 rounded-lg hover:bg-blue-700">
                    Izin
                </a>

                <a href="<?php echo e(route('cuti.index')); ?>"
                class="flex items-center gap-2 p-2 rounded-lg hover:bg-blue-700 transition">
                    <span>Cuti</span>
                </a>

                <a href="<?php echo e(route('history')); ?>" class="block p-2 rounded-lg hover:bg-blue-700">
                    Riwayat
                </a>

                <a href="<?php echo e(route('pengaturan')); ?>" class="block p-2 rounded-lg hover:bg-blue-700">
                    Pengaturan
                </a>
            </div>
        </div>

        
            <form method="POST" action="<?php echo e(route('logout')); ?>">
    <?php echo csrf_field(); ?>
    <button type="submit"
        class="w-full bg-red-500 text-white py-3 rounded-lg">
        Keluar
    </button>
</form>
    </div>

    <!-- MAIN -->
    <div class="flex-1 p-6">

<form method="POST" action="<?php echo e(route('profil.update')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('patch'); ?>

    <div class="text-center">

    <!-- FOTO -->
   <img 
    id="preview"
    src="<?php echo e(auth()->user()->photo 
        ? asset('storage/' . auth()->user()->photo) . '?v=' . time() 
        : 'https://i.pravatar.cc/100'); ?>"
    class="w-24 h-24 rounded-full mx-auto mb-3 object-cover"
>

    <!-- INPUT FILE (HIDDEN) -->
    <input type="file" name="photo" id="photo" style="display: none;">

    <!-- BUTTON -->
    <button type="button" 
        onclick="document.getElementById('photo').click()"
        class="bg-gray-200 px-4 py-2 rounded-lg">
        Ganti Foto
    </button>

    <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <p class="text-red-500 text-sm mt-2">
        <?php echo e($message); ?>

    </p>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

</div>

<!-- NAMA -->
<div class="mb-4">
    <label class="block text-sm mb-1">Nama</label>
    <input type="text" name="name" value="<?php echo e($user->name); ?>"
        class="w-full border p-2 rounded-lg">
</div>

<!-- EMAIL -->
<div class="mb-4">
    <label class="block text-sm mb-1">Email</label>
    <input type="email" name="email" value="<?php echo e($user->email); ?>"
        class="w-full border p-2 rounded-lg">
</div>

<!-- BUTTON -->
<div class="text-center">
    <button class="bg-blue-500 text-white px-6 py-2 rounded-lg">
        Simpan
    </button>
</div>

</form>

</div>

<script>

document.getElementById('photo').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(file);
    }
});
</script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH D:\presensi-app\resources\views/profil.blade.php ENDPATH**/ ?>