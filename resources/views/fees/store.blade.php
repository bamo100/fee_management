<x-guest-layout>
    <div x-data="{
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
    </div>
</x-guest-layout>
