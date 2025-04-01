<x-guest-layout>
    <div class="container">
        <h2>Create New Fee</h2>
        <form x-data="feeForm()" @submit.prevent="submitForm">
            @csrf

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

            <!-- Category -->
            <div class="mb-3">
                <x-choices
                    :options="$categories"
                    label="Category"
                    name="category_id"
                    x_model="form.category_id"
                    formContext="true"
                />
            </div>

            <!-- Level -->
            <div class="mb-3">
                <x-choices
                    :options="$levels"
                    label="level"
                    name="level_id"
                    x_model="form.level_id"
                    formContext="true"
                />
            </div>

            <!-- Entry Mode -->
            <div class="mb-3">
                <x-choices
                    :options="$entry_modes"
                    label="Entry Mode"
                    name="entry_mode_id"
                    x_model="form.entry_mode_id"
                    formContext="true"
                />
            </div>

            <!-- Amount -->
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
            <button type="submit" class="btn btn-primary w-[20%] h-11 rounded-full text-white bg-zinc-900 cursor-pointer hover:bg-blue-700">Create Fee</button>
        </form>
    </div>
    
    <script>
        function feeForm() {
            return {
                form: {
                    name: '',
                    description: '',
                    amount: '',
                    payment_start_date: '',
                    payment_close_date: '',
                },
                errors: {},
                async validateField(field) {
                    try {
                        const response = await fetch('{{ route('fees.store') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Precognition': 'true', 
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({ [field]: this.form[field] }),
                        });

                        if (response.ok) {
                            this.errors[field] = null; 
                        } else {
                            const data = await response.json();
                            this.errors[field] = data.errors[field]?.[0] || 'Invalid input';
                        }
                    } catch (error) {
                        console.error('Validation error:', error);
                    }
                },
                async submitForm() {
                    console.log(this.form); 
                    try {
                        const response = await fetch('{{ route('fees.store') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify(this.form),
                        });

                        if (response.ok) {
                            console.log('Form submitted successfully');
                            alert('Fee created successfully!');
                            window.location.href = '{{ route('fees.index') }}'; 
                        } else {
                            const data = await response.json();
                            this.errors = data.errors || {};
                        }
                    } catch (error) {
                        console.error('Submission error:', error);
                    }
                },
            };
        }
    </script>
</x-guest-layout>
    