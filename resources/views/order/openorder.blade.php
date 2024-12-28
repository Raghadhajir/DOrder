@include('panel.static.header')
@include('panel.static.main')

<html lang="en">

<div class="app-content content">

    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
                .modal {
                    display: none;
                    position: fixed;
                    z-index: 1;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    overflow: auto;
                    background-color: rgba(0, 0, 0, 0.5);
                }

                .select {
                    width: 100%;
                    margin-bottom: 15px;
                    margin-top: 10px;
                    box-sizing: border-box;
                    font-size: 1.2rem;
                }

                .modal-content {
                    background-color: #fff;
                    margin: 20% 50%;
                    padding: 20px;
                    border: 1px solid #888;
                    width: 80%;
                    max-width: 300px;
                }

                .modal:target {
                    display: block;
                }

                .container {
                    display: grid;
                    grid-template-columns: repeat(4, 1fr);
                    grid-gap: 50px;
                    margin-top: 73px;
                    margin-right: 10px;
                }

                .box {
                    border: 1px solid #ccc;
                    box-shadow: 12px 12px 5px rgba(0, 0, 0, 0.1);
                    padding: 10px;
                }
            </style>
        </div>
        <h2>order {{$order->user->name}}</h2>

        <div class="content-body">
            <div class="container">
                <div class="box">
                    <h4>Order :</h4>
                    <p>{{$order->order}}</p>
                </div>
                <div class="box">
                    <h4>Order number:</h4>
                    <p>{{$order->order_number}}</p>
                </div>
                <div class="box">
                    <h4>status :</h4>
                    <p>{{$order->status}}</p>
                </div>
                <div class="box">
                    <h4>delivary man :</h4>
                    @if ($order->Delivary)
                        <p>{{$order->Delivary?->User->name}}</p>
                    @else
                        <button> <a href="#delivary">add delivary man :</a>
                    @endif
                </div>
                <div class="box">
                    <h4>scheduled Time :</h4>
                    @if ($order->scheduledTime)
                        <p>{{$order->scheduledTime}}</p>
                    @else
                        {{null}}
                    @endif
                </div>
                <div class="box">
                    <h4>estimated Time :</h4>
                    @if ($order->subscription_fees)
                        <p>{{$order->estimatedTime}}</p>
                    @else
                        {{null}}
                    @endif
                </div>
                <div class="box">
                    <h4>received Time:</h4>
                    @if ($order->receivedTime)
                        <p>{{$order->receivedTime}}</p>
                    @else
                        {{null}}
                    @endif
                </div>
                <div class="box">
                    <h4>canceled :</h4>
                    @if ($order->cancel == 1)
                        <p style="    font-size: 30px; padding-top: 20px;padding-right: 30px;">
                            cancel
                        </p>

                    @else
                        <p style="    font-size: 30px; padding-top: 20px;  padding-right: 30px;color: green;">
                            not cancel</p>

                    @endif
                </div>
                <div class="box">
                    <h4>cancel note:</h4>
                    @if($order->cancelNote)
                        <p>{{$order->cancelNote}}</p>
                    @else
                        {{null}}
                    @endif
                </div>
                <div class="box">
                    <h4>Area :</h4>
                    <p>{{$order->User->Area?->title}}->{{$order->User->Area?->City->title}}</p>
                    <p></p>
                </div>
            </div>
        </div>

    </div>
</div>
<div id="delivary" class="modal">
    <div class="modal-content">
        <form method="post" action="{{route('addDelivaryman')}}">
            @csrf
            <input type="hidden" name="id" value="{{$order->id}}">
            <h3>choose :</h3>
            <select class="select" name="delivary_id" id="package">
                @foreach ($delivaries as $delivary)
                    <option value="{{$delivary->id}}">{{$delivary->User->name}}</option>
                @endforeach
                <option value="{{null}}">no delivary</option>
            </select>
            <button style="margin-top: 20px;" type="submit" class="btn btn-primary">DONE</button>
        </form>
        <button style="border:none; background:none; ">
            <a style=" position: relative; top: -40px;" class="btn btn-primary"
                href="{{ route('openorder', ['id' => $order->id]) }}">cancel</a>
        </button>
    </div>
</div>
@include('panel.static.footer')

</body>

</html>
