{{--
    BLADE COMPONENT: <x-alert>
    Cara pakai: <x-alert type="success">Pesan di sini</x-alert>
    type: success, danger, warning, info (nama class alert Bootstrap)
--}}
@props(['type' => 'success'])

<div {{ $attributes->merge(['class' => 'alert alert-' . $type . ' alert-dismissible fade show']) }} role="alert">
    {{ $slot }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
