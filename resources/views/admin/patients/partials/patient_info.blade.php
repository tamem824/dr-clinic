<p><strong>Name:</strong> {{ $patient->name ?? 'No Name' }}</p>
<p><strong>National ID:</strong> {{ $patient->national_id ?? 'No ID' }}</p>
<p><strong>Age:</strong> {{ $patient->age ?? 'No Age' }}</p>

@if($lastEndoscopy)
    <hr>
    <p><strong>Last Performed:</strong> {{ $lastEndoscopy->performed_at ?? 'No Date' }}</p>
    <p><strong>Last Diagnosis:</strong> {{ $lastEndoscopy->notes ?? 'No Notes' }}</p>
@else
    <p>No endoscopy records found.</p>
@endif
