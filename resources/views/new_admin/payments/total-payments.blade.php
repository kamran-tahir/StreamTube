@extends('layouts.admin')

@section('title', tr('subscription_payments'))

@section('content-header')

    {{  tr('subscription_payments')  }} - {{ formatted_amount(total_subscription_revenue($subscription_details ? $subscription_details->id : "")) }}
    {{ tr('revenues') }} - {{ formatted_amount(total_revenue())}}

@endsection

@section('breadcrumb')

    <li class="active"><i class="fa fa-money"></i> Total Payments</li>
@endsection

@section('content')
    <style>
.hide {
    display: none;
}

        .dis {
            display: block;
        }

    </style>
    <div class="row">

        <div class="col-xs-12">

            @include('notification.notify')

            <div class="box box-primary">

                <div class="box-header label-primary">
                    <b style="font-size: 18px;">Total Payments</b>
{{--                    <a href="{{ route('admin.users.index') }}" style="float:right" class="btn btn-default">{{ tr('view_users') }}</a>--}}


                    <div id="d2" name="d2" class="hide" >
                        <select name="" style="float:right"  class="btn btn-default"id="">

                            <option value="">January</option>
                            <option value="">February</option>
                            <option value="">March</option>
                            <option value="">April</option>
                            <option value="">May</option>
                            <option value="">June</option>
                            <option value="">July</option>
                            <option value="">August</option>
                            <option value="">September</option>
                            <option value="">October</option>
                            <option value="">November</option>
                            <option value="">December</option>


                        </select>
                    </div>

                    <div id="yeard" name="yeard" class="hide">
                        <select name="" style="float:right"  class="btn btn-default"id="">

                            <option value="">2020</option>
                            <option value="">2019</option>
                            <option value="">2018</option>
                            <option value="">2017</option>
                            <option value="">2016</option>
                            <option value="">2015</option>
                            <option value="">2014</option>
                            <option value="">2013</option>
                            <option value="">2012</option>
                            <option value="">2011</option>
                            <option value="">2010</option>
                            <option value="">2009</option>
                            <option value="">2008</option>
                            <option value="">2007</option>
                            <option value="">2006</option>
                            <option value="">2005</option>
                            <option value="">2004</option>
                            <option value="">2003</option>
                            <option value="">2002</option>
                            <option value="">2001</option>
                            <option value="">2000</option>


                        </select>

                    </div>




                    <select name="filter1" id="filter1" onChange="check()" style="float:right"  class="btn btn-default"id="">
                        <option value="all">All</option>
                        <option value="annual">Annual</option>
                        <option value="monthly">Monthly</option>

                    </select>

                    <!-- EXPORT OPTION START -->

                    @if(count($payments) > 0 )

                        <ul class="admin-action btn btn-default pull-right" style="margin-right: 40px">

                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    {{ tr('export') }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1" href="{{ route('admin.subscription.export' , ['format' => 'xlsx']) }}">
                                            <span class="text-red"><b>{{ tr('excel_sheet') }}</b></span>
                                        </a>
                                    </li>

                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1" href="{{ route('admin.subscription.export' , ['format' => 'csv']) }}">
                                            <span class="text-blue"><b>{{ tr('csv') }}</b></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                @endif

                <!-- EXPORT OPTION END -->

                </div>

                <div class="box-body table-responsive">

                    <table id="example1" class="table table-bordered table-striped">

                        <thead>
                        <tr>
                            <th>{{ tr('id') }}</th>
                            <th>User id</th>
                            <th>{{ tr('amount') }}</th>
                            <th>Currency</th>
                            <th>{{ tr('status') }}</th>
                            <th>{{ tr('date') }}</th>

                        </tr>
                        </thead>

                        <tbody>

                        @if(count($payments) > 0)

                            @foreach($payments as $i => $payment_details)

                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $payment_details->user_id }}</td>

                                    <td class="text-red">
                                        {{ formatted_amount($payment_details->amount) }}

                                    </td>
                                    <td>{{ $payment_details->currency }}</td>

                                    <td>
                                        @if($payment_details->status)
                                            <span style="color: green;"><b>{{ tr('paid') }}</b></span>
                                        @else
                                            <span style="color: red"><b>{{ tr('not_paid') }}</b></span>

                                        @endif
                                    </td>
                                    <td>{{ $payment_details->created_at }}</td>






                                </tr>

                            @endforeach

                        @endif

                        </tbody>

                    </table>

                </div>

            </div>
        </div>
    </div>
    <script>
        function check() {
            var val = document.getElementById('filter1').value;
            if(val=='monthly') {
                $(document).ready(function() {
                    $("div#d2").removeClass("hide");
                    $("div#yeard").removeClass("hide");
                    $("div#yeard").addClass("dis");
                    $("div#d2").addClass("dis");

                });
            }

            if(val=='annual') {
                $(document).ready(function() {
                    $("div#yeard").removeClass("hide");
                    $("div#yeard").addClass("dis");
                    $("div#d2").removeClass("dis");
                    $("div#d2").addClass("hide");


                });
            }

            if(val=='all') {
                $(document).ready(function() {
                    $("div#yeard").removeClass("dis");
                    $("div#yeard").addClass("hide");
                    $("div#d2").removeClass("dis");
                    $("div#d2").addClass("hide");

                });
            }
            else {
                $(document).ready(function() {
                    $("div#d3").removeClass("display");
                    $("div#d3").addClass("hidden");
                });
            }
        }
    </script>

@endsection


