<div>
    @foreach($row->bookHasPrices as $price)
    <span class="badge bg-danger text-white border shadow-sm" >INR. {{$price->rate_per_day}} - {{$price->no_of_days_minimum}} Days</span>
    @endforeach
</div>