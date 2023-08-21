{{-- merge css class like clsx--}}
<div {{ $attributes->merge(['class' => 'bg-gray-100 border border-gray-200 rounded p-6']) }}>
    {{ $slot }} {{-- worked like children in react --}}
</div>
