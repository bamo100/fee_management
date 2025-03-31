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

    <!-- resources/views/fees/index.blade.php -->


    {{-- @section('content') --}}
    <div class="container">
        <h2>Fees List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Academic Session</th>
                    <th>Department</th>
                    <th>Faculty</th>
                    <th>Category</th>
                    <th>Level</th>
                    <th>Entry Mode</th>
                    <th>Amount</th>
                    <th>Payment Start Date</th>
                    <th>Payment Close Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fees as $fee)
                    <tr>
                        <td>{{ $fee->name }}</td>
                        <td>{{ $fee->description }}</td>
                        <td>{{ $fee->academicSession?->session_name ?? 'N/A' }}</td>
                        <td>{{ $fee->department?->department_name ?? 'N/A' }}</td>
                        <td>{{ $fee->faculty?->faculty_name ?? 'N/A' }}</td>
                        <td>{{ $fee->category?->name ?? 'N/A' }}</td>
                        <td>{{ $fee->level?->level_name ?? 'N/A' }}</td>
                        <td>{{ $fee->entryMode?->mode_name ?? 'N/A' }}</td>
                        <td>{{ number_format($fee->amount, 2) }}</td>
                        <td>{{ \Carbon\Carbon::parse($fee->payment_start_date)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($fee->payment_close_date)->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('fees.show', $fee->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('fees.edit', $fee->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('fees.destroy', $fee->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this fee?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $fees->links() }}
        </div>
    </div>
    {{-- @endsection --}}

</x-guest-layout>
