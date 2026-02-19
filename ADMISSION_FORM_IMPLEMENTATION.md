# Admission Form Implementation - User Workflow

## Overview
You now have a complete admission form workflow with the following steps:

1. **Search and Select Patient** - User searches for a patient by name in a searchable dropdown
2. **Choose Form Type** - User selects between two form types:
   - **Admission Consent Form** - For recording patient consent
   - **Admission and Discharge Form** - For recording full admission and discharge details

## How It Works

### Step 1: Patient Selection
- When creating a new admission, a searchable select field appears at the top
- The field searches through patient names in real-time
- User can type to filter and click to select a patient

### Step 2: Form Type Selection  
- After selecting a patient, user chooses which form type they want to fill
- Two options:
  - **Admission Consent Form** - Contains consent-specific fields
  - **Admission and Discharge Form** - Contains admission and discharge fields

### Step 3: Dynamic Form Fields
The form dynamically shows different fields based on the selected form type:

#### Admission Consent Form Fields:
- Patient (searchable select)
- Form Type (select)
- Consent Details (textarea)
- Consent Given (checkbox)
- Date of Consent (date picker)
- Consent Given By (text input)
- Relationship to Patient (text input)
- Special Instructions/Notes (textarea)

#### Admission and Discharge Form Fields:
- Patient (searchable select)
- Form Type (select)
- Date & Time Admitted (datetime picker)
- Stage of Labor (select: First/Second/Third Stage)
- Hemoglobin Level (numeric input)
- RPR Test (checkbox)
- HIV Test (checkbox)
- Date & Time Discharged (datetime picker)
- Discharge Status (select: Normal/Cesarean/Assisted/Referred/AMA)
- Baby Status (select: Live Birth/Stillbirth/Multiple Birth)
- Baby Weight (numeric input in kg)
- Discharge Notes (textarea)
- Follow-up Instructions (textarea)

## Files Modified/Created

### New Files:
1. `app/Filament/Resources/Admissions/Schemas/AdmissionConsentForm.php` - Consent form schema
2. `app/Filament/Resources/Admissions/Schemas/AdmissionDischargeForm.php` - Admission/Discharge form schema
3. `database/migrations/2026_02_18_150000_add_admission_form_fields.php` - Database migration

### Updated Files:
1. `app/Filament/Resources/Admissions/Schemas/AdmissionForm.php` - Base form with patient and form type selection
2. `app/Filament/Resources/Admissions/Pages/CreateAdmission.php` - Form rendering logic
3. `app/Models/Admission.php` - Added new fields and relationships
4. `app/Models/Patient.php` - Added user() helper method

## Database Changes
The admissions table now includes new columns for:
- form_type (enum: admission_consent, admission_discharge)
- Consent fields: consent_details, consent_given, consent_date, consent_by, consent_relationship, special_instructions
- Discharge fields: date_time_discharged, discharge_status, baby_status, baby_weight, discharge_notes, follow_up_instructions

## How to Use

1. Navigate to the Admissions module in Filament
2. Click "Create Admission"
3. Search for and select a patient from the dropdown
4. Choose between "Admission Consent Form" or "Admission and Discharge Form"
5. Fill in the appropriate fields for your selected form type
6. Save the admission record

The form will automatically show/hide fields based on your form type selection.
