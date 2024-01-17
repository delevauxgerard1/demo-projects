@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-input w-full dark:text-black dark:bg-white dark:border-slate-200']) !!}>
