<link rel="stylesheet" href="{{ asset('css/patients/view-modal.css') }}">

<div class="patient-card">

    {{-- Header / Avatar --}}
    <div class="patient-card__header">
        <div class="patient-card__avatar">
            {{ substr($record->user?->firstname ?? 'P', 0, 1) }}
        </div>
        <div>
            <h2 class="patient-card__name">
                {{ trim(($record->user?->firstname ?? '') . ' ' . ($record->user?->middlename ?? '') . ' ' . ($record->user?->lastname ?? '')) }}
            </h2>
            <span class="patient-card__badge">Patient</span>
        </div>
    </div>

    <hr class="patient-card__divider">

    {{-- Personal Information --}}
    <div>
        <h3 class="patient-card__section-title">Personal Information</h3>
        <div class="patient-card__grid">
            <div>
                <p class="patient-card__field-label">Contact Number</p>
                <p class="patient-card__field-value">{{ $record->user?->contact_num ?? '—' }}</p>
            </div>
            <div>
                <p class="patient-card__field-label">Sex</p>
                <p class="patient-card__field-value">{{ $record->sex ?? '—' }}</p>
            </div>
            <div>
                <p class="patient-card__field-label">Birth Date</p>
                <p class="patient-card__field-value">{{ $record->birth_date ? \Carbon\Carbon::parse($record->birth_date)->format('F d, Y') : '—' }}</p>
            </div>
            <div>
                <p class="patient-card__field-label">Birth Place</p>
                <p class="patient-card__field-value">{{ $record->birth_place ?? '—' }}</p>
            </div>
            <div>
                <p class="patient-card__field-label">Civil Status</p>
                <p class="patient-card__field-value">{{ $record->civil_status ?? '—' }}</p>
            </div>
            <div>
                <p class="patient-card__field-label">Religion</p>
                <p class="patient-card__field-value">{{ $record->religion ?? '—' }}</p>
            </div>
            <div>
                <p class="patient-card__field-label">Nationality</p>
                <p class="patient-card__field-value">{{ $record->nationality ?? '—' }}</p>
            </div>
            <div>
                <p class="patient-card__field-label">Blood Type</p>
                <p class="patient-card__field-value">{{ $record->blood_type ?? '—' }}</p>
            </div>
        </div>
    </div>

    <hr class="patient-card__divider">

    {{-- Address & Health --}}
    <div>
        <h3 class="patient-card__section-title">Address & Health</h3>
        <div class="patient-card__grid">
            <div class="patient-card__full-width">
                <p class="patient-card__field-label">Address</p>
                <p class="patient-card__field-value">{{ $record->address ?? '—' }}</p>
            </div>
            <div>
                <p class="patient-card__field-label">PhilHealth Number</p>
                <p class="patient-card__field-value">{{ $record->philhealth_number ?? '—' }}</p>
            </div>
            <div>
                <p class="patient-card__field-label">Allergies</p>
                <p class="patient-card__field-value">{{ $record->allergies ?? '—' }}</p>
            </div>
        </div>
    </div>

    <hr class="patient-card__divider">

    {{-- Emergency Contact --}}
    <div>
        <h3 class="patient-card__section-title">Emergency Contact</h3>
        <div class="patient-card__grid">
            <div>
                <p class="patient-card__field-label">Name</p>
                <p class="patient-card__field-value">{{ $record->spouse_name ?? '—' }}</p>
            </div>
            <div>
                <p class="patient-card__field-label">Contact Number</p>
                <p class="patient-card__field-value">{{ $record->spouse_contact_number ?? '—' }}</p>
            </div>
        </div>
    </div>

</div>