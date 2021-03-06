



@extends('Backend.dashboard.master')
@section('extra_css')
<!-- DataTables -->
<link href="{{ url('/backend') }}/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('/backend') }}/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ url('/backend') }}/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title float-left">Manage sales </h4>

            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Visit site</a></li>
                <li class="breadcrumb-item"><a href="{{ route('sale.index') }}">sales</a></li>

            </ol>

            <div class="clearfix"></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong> {{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if (session('delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong> {{ session('delete') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <table id="datatable-buttons" class="table table-striped table-bsaleed" cellspacing="0" width="100%">

                <thead>

                <tr>
                    <th>sale Id</th>
                    <th>Product</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                    
                    <th>Date</th>
                    <th>Total</th>


                </tr>
                </thead>


                <tbody>

                @foreach ($sales as  $sale)
                @foreach ($billings as $billing)
                    @if ($sale->id == $billing->sale_id)
                     <td>{{$sale->id}}</td>
                     <td>
                        {{ $billing->Product->product_name }}
                    </td>
                    <td>{{ $billing->payment_method }}</td>
                    <td>Paid</td>

                    @endif

                @endforeach
                <tr>

                    <td>{{$sale->id}}</td>
                    <td>
                        {{ $sale->product->product_name }}
                    </td>

                     <td>
                        @if ($sale->billing->transaction_id == 'cash')
                            Cash
                        @elseif($sale->billing->cash_on_deliver=='on')
                            Cash On Delivery
                            @else
                            Invalid payment
                        @endif
                    </td>

                    @if ($sale->shipping_process ==1)
                    <td>
                        {{ $sale->is_paid==1?'Paid':'Due' }}
                    </td>

                    @else
                    <td>Processing</td>
                   @endif

                    <td>{{ $sale->shipping_process==0?'Processing':'Shipped' }}</td>

                    @if ($sale->shipping_process==0)
                        <td> Processing</td>
                        @else
                        <td>Cancel</td>

                    @endif
                    {{-- <td>{{ $sale->is_cancel==0?'Delivered':'Cancel' }}</td> --}}
                    <td>{{ $sale->created_at->format('M d, Y') }}</td>
                    <td>{{ $sale->billing->grandTotal }}</td>

                    </tr>


                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('extra_js')
<script src="{{ url('/backend') }}/assets/js/metisMenu.min.js"></script>
<script src="{{ url('/backend') }}/assets/js/waves.js"></script>
<script src="{{ url('/backend') }}/assets/js/jquery.slimscroll.js"></script>

<!-- Required datatable js -->
<script src="{{ url('/backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('/backend') }}/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{ url('/backend') }}/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="{{ url('/backend') }}/plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="{{ url('/backend') }}/plugins/datatables/jszip.min.js"></script>
<script src="{{ url('/backend') }}/plugins/datatables/pdfmake.min.js"></script>
<script src="{{ url('/backend') }}/plugins/datatables/vfs_fonts.js"></script>
<script src="{{ url('/backend') }}/plugins/datatables/buttons.html5.min.js"></script>
<script src="{{ url('/backend') }}/plugins/datatables/buttons.print.min.js"></script>
<script src="{{ url('/backend') }}/plugins/datatables/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="{{ url('/backend') }}/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="{{ url('/backend') }}/plugins/datatables/responsive.bootstrap4.min.js"></script>
@endsection

 @section('main_js')

<script type="text/javascript">
    $(document).ready(function() {

        //Buttons examples
        var table = $('#datatable-buttons').DataTable();

        table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
    } );

</script>

@endsection





















