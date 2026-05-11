<?php if($paginator->hasPages()): ?>
    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="flex items-center space-x-2">
            
            <?php if($paginator->onFirstPage()): ?>
                <li>
                    <span class="px-3 py-1.5 border border-white/20 text-white/50 rounded-lg cursor-not-allowed">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                </li>
            <?php else: ?>
                <li>
                    <a href="<?php echo e($paginator->previousPageUrl()); ?>" 
                       class="px-3 py-1.5 border border-white/20 text-white rounded-lg hover:border-sky-500 hover:text-sky-400 transition">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            <?php endif; ?>

            
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php if(is_string($element)): ?>
                    <li>
                        <span class="px-3 py-1.5 text-white/50">...</span>
                    </li>
                <?php endif; ?>

                
                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                            <li>
                                <span class="px-3 py-1.5 bg-sky-500/20 backdrop-blur-sm border border-sky-500/20 text-white rounded-lg font-medium">
                                    <?php echo e($page); ?>

                                </span>
                            </li>
                        <?php else: ?>
                            <li>
                                <a href="<?php echo e($url); ?>" 
                                   class="px-3 py-1.5 border border-white/20 text-white rounded-lg hover:border-sky-500 hover:text-sky-400 transition">
                                    <?php echo e($page); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php if($paginator->hasMorePages()): ?>
                <li>
                    <a href="<?php echo e($paginator->nextPageUrl()); ?>" 
                       class="px-3 py-1.5 border border-white/20 text-white rounded-lg hover:border-sky-500 hover:text-sky-400 transition">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            <?php else: ?>
                <li>
                    <span class="px-3 py-1.5 border border-white/20 text-white/50 rounded-lg cursor-not-allowed">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>
<?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/vendor/pagination/custom-dark.blade.php ENDPATH**/ ?>