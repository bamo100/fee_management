<!-- resources/views/student_fees/index.blade.php -->

<x-guest-layout>
    <div class="container">
        <h1>Student Fees</h1>
        <table class="table-auto border border-gray-300 border-collapse w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">#</th>
                    <th class="border border-gray-300 px-4 py-2">Student Name</th>
                    <th class="border border-gray-300 px-4 py-2">Fee Name</th>
                    <th class="border border-gray-300 px-4 py-2">>Amount Due</th>
                    <th class="border border-gray-300 px-4 py-2">Amount Paid</th>
                    <th class="border border-gray-300 px-4 py-2">Balance</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Payment Due Date</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $serialNumber = $startingSerialNumber; 
                    // $serialNumber = 0; // Initialize the counter
                @endphp
                @foreach ($studentFees as $fee)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ ++$serialNumber }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $fee->student?->first_name ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $fee->fee?->name ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $fee->amount_due }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $fee->amount_paid }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $fee->balance }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $fee->status }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $fee->payment_due_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{-- {{ $studentFees->links() }} --}}
            {{ $studentFees->appends(['serial' => $serialNumber])->links() }}
        </div>
    </div>
</x-guest-layout>
