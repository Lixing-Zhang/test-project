{{--
-- Important note:
--
-- This template is based on an example from Tailwind UI, and is used here with permission from Tailwind Labs
-- for educational purposes only. Please do not use this template in your own projects without purchasing a
-- Tailwind UI license, or they’ll have to tighten up the licensing and you’ll ruin the fun for everyone.
--
-- Purchase here: https://tailwindui.com/
--}}

@props([
    'leadingAddOn' => false,
    'trailingAddOn' => false
])

<div class="flex shadow-sm w-full">
    @if ($leadingAddOn)
        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
            {!! $leadingAddOn !!}
        </span>
    @endif

    <input {{ $attributes->merge(['type' => 'text', 'class' => 'flex-1 form-input border-gray-300 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 ' . ($leadingAddOn ? ' rounded-r-md' : '') . ($trailingAddOn ? ' rounded-l-md' : '') . ($leadingAddOn || $trailingAddOn ? ' rounded-none' : ' rounded-md')]) }}/>

    @if ($trailingAddOn)
        <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
            {!! $trailingAddOn !!}
        </span>
    @endif
</div>
