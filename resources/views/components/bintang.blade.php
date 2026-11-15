{{--
    BLADE COMPONENT: <x-bintang :rating="4" />
    Menampilkan rating 1-5 dalam bentuk bintang.
--}}
@props(['rating' => 0])

<span class="bintang" aria-label="Rating {{ $rating }} dari 5">
    @for ($i = 1; $i <= 5; $i++)
        <span class="{{ $i <= $rating ? 'bintang-penuh' : 'bintang-kosong' }}">&#9733;</span>
    @endfor
</span>
