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
                    grid-template-columns: repeat(5, 1fr);
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
        <h2>Customer {{$customer->name}}</h2>

        <div class="content-body">
            <div class="container">
                <div class="box">
                    <h4>customer name :</h4>
                    <p>{{$customer->name}}</p>
                </div>
                <div class="box">
                    <h4>profile image:</h4>
                    <img src={{$customer->profile_image}} width='100px' height='100px'>
                </div>
                <div class="box">
                    <h4>mobile phone :</h4>
                    <p>{{$customer->mobile}}</p>
                </div>
                <div class="box">
                    <h4>package :</h4>
                    <p>{{$customer->Package?->title}}</p>
                    @if ($customer->Package)
                        <button> <a href="#package">change package</a>
                    @else
                        <button> <a href="#package">add package</a>

                    @endif
                </div>
                <div class="box">
                    <h4>subscription fees</h4>
                    <p>{{$customer->subscription_fees}}</p>
                    @if ($customer->subscription_fees)
                        <button> <a href="#supscripe">change supscripe</a>
                    @else
                        <button> <a href="#supscripe">add supscripe</a>

                    @endif
                </div>
                <div class="box">
                    <h4>main address:</h4>
                    <p>{{$customer->address}}</p>
                </div>
                <div class="box">
                    <h4>other addresses:</h4>
                    @foreach ($addresses as $address)
                        <p> -{{$address ? $address->address : ""}} {{$address->Area?->title}}
                            ({{$address->Area->City->title}})
                            <button style="border:1px"> <a
                                    href="{{Route("deleteaddress", ['id' => $address->id])}}">delete</a> </button>
                        </p>
                    @endforeach
                    <button> <a href="#address">add address</a>

                </div>
                <div class="box">
                    <h4>notes:</h4>
                    <p>{{$customer->notes}}</p>
                </div>
                <div class="box">
                    @if ($customer->active == 1)
                        <p style="    font-size: 30px; padding-top: 20px;  padding-right: 30px;color: green;">
                            active</p>
                        <button> <a href="{{Route("notactivecustomer", ['id' => $customer->id])}}">Deactivate</a> </button>

                    @else
                        <p style="    font-size: 30px; padding-top: 20px;padding-right: 30px;">
                            not active
                        </p>
                        <button> <a href="{{Route("activecustomer", ['id' => $customer->id])}}">Activate</a> </button>

                    @endif
                </div>
                <div class="box">
                    <h4>orders:</h4>
                    <p>{{count($customer->Orders)}}</p>
                    <button> <a
                            href="{{Route('showaddorder', ['name' => $customer->name, 'email' => $customer->email])}}">add
                            order</a>

                </div>
            </div>


        </div>
    </div>
</div>

<div id="package" class="modal">
    <div class="modal-content">
        <form method="post" action="{{route('addpackageforclient')}}">
            @csrf
            <input type="hidden" name="id" value="{{$customer->id}}">
            <h3>choose a backage :</h3>
            <select class="select" name="package_id" id="package">
                @foreach ($packages as $package)
                    <option value="{{$package->id}}">{{$package->title}}</option>
                @endforeach
                <option value="{{null}}">no package</option>
            </select>
            <button style="margin-top: 20px;" type="submit" class="btn btn-primary">DONE</button>
        </form>
        <button style="border:none; background:none; ">
            <a style=" position: relative; top: -40px;" class="btn btn-primary"
                href="{{ route('detailscustomer', ['id' => $customer->id]) }}">cancel</a>
        </button>
    </div>
</div>
<div id="supscripe" class="modal">
    <div class="modal-content">
        <form method="post" action="{{route('add_supscripe_for_client')}}">
            @csrf
            <input type="hidden" name="id" value="{{$customer->id}}">
            <h3>add subscription fees:</h3>
            <input type="text" name="suscripe">
            <button style="    display: block;
    margin-top: 20px;" type="submit" class="btn btn-primary">DONE</button>
        </form>
        <button style="border:none; background:none; ">
            <a style=" position: relative; top: -40px;" class="btn btn-primary"
                href="{{ route('detailscustomer', ['id' => $customer->id]) }}">cancel</a>
        </button>
    </div>
</div>
<div id="address" class="modal">
    <div class="modal-content">
        <form method="post" action="{{route('add_address_for_client')}}">
            @csrf
            <input type="hidden" name="id" value="{{$customer->id}}">
            <h3>add address:</h3>
            <input type="text" name="address">
            <h3 for="area">choose an area:</h3>
            <select class="form-control" id="area" name="area_id">
                @foreach($cities as $city)
                    <optgroup label="{{$city->title}}">
                        @foreach ($city->Areas as $area)
                            <option value="{{$area->id}}">{{$area->title}}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            <button style="    display: block;
    margin-top: 20px;" type="submit" class="btn btn-primary">DONE</button>
        </form>
        <button style="border:none; background:none; ">
            <a style=" position: relative; top: -40px;" class="btn btn-primary"
                href="{{ route('detailscustomer', ['id' => $customer->id]) }}">cancel</a>
        </button>
    </div>
</div>
@include('panel.static.footer')

</body>

</html>
