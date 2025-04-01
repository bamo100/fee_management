<x-guest-layout>
    <div class="container">
        <h2>Edit Fee</h2>
        <form x-data='feeForm(@json($fee))' @submit.prevent="submitForm">
            @csrf
            {{-- @method('PUT') --}}

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

            <button 
                type="submit" 
                :disabled="processing" 
                :class="processing ? 'bg-gray-400 cursor-not-allowed' : 'bg-green-700 hover:bg-green-800 cursor-pointer'" 
                class="w-[20%] h-11 rounded-full text-white"
            >
                Update Fee
            </button>

    </div>
    <script>
        function feeForm(initialData) {
            console.log("update fee form");
            return {
                form: {
                    name: initialData.name || '',
                    description: initialData.description || '',
                    amount: initialData.amount || '',
                    payment_start_date: initialData.payment_start_date || '',
                    payment_close_date: initialData.payment_close_date || '',
                    academic_session_id: initialData.academic_session_id || '',
                    department_id: initialData.department_id || '',
                    faculty_id: initialData.faculty_id || '',
                    category_id: initialData.category_id || '',
                    level_id: initialData.level_id || '',
                    entry_mode_id: initialData.entry_mode_id || '',
                },
                errors: {},
                processing: false,
                async validateField(field) {
                    try {
                        const response = await fetch(`{{ route('fees.update', $fee->id) }}`, {
                            method: 'PUT', 
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
                // async submitForm() {
                //     this.processing = true;
                //     console.log('Submitting form with data:', this.form);
                //     try {
                //         const response = await fetch('{{ route('fees.update', $fee->id) }}', {
                //             method: 'POST', 
                //             headers: {
                //                 'Content-Type': 'application/json',
                //                 'X-CSRF-TOKEN': '{{ csrf_token() }}',
                //             },
                //             body: JSON.stringify({
                //                 ...this.form,
                //                 _method: 'PUT',
                //             }),
                //         });
                //         console.log('Response status:', response.status);
                //         if (response.ok) {
                //             alert('Fee updated successfully!');
                //             window.location.href = '{{ route('fees.index') }}';
                //         } else {
                //             const data = await response.json();
                //             this.errors = data.errors || {};
                //             alert('Please fix the errors and try again.');
                //         }
                //     } catch (error) {
                //         console.error('Submission error:', error);
                //         alert('An unexpected error occurred.');
                //     } finally {
                //         this.processing = false;
                //     }
                // },
                async submitForm() {
                    this.processing = true;
                    console.log('Submitting form with data:', this.form);
                    try {
                        const response = await fetch('{{ route('fees.update', $fee->id) }}', {
                            method: 'POST', 
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                ...this.form,
                                _method: 'PUT',
                            }),
                        });
                        console.log('Response status:', response.status);
                        if (response.ok) {
                            // Instead of an alert, use the notification component
                            const notificationEvent = new CustomEvent('notify', {
                                detail: {
                                    type: 'success',
                                    content: 'Fee updated successfully!',
                                },
                            });
                            window.dispatchEvent(notificationEvent);
                            
                            // Redirect after displaying the notification
                            setTimeout(() => {
                                window.location.href = '{{ route('fees.index') }}';
                            }, 3000);  // Redirect after 3 seconds to allow notification to be seen
                        } else {
                            const data = await response.json();
                            this.errors = data.errors || {};
                            // Trigger error notification
                            const errorNotificationEvent = new CustomEvent('notify', {
                                detail: {
                                    type: 'error',
                                    content: 'Please fix the errors and try again.',
                                },
                            });
                            window.dispatchEvent(errorNotificationEvent);
                        }
                    } catch (error) {
                        console.error('Submission error:', error);
                        // Trigger error notification for unexpected error
                        const errorNotificationEvent = new CustomEvent('notify', {
                            detail: {
                                type: 'error',
                                content: 'An unexpected error occurred.',
                            },
                        });
                        window.dispatchEvent(errorNotificationEvent);
                    } finally {
                        this.processing = false;
                    }
                }
            };
        }
    </script>
    
</x-guest-layout>