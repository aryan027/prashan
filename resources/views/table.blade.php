
    @forelse($tables as $key=> $data)
        <?php $table = (new App\Http\Controllers\BookingController)->GetTableInformation($data) ?>
        <div class="card mt-2 d-inline-flex p-2 bg-warning" style="max-width:15rem;">
            <div class="card-body ">
                <p class="text-primary">Table Number is : {{ $table->table_number }}</p>
                <p class="text-secondary">Serving Capacity is : {{ $table->TableType->serving_capacity }}</p>
            </div>
            <div class="card-footer">
                <input type="button" value="book" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$key+1 }}" >
            </div>
        </div>
    @empty
        <h4 class="text-danger">No Tables available</h4>
    @endforelse

    <div class="modal fade" id="staticBackdrop{{$key+1 }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="selected_date" class="form-label">Date</label>
                                <input type="text" name="selected_date" class="form-control-plaintext" id="selected_date" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="selected_time" class="form-label">Time</label>
                                <input type="text" name="selected_time" class="form-control-plaintext" id="selected_time" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Enter the first name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter your last name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="phone_no" class="form-label">Phone No.</label>
                                <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Enter you number">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
<script>
    $('InputDate').val()
</script>
