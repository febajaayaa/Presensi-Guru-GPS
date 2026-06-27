<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-200 via-blue-100 to-white">

    <div class="w-full max-w-md">

<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

    <div class="w-full max-w-sm bg-white/80 backdrop-blur-lg p-6 rounded-3xl shadow-2xl">

        <!-- LOGO -->
        <div class="flex flex-col items-center mb-6">
            <img src="<?php echo e(asset('login.png')); ?>"
                 class="w-30 h-20 rounded-2xl shadow-md hover:scale-110 transition duration-300"
                 alt="Logo">

            <h1 class="text-2xl font-extrabold text-gray-800 mt-3 italic">
                Selamat Datang
            </h1>
            <p class="text-sm text-gray-500">
                Presensi Guru Berbasis GPS
            </p>
        </div>

        <!-- STATUS -->
        <?php if (isset($component)) { $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.auth-session-status','data' => ['class' => 'mb-4','status' => session('status')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('auth-session-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-4','status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('status'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $attributes = $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $component = $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>

        <!-- FORM -->
        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>

            <!-- Email -->
            <div class="mb-3">
                <label class="text-sm font-semibold text-gray-600">Email</label>
                <input type="email" name="email"
                    class="w-full mt-1 px-4 py-2 rounded-xl border focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="text-sm font-semibold text-gray-600">Password</label>
                <input type="password" name="password"
                    class="w-full mt-1 px-4 py-2 rounded-xl border focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    required>
            </div>

            <!-- Remember -->
            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center text-sm">
                    <input type="checkbox" name="remember" class="mr-2">
                    Ingat saya
                </label>

                <a href="<?php echo e(route('password.request')); ?>" class="text-sm text-blue-500 hover:underline">
                    Lupa?
                </a>
            </div>

            <!-- BUTTON -->
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-xl font-semibold hover:bg-blue-700 transition duration-300 shadow-md">
                Login
            </button>

        </form>

    </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?><?php /**PATH D:\presensi-app\resources\views/auth/login.blade.php ENDPATH**/ ?>