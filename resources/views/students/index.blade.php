<!-- resources/views/student_fees/index.blade.php -->

<x-guest-layout>
    <div class="container">
        <h1>Student Fees</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Fee Name</th>
                    <th>Amount Due</th>
                    <th>Amount Paid</th>
                    <th>Balance</th>
                    <th>Status</th>
                    <th>Payment Due Date</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $serialNumber = 0; // Initialize the counter
                @endphp
                @foreach ($studentFees as $fee)
                    <tr>
                        <td>{{ ++$serialNumber }}</td>
                        <td>{{ $fee->student?->first_name ?? 'N/A' }}</td>
                        <td>{{ $fee->fee?->name ?? 'N/A' }}</td>
                        <td>{{ $fee->amount_due }}</td>
                        <td>{{ $fee->amount_paid }}</td>
                        <td>{{ $fee->balance }}</td>
                        <td>{{ $fee->status }}</td>
                        <td>{{ $fee->payment_due_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $studentFees->links() }}
        </div>
    </div>
</x-guest-layout>
