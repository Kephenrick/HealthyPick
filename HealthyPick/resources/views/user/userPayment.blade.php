@extends('layout.main')

@section('title', __('messages.payment'))
@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('messages.payment') }}</h5>
                        <small>{{ __('messages.order_id') }}: {{ $order['id'] ?? '-' }}</small>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-4">
                                <h6>{{ __('messages.order_summary') }}</h6>
                                <p><strong>{{ __('messages.amount') }}:</strong> {{ isset($order['amount']) ? number_format($order['amount'], 0, ',', '.') : '-' }}</p>
                                <p><strong>{{ __('messages.order_id') }}:</strong> {{ $order['id'] ?? '-' }}</p>
                            </div>

                            <div class="col-md-8">
                                <form action="{{ route('user.payment.submit') }}" method="POST" id="paymentForm">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order['id'] ?? '' }}">
                                    <input type="hidden" name="amount" value="{{ $order['amount'] ?? '' }}">

                                    <h6>{{ __('messages.payment_method') }}</h6>
                                    <p class="text-muted small">{{ __('messages.select_payment_method') }}</p>

                                    <div class="list-group mb-3" role="tablist">
                                        <label class="list-group-item d-flex gap-3">
                                            <input class="form-check-input mt-1" type="radio" name="method" value="credit_card" {{ old('method') == 'credit_card' ? 'checked' : '' }}>
                                            <div>
                                                <strong>{{ __('messages.credit_card') }}</strong>
                                                <div class="small text-muted">Pay with your Visa / MasterCard</div>
                                            </div>
                                        </label>

                                        <label class="list-group-item d-flex gap-3">
                                            <input class="form-check-input mt-1" type="radio" name="method" value="bank_transfer" {{ old('method') == 'bank_transfer' ? 'checked' : '' }}>
                                            <div>
                                                <strong>{{ __('messages.bank_transfer') }}</strong>
                                                <div class="small text-muted">Transfer to our bank account</div>
                                            </div>
                                        </label>

                                        <label class="list-group-item d-flex gap-3">
                                            <input class="form-check-input mt-1" type="radio" name="method" value="e_wallet" {{ old('method') == 'e_wallet' ? 'checked' : '' }}>
                                            <div>
                                                <strong>{{ __('messages.e_wallet') }}</strong>
                                                <div class="small text-muted">Use GoPay/OVO/Dana</div>
                                            </div>
                                        </label>

                                        <label class="list-group-item d-flex gap-3">
                                            <input class="form-check-input mt-1" type="radio" name="method" value="cod" {{ old('method') == 'cod' ? 'checked' : '' }}>
                                            <div>
                                                <strong>{{ __('messages.cod') }}</strong>
                                                <div class="small text-muted">Pay when the order is delivered</div>
                                            </div>
                                        </label>
                                    </div>

                                    <button type="submit" class="btn btn-primary" id="payBtn">{{ __('messages.pay') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Enable/disable pay button based on selection
        (function(){
            const form = document.getElementById('paymentForm');
            const payBtn = document.getElementById('payBtn');
            function update(){
                const selected = form.querySelector('input[name="method"]:checked');
                payBtn.disabled = !selected;
            }
            form.addEventListener('change', update);
            update();
        })();
    </script>
@endsection