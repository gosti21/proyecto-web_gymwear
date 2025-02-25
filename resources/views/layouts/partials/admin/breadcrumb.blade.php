@if (count($breadcrumbs))    
    <nav class="flex mb-3" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            @foreach ($breadcrumbs as $breadcrumb)
                <li class="leading-normal {{ !$loop->first ? 'flex items-center' : ''}}" @if ($loop->last) aria-current="page" @endif>
                    @isset($breadcrumb['route'])
                        <i class="{{ !$loop->first ? 'fa-solid fa-angle-right text-gray-400 mx-1' : ''}}"></i>
                        <a href="{{ $breadcrumb['route'] }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white {{ !$loop->first ? 'md:ms-2' : ''}}">
                            {{$breadcrumb['name']}}
                        </a>
                    @else
                        <i class="{{ !$loop->first ? 'fa-solid fa-angle-right text-gray-400 mx-1' : ''}}"></i>
                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400 pointer-events-none {{ !$loop->first ? 'md:ms-2' : ''}}">
                            {{$breadcrumb['name']}}
                        </span>
                    @endisset
                </li>
            @endforeach
        </ol>
    </nav>
@endif
