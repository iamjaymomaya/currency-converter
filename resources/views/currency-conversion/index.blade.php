@extends('layouts.common.partials.app')
@section('content')
    @include('layouts.common.partials.messages')
    <div class="container">
        <form action="#" id="form_currency_conversion" class="mt-5">
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <h3>Currency Conversion</h3>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-2">
                    <div class="form-group form-floating mb-3">
                        <input type="text" class="form-control" name="amount" placeholder="amount" required="required" value="1" required>
                        <label for="floatingamount">Amount</label>
                        @if ($errors->has('amount'))
                            <span class="text-danger text-left">{{ $errors->first('amount') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-floating mb-3">
                        <select class="form-control" id="from_currency" name="from" required>
                            <option value="">Select a currency</option>
                            @foreach($currencies as $currency)
                                <option value="{{$currency->symbol}}">{{$currency->symbol}} - {{$currency->name}}</option>
                            @endforeach
                        </select>
                        <label for="floatingamount">From</label>
                        @if ($errors->has('amount'))
                            <span class="text-danger text-left">{{ $errors->first('amount') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-2">
                    <div class="form-group form-floating mb-3">
                        <input type="text" class="form-control" name="value" required="required" readonly>
                        <label for="floatingamount"></label>
                        @if ($errors->has('amount'))
                            <span class="text-danger text-left">{{ $errors->first('amount') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-floating mb-3">
                        <select class="form-control" id="to_currency" name="to" required>
                            <option value="">Select a currency</option>
                            @foreach($currencies as $currency)
                                <option value="{{$currency->symbol}}">{{$currency->symbol}} - {{$currency->name}}</option>
                            @endforeach
                        </select>
                        <label for="floatingamount">To</label>
                        @if ($errors->has('amount'))
                            <span class="text-danger text-left">{{ $errors->first('amount') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-6 text-center">
                    <button class="btn btn-success">Convert</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $(document).on('change', '#from_currency', function() {
            let fromCurrency = $(this).val();
            $('#to_currency').find('option').attr('disabled', false);
            if(fromCurrency && $('#to_currency').val() == fromCurrency) {
                $('#to_currency').val("");
            }
            if(fromCurrency) {
                $('#to_currency').find('option[value='+fromCurrency+']').attr('disabled', true);
            }
        });

        $(document).on('change', '#to_currency', function() {
            let toCurrency = $(this).val();
            $('#from_currency').find('option').attr('disabled', false);
            if(toCurrency && $('#from_currency').val() == toCurrency) {
                $('#from_currency').val("");
            }
            if(toCurrency) {
                $('#from_currency').find('option[value='+toCurrency+']').attr('disabled', true);
            }
        });

        $(document).on('#form_currency_conversion', 'submit', function(e) {
            e.preventDefault();
        })
    });
</script>
@endpush