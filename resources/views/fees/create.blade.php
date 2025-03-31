<x-guest-layout>
    {{-- <div x-data="{
        form: $form('post', '{{ route('fees.store') }}', {
            name: '',
            description: '',
            amount: '',
            payment_start_date: '',
            payment_close_date: '',
            // Include other necessary fields
        }),
    }">
        <form @submit.prevent="form.submit()">
            @csrf
            <!-- Name Field -->
            <div>
                <label for="name">Name</label>
                <input id="name" type="text" x-model="form.name" @change="form.validate('name')">
                <span x-text="form.errors.name" class="text-red-500"></span>
            </div>
    
            <!-- Description Field -->
            <div>
                <label for="description">Description</label>
                <textarea id="description" x-model="form.description" @change="form.validate('description')"></textarea>
                <span x-text="form.errors.description" class="text-red-500"></span>
            </div>
    
            <!-- Amount Field -->
            <div>
                <label for="amount">Amount</label>
                <input id="amount" type="number" step="0.01" x-model="form.amount" @change="form.validate('amount')">
                <span x-text="form.errors.amount" class="text-red-500"></span>
            </div>
    
            <!-- Payment Start Date Field -->
            <div>
                <label for="payment_start_date">Payment Start Date</label>
                <input id="payment_start_date" type="date" x-model="form.payment_start_date" @change="form.validate('payment_start_date')">
                <span x-text="form.errors.payment_start_date" class="text-red-500"></span>
            </div>
    
            <!-- Payment Close Date Field -->
            <div>
                <label for="payment_close_date">Payment Close Date</label>
                <input id="payment_close_date" type="date" x-model="form.payment_close_date" @change="form.validate('payment_close_date')">
                <span x-text="form.errors.payment_close_date" class="text-red-500"></span>
            </div>
    
            <!-- Submit Button -->
            <div>
                <button type="submit" :disabled="form.processing">Save Fee</button>
            </div>
        </form>
    </div> --}}

    <div class="container">
        <h2>Create New Fee</h2>
        <form x-data="feeForm()" @submit.prevent="submitForm">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" x-model="form.name" class="form-control" @change="validateField('name')">
                <div x-show="errors.name" x-text="errors.name" class="text-danger"></div>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" x-model="form.description" class="form-control" @change="validateField('description')"></textarea>
                <div x-show="errors.description" x-text="errors.description" class="text-danger"></div>
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
                <label for="amount" class="form-label">Amount</label>
                <input type="number" id="amount" x-model="form.amount" class="form-control" @change="validateField('amount')">
                <div x-show="errors.amount" x-text="errors.amount" class="text-danger"></div>
            </div>

            <!-- Payment Start Date -->
            <div class="mb-3">
                <label for="payment_start_date" class="form-label">Payment Start Date</label>
                <input type="text" id="payment_start_date" x-model="form.payment_start_date" class="form-control">
                <div x-show="errors.payment_start_date" x-text="errors.payment_start_date" class="text-danger"></div>
            </div>

            <!-- Payment Close Date -->
            <div class="mb-3">
                <label for="payment_close_date" class="form-label">Payment Close Date</label>
                <input type="text" id="payment_close_date" x-model="form.payment_close_date" class="form-control">
                <div x-show="errors.payment_close_date" x-text="errors.payment_close_date" class="text-danger"></div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-[20%] h-11 rounded-full text-white bg-zinc-900">Create Fee</button>
        </form>
    </div>

</x-guest-layout>
    