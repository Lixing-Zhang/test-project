{{--
-- Important note:
--
-- This template is based on an example from Tailwind UI, and is used here with permission from Tailwind Labs
-- for educational purposes only. Please do not use this template in your own projects without purchasing a
-- Tailwind UI license, or they’ll have to tighten up the licensing and you’ll ruin the fun for everyone.
--
-- Purchase here: https://tailwindui.com/
--}}

<div class="flex py-2">
    <input
        {{ $attributes->merge(['class' => 'form-checkbox border-gray-300 block transition duration-150 ease-in-out sm:text-sm sm:leading-5 rounded-sm']) }}
        type="checkbox"
    />
</div>
