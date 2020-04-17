<div class="row mb-5">
    <div class="col">
        <h5>Banking Details</h5>
    </div>

    <div class="col-12">
        <div class="table-responsive">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td>Bank Name</td>
                        <td>{{ RM::bankName($bank->bank_code) ?? "No bank setup" }}</td>
                    </tr>
                    <tr>
                        <td>Account Name</td>
                        <td>{{ $bank->account_name ?? "Account Name not set" }}</td>
                    </tr>
                    <tr>
                        <td>Account No.</td>
                        <td>{{ $bank->account_number ?? "Account Number not set" }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        @if ($show_verify_note ?? false)
            <small class="text-danger">
                Please ensure that the informations given above are correct. Payments would be made to the above stated account details.
            </small>
        @endif
    </div>
</div>