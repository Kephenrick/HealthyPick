@extends('layout.dashboard')

@section('title', __('messages.sales_history'))
@section('title-page', __('messages.sales_history'))
@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ __('messages.customer') }}</th>
                <th>{{ __('messages.product') }}</th>
                <th>{{ __('messages.stock') }}</th>
                <th>{{ __('messages.status') }}</th>
                <th>{{ __('messages.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $tx)
                <tr>
                    <td>{{ $tx->customer->name ?? '-' }}</td>
                    @php $first = $tx->items->first(); @endphp
                    <td>{{ $first && $first->product ? $first->product->Name : '-' }}</td>
                    <td>{{ $tx->items->sum('quantity') }}</td>
                    <td>
                        @if($tx->status == 'pending')
                            <span class="badge bg-warning">{{ __('messages.pending') ?? ucfirst($tx->status) }}</span>
                        @elseif($tx->status == 'paid')
                            <span class="badge bg-success">{{ __('messages.paid') ?? ucfirst($tx->status) }}</span>
                        @elseif($tx->status == 'completed')
                            <span class="badge bg-info">{{ __('messages.completed') ?? ucfirst($tx->status) }}</span>
                        @elseif($tx->status == 'cancelled')
                            <span class="badge bg-danger">{{ __('messages.cancelled') ?? ucfirst($tx->status) }}</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($tx->status) }}</span>
                        @endif
                    </td>
                    <td>
                        @if(!in_array($tx->status, ['completed', 'cancelled']))
                            @if($tx->status !== 'completed')
                                <form action="{{ route('vendor.transaction.complete', $tx->Transaction_ID) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    <button class="btn btn-sm btn-success" onclick="return confirm('Mark as completed?')">{{ __('messages.send') }}</button>
                                </form>
                            @endif

                            @if($tx->status !== 'cancelled')
                                <form action="{{ route('vendor.transaction.cancel', $tx->Transaction_ID) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Reject this transaction?')">{{ __('messages.reject') }}</button>
                                </form>
                            @endif
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada transaksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection