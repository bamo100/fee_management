export default function feeForm() {
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
                const response = await fetch('/fees', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Precognition': 'true',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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
    };
}