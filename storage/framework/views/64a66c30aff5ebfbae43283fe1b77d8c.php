<?php if($paginator->hasPages()): ?>
    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="flex items-center space-x-2">
            
            <?php if($paginator->onFirstPage()): ?>
                <li>
                    <span class="px-3 py-1.5 border border-dark-border text-dark-muted rounded-lg cursor-not-allowed">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                </li>
            <?php else: ?>
                <li>
                    <a href="<?php echo e($paginator->previousPageUrl()); ?>" 
                       class="px-3 py-1.5 border border-dark-border text-dark-text rounded-lg hover:border-primary-500 hover:text-primary-300 transition">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            <?php endif; ?>

            
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php if(is_string($element)): ?>
                    <li>
                        <span class="px-3 py-1.5 text-dark-muted">...</span>
                    </li>
                <?php endif; ?>

                
                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                            <li>
                                <span class="px-3 py-1.5 bg-primary-600 text-white rounded-lg font-medium">
                                    <?php echo e($page); ?>

                                </span>
                            </li>
                        <?php else: ?>
                            <li>
                                <a href="<?php echo e($url); ?>" 
                                   class="px-3 py-1.5 border border-dark-border text-dark-text rounded-lg hover:border-primary-500 hover:text-primary-300 transition">
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
                       class="px-3 py-1.5 border border-dark-border text-dark-text rounded-lg hover:border-primary-500 hover:text-primary-300 transition">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            <?php else: ?>
                <li>
                    <span class="px-3 py-1.5 border border-dark-border text-dark-muted rounded-lg cursor-not-allowed">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?><?php /**PATH D:\laragon\www\AplikasiKosanAyokos\resources\views/vendor/pagination/custom-dark.blade.php ENDPATH**/ ?>