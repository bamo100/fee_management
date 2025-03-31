<x-guest-layout>
    <div class="container">
        <h1>Fee Details</h1>
        <div>
            <p><strong>Name:</strong> {{ $fee->name }}</p>
            <p><strong>Description:</strong> {{ $fee->description }}</p>
            <p><strong>Amount:</strong> {{ $fee->amount }}</p>
            <p><strong>Payment Start Date:</strong> {{ $fee->payment_start_date }}</p>
            <p><strong>Payment Close Date:</strong> {{ $fee->payment_close_date }}</p>
        </div>
    </div>
</x-guest-layout>