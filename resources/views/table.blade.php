<div class="row">
    @forelse($tables as $data)
        <?php $table = (new App\Http\Controllers\BookingController)->GetTableInformation($data) ?>
        <div class="col-md-4">
            <p class="text-primary">Table Number is : {{ $table->table_number }}</p>
            <p class="text-secondary">Serving Capacity is : {{ $table->TableType->serving_capacity }}</p>
        </div>
    @empty
        <h4 class="text-danger">No Tables available</h4>
    @endforelse
</div>
