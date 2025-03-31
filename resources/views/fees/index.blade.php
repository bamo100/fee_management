<x-guest-layout>
    {{-- @section('content') --}}
    <div class="container">
        <h2>Fees List</h2>
       <table class="table-auto border border-gray-300 border-collapse w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">#</th>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">Description</th>
                    <th class="border border-gray-300 px-4 py-2">Academic Session</th>
                    <th class="border border-gray-300 px-4 py-2">Department</th>
                    <th class="border border-gray-300 px-4 py-2">Faculty</th>
                    <th class="border border-gray-300 px-4 py-2">Category</th>
                    <th class="border border-gray-300 px-4 py-2">Level</th>
                    <th class="border border-gray-300 px-4 py-2">Entry Mode</th>
                    <th class="border border-gray-300 px-4 py-2">Amount</th>
                    <th class="border border-gray-300 px-4 py-2">Payment Start Date</th>
                    <th class="border border-gray-300 px-4 py-2">Payment Close Date</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $serialNumber = 0; // Initialize the counter
                @endphp
                @foreach($fees as $fee)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ ++$serialNumber }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $fee->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $fee->description }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $fee->academicSession?->session_name ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $fee->department?->department_name ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $fee->faculty?->faculty_name ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $fee->category?->name ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $fee->level?->level_name ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $fee->entryMode?->mode_name ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ number_format($fee->amount, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($fee->payment_start_date)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($fee->payment_close_date)->format('d-m-Y') }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('fees.show', $fee->id) }}" class="btn btn-info btn-sm text-green-600">View</a>
                            <a href="{{ route('fees.edit', $fee->id) }}" class="btn btn-primary btn-sm text-blue-600">Edit</a>
                            <form action="{{ route('fees.destroy', $fee->id) }}" method="POST" style="display:inline; color: red;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm text-red-500" onclick="return confirm('Are you sure you want to delete this fee?');">Delete</button>
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
