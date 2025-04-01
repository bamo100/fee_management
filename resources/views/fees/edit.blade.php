<x-guest-layout>
    <div class="container">
        <h2>Edit Fee</h2>
        <form x-data='feeForm(@json($fee))' @submit.prevent="submitForm">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-3">
                <x-input
                    label="Name"
                    type="text"
                    id="amount"
                    model="form.name"
                    validation="validateField"
                    errorKey="name"
                />
            </div>

            <!-- Description -->
            <div class="mb-3">
                <x-textarea-input
                    label="Description"
                    id="description"
                    model="form.description"
                    validation="validateField"
                    errorKey="description"
                    rows="5"
                />
            </div>

            <!-- Academic Session -->
            <div class="mb-3">
                <x-choices
                    :options="$academic_sessions"
                    label="Academic Session"
                    name="academic_session_id"
                    x_model="form.academic_session_id"
                    formContext="true"
                />
            </div>

            <!-- Department -->
            <div class="mb-3">
                <x-choices
                    :options="$departments"
                    label="Department"
                    name="department_id"
                    x_model="form.department_id"
                    formContext="true"
                />
            </div>

            <!-- Faculty -->
            <div class="mb-3">
                <x-choices
                    :options="$faculties"
                    label="Faculty"
                    name="faculty_id"
                    x_model="form.faculty_id"
                    formContext="true"
                />
            </div>

            <div class="mb-3">
                <x-input
                    label="Amount"
                    type="number"
                    id="amount"
                    model="form.amount"
                    validation="validateField"
                    errorKey="amount"
                />
            </div>

            <!-- Payment Start Date -->
            <div class="mb-3">
                <x-flatpickr
                    label="Payment Start Date"
                    name="payment_start_date"
                    x_model="form.payment_start_date"
                    formContext="true"
                />
            </div>

            <!-- Payment Close Date -->
            <div class="mb-3">
                <x-flatpickr
                    label="Payment Close Date"
                    name="payment_close_date"
                    x_model="form.payment_close_date"
                    formContext="true"
                />
            </div>

            <!-- Submit Button -->
            <div class="mb-3">
                <button type="submit" :disabled="form.processing" class="w-[20%] h-11 rounded-full text-white bg-zinc-900 cursor-pointer hover:bg-green-700">Update Fee</button>
            </div>
    </div>
    <script>
        function feeForm(initialData) {
            return {
                form: {
                    name: initialData.name || '',
                    description: initialData.description || '',
                    amount: initialData.amount || '',
                    payment_start_date: initialData.payment_start_date || '',
                    payment_close_date: initialData.payment_close_date || '',
                },
                errors: {},
                processing: false,
                validateField(field) {
                    // Implement your field validation logic here
                    console.log(`Validating field: ${field}`);
                    // For example:
                    if (!this.form[field]) {
                        this.errors[field] = 'This field is required.';
                    } else {
                        delete this.errors[field];
                    }
                },
                async submitForm() {
                    this.processing = true;
                    try {
                        const response = await fetch('{{ route('fees.update', $fee->id) }}', {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify(this.form),
                        });
    
                        if (response.ok) {
                            alert('Fee updated successfully!');
                            window.location.href = '{{ route('fees.index') }}';
                        } else {
                            const data = await response.json();
                            this.errors = data.errors || {};
                            alert('Please fix the errors and try again.');
                        }
                    } catch (error) {
                        console.error('Submission error:', error);
                        alert('An unexpected error occurred.');
                    } finally {
                        this.processing = false;
                    }
                },
            };
        }
    </script>
    
</x-guest-layout>