@include('panel.static.header')
@include('panel.static.main')


<div class="app-content content">

    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">

        </div>

        <style>
            body {}

            .container {
                display: grid;
                border: 2px #a8bcd4 solid;
                border-radius: 15px;
                margin-right: 0px;
                padding-right: 0px;
                grid-template-columns: repeat(2, minmax(350px, 1fr));
                font-family: Arial, sans-serif;
                height: fit-content;
                box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            }

            .form {
                padding: 20px;
                border-left: 2px #a8bcd4 solid;

            }

            .search {
                overflow-x: auto;
                overflow-y: auto;
                margin-top: 50px;
                height: fit-content;
                width: 100%;
                padding: 20px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            input,
            select {
                margin-bottom: 15px;
                margin-top: 20px;
                width: 75%;
                box-sizing: border-box;
                font-size: 1.2rem;
            }

            .p {
                display: block;
                font-weight: bold;
                font-size: 30px;
            }

            input[type="submit"] {
                max-width: max-content;
                display: block;
                text-transform: uppercase;
                border: 2px #a8bcd4 solid;
                padding: 8px 20px;
                transition: var(--transition);
                background: hsl(0, 0%, 91%);
                color: #0d3668;
            }

            .mynav {
                margin: 40px;
                padding: 10px;
            }

            .mynav h2 {
                display: inline;
            }

            .mynav button {
                position: absolute;
                margin-right: 40px;
                border: 2px #475f7b solid;
                padding: 5px 20px 5px 20px;
                border-radius: 40%;
            }
        </style>
        <div class="mynav">
            <h2>Main Page</h2>
            <button> <a href="{{route('TodaysOrders')}}">today's orders</a></button>
        </div>
        <div class="container">
            <form method="post" action="{{route('getorder')}}" class="form">
                @csrf
                <p class="p">get your order by its number :</p>
                <input type="number" name="order_number" placeholder="number of order">
                @error('order_number')
                    <p style="color: red"> * {{$message}}</p>
                @enderror
                <input type="submit" value="get">
            </form>
            <form method="post" action="{{route('checkclients')}}" style="padding: 20px;">
                @csrf
                <p class="p">check out your clients :</p>
                <input type="text" name="name" placeholder="client name">
                @error('name')
                    <p style="color: red"> * {{$message}}</p>
                @enderror
                <input type="email" name="email" placeholder="client email">
                @error('email')
                    <p style="color: red"> * {{$message}}</p>
                @enderror
                <select class="form-control" style="width:75%;" id="city" name="areaname">
                    <option value="{{null}}" selected> </option>
                    @foreach($cities as $city)
                        <optgroup label="{{$city->title}}">
                            @foreach ($city->Areas as $area)
                                <option value="{{$area->id}}">{{$area->title}}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
                <input type="submit" value="check">

            </form>
        </div>

        <div class="search ">
            @isset ($order)
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>order</th>
                            <th>order number</th>
                            <th>status</th>
                            <th>delivery man</th>
                            <th>scheduledTime</th>
                            <th>estimatedTime</th>
                            <th>startTime</th>
                            <th>canceled</th>
                            <th>cancelNote</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width:fit-content;">{{$order->order}}</td>
                            <td style="width:fit-content;">{{$order->order_number}}</td>
                            <td style="width:fit-content;">{{$order->status}}</td>
                            <td style="width:fit-content;">{{$order->Delivary?->User->name}}</td>
                            <td style="width:fit-content;"></td>
                            <td style="width:fit-content;">{{$order->estimatedTime}}</td>
                            <td style="width:fit-content;">{{$order->startDelivaryTime}}</td>

                            <td style="width:fit-content;"></td>
                            <td style="width:fit-content;"></td>
                            <td style="width:fit-content;"></td>
                            <td style="width:fit-content;"><button> <a
                                        href="{{route('openorder', ['id' => $order->id])}}">Open</a></button></td>
                        </tr>
                    </tbody>
            @endisset
                @isset($clients)
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

                            @foreach ($clients as $client)
                                <tr>
                                    <td style="width:fit-content;">{{$client->name}}</td>
                                    <td style="width:fit-content;">{{$client->mobile}}</td>
                                    <td style="width:fit-content;">{{$client->Package?->title}}</td>
                                    <td style="width:fit-content;">{{$client->subscription_fees}}</td>
                                    <td style="width:fit-content;">{{$client->address}}</td>
                                    <td style="width:fit-content;">{{$client->notes}}</td>
                                    @if ($client->active == 1)
                                        <td style="width:fit-content; color:green;">active</td>
                                    @else
                                        <td style="width:fit-content;">not active</td>
                                    @endif
                                    <td style="width:fit-content;">{{$client->expire}}</td>
                                    <td style="width:fit-content;">{{$client->Area?->title}}</td>
                                    <td style="width:fit-content;"><img src={{$client->profile_image}} width='100px'
                                            height='100px'>
                                    </td>


                                    <td style="width:fit-content;"><button> <a
                                                href="{{route('detailscustomer', ['id' => $client->id])}}">show
                                                details</a></button></td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endisset
        </div>
    </div>
</div>


@include('panel.static.footer')
</body>

</html>
