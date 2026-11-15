{{-- start footer --}}
<footer class="footer-noona">
    <div class="container">
        <div class="row g-4">

            {{-- Kolom 1: logo dan slogan --}}
            <div class="col-lg-4">
                <a href="{{ route('beranda') }}" class="logo-noona mb-3">
                    <img src="{{ asset('images/logo-emblem.svg') }}" alt="Logo Noona" width="36" height="36">
                    <span class="logo-teks">
                        <span class="logo-nama">Noona</span>
                        <span class="logo-sub">Salon by Cortis</span>
                    </span>
                </a>
                <p>Ruang tenang untuk merawat diri.<br>Cantik dengan cara Anda sendiri.</p>
            </div>

            {{-- Kolom 2: alamat --}}
            <div class="col-lg-4">
                <h6>Kunjungi Noona</h6>
                <p>Jl. Geso 6, Umban Sari Atas<br>Rumbai, 28265</p>
                <p>WhatsApp &middot; 0812-3456-7890<br>noonasalon@gmail.com</p>
            </div>

            {{-- Kolom 3: jam buka --}}
            <div class="col-lg-4">
                <h6>Waktu untuk Anda</h6>
                <p>Senin-Sabtu &middot; 09.00-19.00<br>Minggu &middot; 10.00-17.00</p>
                <p>Reservasi terakhir 60 menit sebelum tutup.</p>
            </div>
        </div>

        <div class="footer-garis">&copy; {{ date('Y') }} Noona Salon by Cortis. Seluruh hak cipta dilindungi.</div>
    </div>
</footer>
{{-- end footer --}}
