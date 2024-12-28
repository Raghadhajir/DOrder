@include('panel.static.header')
@include('panel.static.main')


<div class="app-content content">
    <style>
        .app-content {
            width: 100%;
            overflow-x: auto;
        }
    </style>
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">

        </div>
        <h2>Customer</h2>
        <div class="content-body">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>mobile</th>
                        <th>package</th>
                        <th>subscription</th>
                        <th>address</th>
                        <th>notes</th>
                        <th>active</th>
                        <th>expire date</th>
                        <th>area</th>
                        <th>image</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($customers as $customer)
                        <tr>
                            <td style="width:100px;">{{$customer->name}}</td>
                            <td style="width:100px;">{{$customer->mobile}}</td>
                            <td style="width:100px;">{{$customer->Package?->title}}</td>
                            <td style="width:100px;">{{$customer->subscription_fees}}</td>
                            <td style="width:100px;">{{$customer->address}}</td>
                            <td style="width:100px;">{{$customer->notes}}</td>
                            @if ($customer->active == 1)
                                <td style="width:100px; color:green;">active</td>
                            @else
                                <td style="width:100px;">not active</td>
                            @endif
                            <td style="width:100px;">{{$customer->expire}}</td>
                            <td style="width:100px;">{{$customer->Area?->title}}</td>
                            <td style="width:100px;"><img src={{$customer->profile_image}} width='100px' height='100px'>
                            </td> 


                            <td style="width:100px;"><button> <a
                                        href="{{route('detailscustomer', ['id' => $customer->id])}}">show
                                        details</a></button></td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br><br><br>

        </div>
    </div>
</div>

@include('panel.static.footer')

</body>

</html>
