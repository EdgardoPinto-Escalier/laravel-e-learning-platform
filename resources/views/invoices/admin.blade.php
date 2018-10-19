@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', ['title' => 'MY INVOICES', 'icon' => 'archive'], ['subtitle' => 'HERE YOU CAN SEE THE LIST OF AVAILABLE INVOICES READY TO DOWNLOAD', 'icon' => 'archive'])
@endsection

@section('content')
    <div class="pl-5 pr-5">
        <div class="row justify-content-center">
            <table class="table table-hover table-active table-bordered table-responsive-lg">
                <thead>
                    <tr>
                        <th><i class="fas fa-calendar-alt fa-lg"></i>&nbsp; {{ ("SUBSCRIPTION DATE") }}</th>
                        <th><i class="fas fa-dollar-sign fa-lg"></i>&nbsp; {{ ("SUBSCRIPTION COST") }}</th>
                        <th><i class="fas fa-file-alt fa-lg"></i>&nbsp; {{ ("COUPON") }}</th>
                        <th><i class="fas fa-download fa-lg"></i>&nbsp; {{ ("DOWNLOAD INVOICE") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->date()->format('d/m/Y') }}</td>
                            <td>{{  'USD ' .$invoice->total() }}</td>
                            @if ($invoice->hasDiscount())
                                <td>
                                    {{ ("Coupon") }}: ({{ $invoice->coupon() }} / {{ $invoice->discount() }})
                                </td>
                            @else
                                <td>{{ ("No coupon has been used for this subscription...") }}</td>
                            @endif
                            <td>
                                <a class="btn btn-course" href="{{ route('invoices.download', ['id' => $invoice->id]) }}">
                                    <i class="fas fa-download fa-lg"></i>&nbsp; {{ ("Download") }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <i class="fas fa-info-circle fa-lg"></i>&nbsp;{{ ("There are no invoices available...") }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
