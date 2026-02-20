@php
    $record = $getRecord();
    $firstLetter = strtoupper(substr($record->firstname, 0, 1));
    $fullName = $record->firstname . ' ' . $record->middlename . ' ' . $record->lastname;
@endphp

<div style="
    display: flex;
    align-items: center;
    gap: 1.25rem;
    background: linear-gradient(135deg, #1e40af, #3b82f6);
    border-radius: 16px;
    padding: 1.75rem 2rem;
    color: white;
    margin-bottom: 0.5rem;
">
    {{-- Avatar Circle --}}
    <div style="
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 700;
        color: white;
        border: 3px solid rgba(255, 255, 255, 0.5);
        flex-shrink: 0;
    ">
        {{ $firstLetter }}
    </div>

    {{-- Name + Info --}}
    <div>
        <div style="font-size: 1.35rem; font-weight: 700; letter-spacing: 0.01em;">
            {{ $fullName }}
        </div>
        <div style="font-size: 0.85rem; opacity: 0.85; margin-top: 0.25rem;">
            {{ ucfirst($record->sex) }} &bull; {{ ucfirst($record->civil_status) }} &bull; {{ $record->nationality }}
        </div>
    </div>
</div>