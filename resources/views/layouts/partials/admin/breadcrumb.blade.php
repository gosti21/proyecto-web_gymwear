@if (count($breadcrumbs))    
    <nav class="flex mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            @foreach ($breadcrumbs as $breadcrumb)
                <li class="leading-normal" @if ($loop->last) aria-current="page" @endif>
                    
                </li>
            @endforeach
            <li class="leading-normal">
                <a href="" class="text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    Dashboard
                </a>
            </li>
            <li class="leading-normal">
                <div class="flex items-center">
                    <i class="fa-solid fa-angle-right text-gray-400 mx-1"></i>
                    <a href="" class="text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                        Products
                    </a>
                </div>
            </li>
            <li class="leading-normal" aria-current="page">
                <div class="flex items-center">
                    <i class="fa-solid fa-angle-right text-gray-400 mx-1"></i>
                    <span class="text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400 pointer-events-none">
                        Nuevo
                    </span>
                </div>
            </li>
        </ol>
    </nav>
@endif
