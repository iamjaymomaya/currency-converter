@extends('layouts.common.partials.app')
@section('content')
    @include('layouts.common.partials.messages')
    <div class="container">
        <form action="#" id="form_currency_conversion" class="mt-5">
            @csrf
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
                        <input type="text" class="form-control" id="converted_value" name="converted_value" required="required" disabled>
                        <label for="floatingamount">Rate</label>
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
                <div class="col-md-6 text-center align-middle">
                    <button class="btn btn-success text-center align-middle" type="submit" id="btn_submit">
                        <div class="spinner-border text-white d-none" role="status" id="loading">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        Convert
                    </button>
                </div>
            </div>
        </form>
        <hr>
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-12 text-center">
                <h3>History</h3>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table" id="table_history">
                <thead>
                    <th class='text-center'>Sr No.</th>
                    <th class='text-center'>Amount</th>
                    <th class='text-center'>From</th>
                    <th class='text-center'>To</th>
                    <th class='text-center'>Rate</th>
                    <th class='text-center'>Request Datetime</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
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
        });

        function disallowConversion() {
            $('#btn_submit').attr('disabled', true);
            $('#loading').removeClass('d-none');
        }

        function allowConversion() {
            $('#btn_submit').attr('disabled', false);
            $('#loading').addClass('d-none');
        }

        function getUserCurrencyConversionLogs() {
            $('#table_history').find('tbody').empty();
            $.ajax({
                url: "{{ route('get-currency-conversion-logs') }}",
                method: 'GET',
                success: function(res) {
                    if(res && res.length == 0) {
                        let tr = "<tr>";
                        tr += "<td colspan='6' class='text-center'>No Records found </td>";
                        tr += "</tr>";
                        $('#table_history').find('tbody').append(tr);
                    } else if(res && res.length > 0) {
                        $.each(res, function(key, value) {
                            let tr = "<tr>";
                            tr += "<td class='text-center'>"+(res.length - key)+"</td>";
                            tr += "<td class='text-center'>"+value['amount']+"</td>";
                            tr += "<td class='text-center'>"+value['from']+"</td>";
                            tr += "<td class='text-center'>"+value['to']+"</td>";
                            tr += "<td class='text-center'>"+value['value']+"</td>";
                            tr += "<td class='text-center'>"+value['created_at']+"</td>";
                            tr += "</tr>";
                            $('#table_history').find('tbody').append(tr);
                        })
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        $(document).on('submit', '#form_currency_conversion', function(e) {
            e.preventDefault();
            disallowConversion();
            $.ajax({
                url: "{{ route('convert-currency') }}",
                method: 'POST',
                data: $('#form_currency_conversion').serialize(),
                success: function(res) {
                    if(res?.value) {
                        $('#converted_value').val(res?.value)
                    } else {
                        $('#converted_value').val("NA")
                    }
                    allowConversion();
                    getUserCurrencyConversionLogs();
                },
                error: function(error) {
                    if(error?.responseJSON?.message) {
                        alert(error?.responseJSON?.message)
                    }
                    allowConversion();
                    getUserCurrencyConversionLogs();
                }
            });
        })

        getUserCurrencyConversionLogs();
    });
</script>
@endpush