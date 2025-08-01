 @props(['active' => false])
{{-- 
 <a {{ $attributes }}
   class="{{ $active ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium text-white" aria-current="{{  $active ? 'page' : false }}">{{ $slot }}</a> --}}
<li>
 <a  {{ $attributes }} 
     class="px-3 py-2 {{ $active ?  'text-blue-600' : ''}} border-b border-gray-100 text-gray-900block hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-blue-500 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700"
     aria-current="{{  $active ? 'page' : false }}">{{ $slot }}</a>
</li>