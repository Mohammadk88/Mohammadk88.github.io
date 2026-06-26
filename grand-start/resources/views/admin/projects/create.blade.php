@extends('admin.layout')

@section('title', 'إضافة مشروع')
@section('page-title', 'إضافة مشروع جديد')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-right me-1"></i> رجوع
    </a>
</div>

<form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row g-4">
        <div class="col-lg-8">

            <!-- Basic Info -->
            <div class="form-card">
                <div class="form-card-title"><i class="fas fa-info-circle"></i> المعلومات الأساسية</div>

                <!-- Tabs for Languages -->
                <ul class="nav nav-tabs mb-3" id="langTabs">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-ar">العربية</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-en">English</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-ku">کوردی</button></li>
                </ul>

                <div class="tab-content">
                    <!-- Arabic -->
                    <div class="tab-pane fade show active" id="tab-ar">
                        <div class="mb-3">
                            <label class="form-label">اسم المشروع (عربي) <span class="text-danger">*</span></label>
                            <input type="text" name="title_ar" class="form-control" value="{{ old('title_ar') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">الوصف (عربي) <span class="text-danger">*</span></label>
                            <textarea name="description_ar" class="form-control" rows="5" required>{{ old('description_ar') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">الموقع (عربي) <span class="text-danger">*</span></label>
                            <input type="text" name="location_ar" class="form-control" value="{{ old('location_ar') }}" required>
                        </div>
                    </div>

                    <!-- English -->
                    <div class="tab-pane fade" id="tab-en" dir="ltr">
                        <div class="mb-3">
                            <label class="form-label">Project Name (English)</label>
                            <input type="text" name="title_en" class="form-control" value="{{ old('title_en') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description (English)</label>
                            <textarea name="description_en" class="form-control" rows="5">{{ old('description_en') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Location (English)</label>
                            <input type="text" name="location_en" class="form-control" value="{{ old('location_en') }}">
                        </div>
                    </div>

                    <!-- Kurdish -->
                    <div class="tab-pane fade" id="tab-ku">
                        <div class="mb-3">
                            <label class="form-label">ناوی پرۆژە (کوردی)</label>
                            <input type="text" name="title_ku" class="form-control" value="{{ old('title_ku') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">وەسف (کوردی)</label>
                            <textarea name="description_ku" class="form-control" rows="5">{{ old('description_ku') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">شوێن (کوردی)</label>
                            <input type="text" name="location_ku" class="form-control" value="{{ old('location_ku') }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pricing -->
            <div class="form-card">
                <div class="form-card-title"><i class="fas fa-dollar-sign"></i> التسعير</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">السعر بالدولار (USD)</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="price_usd" class="form-control" value="{{ old('price_usd') }}" min="0" step="0.01">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">السعر بالدينار العراقي (IQD)</label>
                        <div class="input-group">
                            <input type="number" name="price_iqd" class="form-control" value="{{ old('price_iqd') }}" min="0">
                            <span class="input-group-text">د.ع</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Details -->
            <div class="form-card">
                <div class="form-card-title"><i class="fas fa-info"></i> تفاصيل المشروع</div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">المساحة</label>
                        <input type="text" name="area" class="form-control" value="{{ old('area') }}" placeholder="مثال: 120-350 م²">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">عدد الطوابق</label>
                        <input type="number" name="floors" class="form-control" value="{{ old('floors') }}" min="1">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">عدد الوحدات</label>
                        <input type="number" name="units" class="form-control" value="{{ old('units') }}" min="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">تاريخ التسليم</label>
                        <input type="date" name="delivery_date" class="form-control" value="{{ old('delivery_date') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">رابط الفيديو</label>
                        <input type="url" name="video_url" class="form-control" value="{{ old('video_url') }}" placeholder="https://youtube.com/...">
                    </div>
                </div>
            </div>

            <!-- Features -->
            <div class="form-card">
                <div class="form-card-title"><i class="fas fa-list-check"></i> مميزات المشروع</div>
                <div id="features-container">
                    @if(old('features'))
                        @foreach(old('features') as $i => $feat)
                        <div class="feature-row row g-2 mb-2 align-items-center">
                            <div class="col-md-4">
                                <input type="text" name="features[{{ $i }}][ar]" class="form-control form-control-sm"
                                       placeholder="الميزة بالعربية" value="{{ $feat['ar'] ?? '' }}">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="features[{{ $i }}][en]" class="form-control form-control-sm"
                                       placeholder="Feature in English" value="{{ $feat['en'] ?? '' }}">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="features[{{ $i }}][icon]" class="form-control form-control-sm"
                                       placeholder="fas fa-check" value="{{ $feat['icon'] ?? 'fas fa-check' }}">
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-sm btn-outline-danger remove-feature">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    @else
                    <div class="feature-row row g-2 mb-2 align-items-center">
                        <div class="col-md-4">
                            <input type="text" name="features[0][ar]" class="form-control form-control-sm" placeholder="الميزة بالعربية">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="features[0][en]" class="form-control form-control-sm" placeholder="Feature in English">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="features[0][icon]" class="form-control form-control-sm" placeholder="fas fa-check" value="fas fa-check">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-sm btn-outline-danger remove-feature"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    @endif
                </div>
                <button type="button" id="addFeature" class="btn btn-sm btn-outline-secondary mt-2">
                    <i class="fas fa-plus me-1"></i> إضافة ميزة
                </button>
            </div>
        </div>

        <div class="col-lg-4">

            <!-- Status & Type -->
            <div class="form-card">
                <div class="form-card-title"><i class="fas fa-tag"></i> التصنيف</div>
                <div class="mb-3">
                    <label class="form-label">نوع العقار <span class="text-danger">*</span></label>
                    <select name="type" class="form-select" required>
                        @foreach(['residential' => 'سكني', 'commercial' => 'تجاري', 'villa' => 'فيلا', 'apartment' => 'شقة', 'compound' => 'مجمع سكني', 'tower' => 'برج'] as $val => $label)
                        <option value="{{ $val }}" {{ old('type') === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">الحالة <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        @foreach(['available' => 'متاح', 'under_construction' => 'قيد الإنشاء', 'coming_soon' => 'قريباً', 'sold_out' => 'مباع بالكامل'] as $val => $label)
                        <option value="{{ $val }}" {{ old('status', 'available') === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">ترتيب العرض</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
                </div>
                <div class="form-check form-switch mb-2">
                    <input type="checkbox" class="form-check-input" name="active" id="active" value="1"
                           {{ old('active', '1') ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">نشط (مرئي على الموقع)</label>
                </div>
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" name="featured" id="featured" value="1"
                           {{ old('featured') ? 'checked' : '' }}>
                    <label class="form-check-label" for="featured">مشروع مميز</label>
                </div>
            </div>

            <!-- Main Image -->
            <div class="form-card">
                <div class="form-card-title"><i class="fas fa-image"></i> الصورة الرئيسية</div>
                <div class="upload-area" id="uploadArea">
                    <div class="upload-placeholder text-center py-3">
                        <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0 small">انقر لاختيار صورة</p>
                        <p class="text-muted small">JPG, PNG, WEBP | Max 5MB</p>
                    </div>
                    <img id="imagePreview" src="" alt="" style="display:none; max-width:100%; border-radius:8px;">
                    <input type="file" name="main_image" id="mainImageInput" class="d-none" accept="image/*">
                </div>
            </div>

            <!-- Location -->
            <div class="form-card">
                <div class="form-card-title"><i class="fas fa-map-marker-alt"></i> الإحداثيات (اختياري)</div>
                <div class="row g-2">
                    <div class="col-6">
                        <label class="form-label small">خط العرض</label>
                        <input type="number" name="latitude" class="form-control form-control-sm" step="0.0000001" value="{{ old('latitude') }}">
                    </div>
                    <div class="col-6">
                        <label class="form-label small">خط الطول</label>
                        <input type="number" name="longitude" class="form-control form-control-sm" step="0.0000001" value="{{ old('longitude') }}">
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-gold btn-lg">
                    <i class="fas fa-save me-2"></i> حفظ المشروع
                </button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">إلغاء</a>
            </div>
        </div>
    </div>
</form>

@endsection

@push('styles')
<style>
.upload-area {
    border: 2px dashed #dee2e6;
    border-radius: 8px;
    cursor: pointer;
    transition: border-color 0.2s;
    overflow: hidden;
}
.upload-area:hover { border-color: var(--gold); }
.nav-tabs .nav-link.active { color: var(--gold); border-bottom-color: var(--gold); font-weight: 600; }
</style>
@endpush

@push('scripts')
<script>
// Image Preview
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

// Add Feature Row
let featureCount = document.querySelectorAll('.feature-row').length;
document.getElementById('addFeature').addEventListener('click', function() {
    const container = document.getElementById('features-container');
    const row = document.createElement('div');
    row.className = 'feature-row row g-2 mb-2 align-items-center';
    row.innerHTML = `
        <div class="col-md-4"><input type="text" name="features[${featureCount}][ar]" class="form-control form-control-sm" placeholder="الميزة بالعربية"></div>
        <div class="col-md-4"><input type="text" name="features[${featureCount}][en]" class="form-control form-control-sm" placeholder="Feature in English"></div>
        <div class="col-md-3"><input type="text" name="features[${featureCount}][icon]" class="form-control form-control-sm" placeholder="fas fa-check" value="fas fa-check"></div>
        <div class="col-md-1"><button type="button" class="btn btn-sm btn-outline-danger remove-feature"><i class="fas fa-times"></i></button></div>
    `;
    container.appendChild(row);
    featureCount++;
    bindRemoveFeature();
});

function bindRemoveFeature() {
    document.querySelectorAll('.remove-feature').forEach(btn => {
        btn.onclick = function() { this.closest('.feature-row').remove(); };
    });
}
bindRemoveFeature();
</script>
@endpush
