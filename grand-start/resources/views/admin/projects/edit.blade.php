@extends('admin.layout')

@section('title', 'تعديل مشروع')
@section('page-title', 'تعديل: ' . $project->title_ar)

@section('content')

<div class="d-flex gap-2 mb-4">
    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-right me-1"></i> رجوع
    </a>
    <a href="{{ route('projects.show', $project->slug) }}" target="_blank" class="btn btn-outline-primary btn-sm">
        <i class="fas fa-eye me-1"></i> عرض على الموقع
    </a>
</div>

<form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-4">
        <div class="col-lg-8">

            <div class="form-card">
                <div class="form-card-title"><i class="fas fa-info-circle"></i> المعلومات الأساسية</div>

                <ul class="nav nav-tabs mb-3">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-ar">العربية</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-en">English</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-tr">Türkçe</button></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-ar">
                        <div class="mb-3">
                            <label class="form-label">اسم المشروع (عربي) *</label>
                            <input type="text" name="title_ar" class="form-control" value="{{ old('title_ar', $project->title_ar) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">الوصف (عربي) *</label>
                            <textarea name="description_ar" class="form-control" rows="5" required>{{ old('description_ar', $project->description_ar) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">الموقع (عربي) *</label>
                            <input type="text" name="location_ar" class="form-control" value="{{ old('location_ar', $project->location_ar) }}" required>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-en" dir="ltr">
                        <div class="mb-3">
                            <label class="form-label">Project Name (English)</label>
                            <input type="text" name="title_en" class="form-control" value="{{ old('title_en', $project->title_en) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description (English)</label>
                            <textarea name="description_en" class="form-control" rows="5">{{ old('description_en', $project->description_en) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Location (English)</label>
                            <input type="text" name="location_en" class="form-control" value="{{ old('location_en', $project->location_en) }}">
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-tr" dir="ltr">
                        <div class="mb-3">
                            <label class="form-label">Proje Adı (Türkçe)</label>
                            <input type="text" name="title_tr" class="form-control" value="{{ old('title_tr', $project->title_tr) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Açıklama (Türkçe)</label>
                            <textarea name="description_tr" class="form-control" rows="5">{{ old('description_tr', $project->description_tr) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Konum (Türkçe)</label>
                            <input type="text" name="location_tr" class="form-control" value="{{ old('location_tr', $project->location_tr) }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-card">
                <div class="form-card-title"><i class="fas fa-dollar-sign"></i> التسعير</div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">السعر بالدولار (USD)</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="price_usd" class="form-control" value="{{ old('price_usd', $project->price_usd) }}" min="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">السعر بالليرة التركية (TRY)</label>
                        <div class="input-group">
                            <span class="input-group-text">₺</span>
                            <input type="number" name="price_try" class="form-control" value="{{ old('price_try', $project->price_try) }}" min="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">السعر بالدينار العراقي</label>
                        <div class="input-group">
                            <input type="number" name="price_iqd" class="form-control" value="{{ old('price_iqd', $project->price_iqd) }}" min="0">
                            <span class="input-group-text">د.ع</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-card">
                <div class="form-card-title"><i class="fas fa-info"></i> تفاصيل المشروع</div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">المساحة</label>
                        <input type="text" name="area" class="form-control" value="{{ old('area', $project->area) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">الطوابق</label>
                        <input type="number" name="floors" class="form-control" value="{{ old('floors', $project->floors) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">الوحدات</label>
                        <input type="number" name="units" class="form-control" value="{{ old('units', $project->units) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">تاريخ التسليم</label>
                        <input type="date" name="delivery_date" class="form-control" value="{{ old('delivery_date', $project->delivery_date?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">رابط الفيديو</label>
                        <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $project->video_url) }}">
                    </div>
                </div>
            </div>

            <!-- Features -->
            <div class="form-card">
                <div class="form-card-title"><i class="fas fa-list-check"></i> مميزات المشروع</div>
                <div id="features-container">
                    @foreach($project->features as $i => $feature)
                    <div class="feature-row row g-2 mb-2 align-items-center">
                        <div class="col-md-3">
                            <input type="text" name="features[{{ $i }}][ar]" class="form-control form-control-sm" placeholder="عربي" value="{{ $feature->feature_ar }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="features[{{ $i }}][en]" class="form-control form-control-sm" placeholder="English" value="{{ $feature->feature_en }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="features[{{ $i }}][tr]" class="form-control form-control-sm" placeholder="Türkçe" value="{{ $feature->feature_tr }}">
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="features[{{ $i }}][icon]" class="form-control form-control-sm" placeholder="fas fa-check" value="{{ $feature->icon }}">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-sm btn-outline-danger remove-feature"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" id="addFeature" class="btn btn-sm btn-outline-secondary mt-2">
                    <i class="fas fa-plus me-1"></i> إضافة ميزة
                </button>
            </div>

            <!-- Gallery Images -->
            @if($project->images->count())
            <div class="form-card">
                <div class="form-card-title"><i class="fas fa-images"></i> معرض الصور</div>
                <div class="row g-2 mb-3" id="galleryImages">
                    @foreach($project->images as $image)
                    <div class="col-3 col-md-2" id="image-{{ $image->id }}">
                        <div class="position-relative">
                            <img src="{{ $image->getUrl() }}" alt="" class="img-fluid rounded">
                            <button type="button" onclick="deleteImage({{ $image->id }})"
                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 p-0"
                                    style="width:20px;height:20px;font-size:10px;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Upload More Images -->
            <div class="form-card">
                <div class="form-card-title"><i class="fas fa-upload"></i> رفع صور إضافية</div>
                <input type="file" name="gallery_images[]" class="form-control" multiple accept="image/*" id="galleryInput">
                <small class="text-muted">يمكنك اختيار أكثر من صورة</small>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-card">
                <div class="form-card-title"><i class="fas fa-tag"></i> التصنيف</div>
                <div class="mb-3">
                    <label class="form-label">نوع العقار *</label>
                    <select name="type" class="form-select" required>
                        @foreach(['residential' => 'سكني', 'commercial' => 'تجاري', 'villa' => 'فيلا', 'apartment' => 'شقة', 'compound' => 'مجمع', 'tower' => 'برج'] as $val => $label)
                        <option value="{{ $val }}" {{ old('type', $project->type) === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">الحالة *</label>
                    <select name="status" class="form-select" required>
                        @foreach(['available' => 'متاح', 'under_construction' => 'قيد الإنشاء', 'coming_soon' => 'قريباً', 'sold_out' => 'مباع'] as $val => $label)
                        <option value="{{ $val }}" {{ old('status', $project->status) === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">ترتيب العرض</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $project->sort_order) }}">
                </div>
                <div class="form-check form-switch mb-2">
                    <input type="checkbox" class="form-check-input" name="active" id="active" value="1"
                           {{ old('active', $project->active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">نشط</label>
                </div>
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="featured" id="featured" value="1"
                           {{ old('featured', $project->featured) ? 'checked' : '' }}>
                    <label class="form-check-label" for="featured">مميز</label>
                </div>
            </div>

            <div class="form-card">
                <div class="form-card-title"><i class="fas fa-image"></i> الصورة الرئيسية</div>
                @if($project->main_image)
                <img src="{{ asset('uploads/' . $project->main_image) }}" alt="" class="img-fluid rounded mb-2">
                @endif
                <div class="upload-area" id="uploadArea">
                    <div class="upload-placeholder text-center py-2">
                        <i class="fas fa-cloud-upload-alt text-muted mb-1 d-block"></i>
                        <small class="text-muted">تغيير الصورة</small>
                    </div>
                    <img id="imagePreview" src="" style="display:none; max-width:100%; border-radius:8px;">
                    <input type="file" name="main_image" id="mainImageInput" class="d-none" accept="image/*">
                </div>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-gold btn-lg">
                    <i class="fas fa-save me-2"></i>حفظ التغييرات
                </button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">إلغاء</a>
            </div>
        </div>
    </div>
</form>

@endsection

@push('styles')
<style>
.upload-area { border: 2px dashed #dee2e6; border-radius: 8px; cursor: pointer; overflow: hidden; }
.upload-area:hover { border-color: var(--gold); }
.nav-tabs .nav-link.active { color: var(--gold); font-weight: 600; }
</style>
@endpush

@push('scripts')
<script>
// Image preview
const uploadArea = document.getElementById('uploadArea');
const mainImageInput = document.getElementById('mainImageInput');
const imagePreview = document.getElementById('imagePreview');
uploadArea.addEventListener('click', () => mainImageInput.click());
mainImageInput.addEventListener('change', function() {
    if (this.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
            uploadArea.querySelector('.upload-placeholder').style.display = 'none';
        };
        reader.readAsDataURL(this.files[0]);
    }
});

// Delete gallery image
function deleteImage(id) {
    if (!confirm('حذف هذه الصورة؟')) return;
    fetch(`/admin/projects/{{ $project->id }}/images/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            const el = document.getElementById(`image-${id}`);
            if (el) el.remove();
        }
    });
}

// Add Feature
let featureCount = {{ $project->features->count() }};
document.getElementById('addFeature').addEventListener('click', function() {
    const container = document.getElementById('features-container');
    const row = document.createElement('div');
    row.className = 'feature-row row g-2 mb-2 align-items-center';
    row.innerHTML = `
        <div class="col-md-3"><input type="text" name="features[${featureCount}][ar]" class="form-control form-control-sm" placeholder="عربي"></div>
        <div class="col-md-3"><input type="text" name="features[${featureCount}][en]" class="form-control form-control-sm" placeholder="English"></div>
        <div class="col-md-3"><input type="text" name="features[${featureCount}][tr]" class="form-control form-control-sm" placeholder="Türkçe"></div>
        <div class="col-md-2"><input type="text" name="features[${featureCount}][icon]" class="form-control form-control-sm" placeholder="fas fa-check" value="fas fa-check"></div>
        <div class="col-md-1"><button type="button" class="btn btn-sm btn-outline-danger remove-feature"><i class="fas fa-times"></i></button></div>
    `;
    container.appendChild(row);
    featureCount++;
    bindRemove();
});

function bindRemove() {
    document.querySelectorAll('.remove-feature').forEach(btn => {
        btn.onclick = function() { this.closest('.feature-row').remove(); };
    });
}
bindRemove();
</script>
@endpush
