<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container0Mi7x6W\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container0Mi7x6W/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container0Mi7x6W.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container0Mi7x6W\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \Container0Mi7x6W\App_KernelDevDebugContainer([
    'container.build_hash' => '0Mi7x6W',
    'container.build_id' => '86169fc2',
    'container.build_time' => 1729260255,
], __DIR__.\DIRECTORY_SEPARATOR.'Container0Mi7x6W');
