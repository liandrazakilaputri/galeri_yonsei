<div class="col-md-4 col-sm-6 mb-3">
    <div class="card border-0 shadow-sm h-100 gallery-card position-relative overflow-hidden">
        <!-- Lightbox -->
        <a href="{{ asset('storage/' . $f->gambar) }}" class="glightbox" data-gallery="home">
            <div class="overflow-hidden rounded-top" style="height: 250px;">
                <img src="{{ asset('storage/' . $f->gambar) }}" 
                     class="card-img-top gallery-img w-100 h-100" 
                     alt="{{ $f->judul }}">
            </div>
        </a>

        <!-- Info -->
        <div class="card-body text-center">
            <h6 class="fw-bold mb-1 gallery-title">{{ $f->judul }}</h6>
            <small class="text-muted">{{ $f->kategori->nama ?? 'Tanpa Kategori' }}</small>

            <!-- Rating -->
            <div class="rating mt-2" data-id="{{ $f->id }}">
                @for($i=1; $i<=5; $i++)
                    <i class="bi star-btn {{ $i <= round($f->averageRating()) ? 'bi-star-fill text-warning' : 'bi-star' }}" 
                       data-value="{{ $i }}"></i>
                @endfor
                <small class="ms-1 avg-rating">{{ round($f->averageRating(), 2) }}</small>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.gallery-card {
    border-radius: 15px;
    transition: all 0.35s ease;
    overflow: hidden;
    background: #fff;
}
.gallery-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}
.gallery-img {
    transition: transform 0.6s ease;
    object-fit: cover;
}
.gallery-card:hover .gallery-img {
    transform: scale(1.08);
}
.gallery-title {
    transition: color 0.3s ease;
}
.gallery-card:hover .gallery-title {
    color: #0d6efd;
}
.star-btn {
    cursor: pointer;
    font-size: 1.1rem;
    transition: transform 0.2s ease, color 0.2s ease;
}
.star-btn:hover {
    transform: scale(1.2);
    color: #ffc107 !important;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // GLightbox Init
    if (typeof GLightbox !== 'undefined') {
        GLightbox({ selector: '.glightbox' });
    }

    // Rating AJAX Handler
    document.querySelectorAll('.rating').forEach(ratingEl => {
        ratingEl.querySelectorAll('.star-btn').forEach(star => {
            star.addEventListener('click', () => {
                const value = star.dataset.value;
                const fotoId = ratingEl.dataset.id;

                fetch(`/home/rating/${fotoId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ rating: value })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.average !== undefined) {
                        const avg = data.average;
                        ratingEl.querySelector('.avg-rating').innerText = avg.toFixed(2);

                        ratingEl.querySelectorAll('.star-btn').forEach((s, idx) => {
                            if (idx < Math.round(avg)) {
                                s.classList.add('text-warning', 'bi-star-fill');
                                s.classList.remove('bi-star');
                            } else {
                                s.classList.remove('text-warning', 'bi-star-fill');
                                s.classList.add('bi-star');
                            }
                        });
                    }
                })
                .catch(err => console.error(err));
            });
        });
    });
});
</script>
@endpush
