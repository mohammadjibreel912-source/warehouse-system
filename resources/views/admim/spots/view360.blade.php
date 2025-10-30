@extends('admim.index')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">360° View</h4>

    @if($imageUrl)
        <div id="viewer" data-image="{{ $imageUrl }}" style="width: 100%; height: 500px; border: 1px solid #ccc;"></div>
    @else
        <p>No 360° image available.</p>
    @endif
</div>

<!-- Dependencies via CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@photo-sphere-viewer/core/index.min.css" />
<script src="https://cdn.jsdelivr.net/npm/three/build/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@photo-sphere-viewer/core/index.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('viewer');
    if (!container) return console.error('Viewer container not found.');

    const imageUrl = container.dataset.image;
    if (!imageUrl) return console.error('Image URL is missing.');

    // إنشاء الـ 360° viewer
    const viewer = new PhotoSphereViewer.Viewer({
        container: container,
        panorama: imageUrl,
        navbar: true,
        defaultLong: 0,
        defaultLat: 0,
        loadingImg: '', // يمكنك وضع صورة تحميل هنا إذا أحببت
    });

    // بدء الدوران التلقائي بسرعة 1 دورة/دقيقة
    viewer.startAutorotate(1);
});
</script>
@endsection
