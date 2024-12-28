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
        <h2>Orders</h2>
        <div class="content-body">
            @if (!$orders)
                <br>
                <h2>There are no cities yet</h2>
            @else
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>order</th>
                            <th>order number</th>
                            <th>status</th>
                            <th>delivery man</th>
                            <th>scheduledTime</th>
                            <th>estimatedTime</th>
                            <th>startDelivaryTime</th>
                            <th>canceled</th>
                            <th>cancelNote</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($orders as $order)
                            <tr>
                                <td style="width:100px;">{{$order->order}}</td>
                                <td style="width:100px;">{{$order->order_number}}</td>
                                <td style="width:100px;">{{$order->status}}</td>
                                <td style="width:100px;">{{$order->Delivary?->User->name}}</td>
                                <td style="width:100px;"></td>
                                <td style="width:100px;">{{$order->estimatedTime}}</td>
                                <td style="width:100px;">{{$order->startDelivaryTime}}</td>

                                <td style="width:100px;"></td>
                                <td style="width:100px;"></td>
                                <td style="width:100px;"><button> <a href="">edit</a></button></td>
                                <td style="width:100px;"><button> <a
                                        href="{{route('openorder', ['id' => $order->id])}}">Open</a></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br><br><br>
            @endif
        </div>
    </div>
</div>

@include('panel.static.footer')

</body>

</html>
