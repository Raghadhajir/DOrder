@include('panel.static.header')
@include('panel.static.main')


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">

        </div>
        <div class="content-body">

            <style>
                body {}

                .container {
                    font-family: Arial, sans-serif;
                    margin-top: 100px;
                    padding: 0;
                    height: fit-content;
                    width: 300px;
                    padding: 20px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                }

                input[type="text"],
                input[type="email"],
                input[type="password"],
                select {
                    width: 100%;
                    margin-bottom: 15px;
                    margin-top: 10px;
                    box-sizing: border-box;
                    font-size: 1.2rem;
                }

                input[type="submit"],
                button {
                    max-width: max-content;
                    margin-top: 20px;
                    margin-inline: auto;
                    font-size: var(--fs-9);
                    font-weight: var(--fw-500);
                    text-transform: uppercase;
                    border: 1px solid #5C4B99;
                    padding: 8px 20px;
                    transition: var(--transition);
                    background: hsl(0, 0%, 91%);
                }
            </style>
            <div class="container">
                <form method="post" action="{{route('showeditdelivery')}}" style="display:inline;">
                    @csrf

                    <input type="hidden" name="id" value="{{$deliveries->id}}">


                    <label for="name">monitor name:</label>
                    <input type="text" id="name" name="name" value="{{$deliveries->name}}">
                    @error('name')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror

                    <label for="email">monitor email:</label>
                    <input type="email" id="email" name="email" value="{{$deliveries->email}}">
                    @error('email')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror

                    <label for="pass">password :</label>
                    <input type="text" id="pass" name="pass">
                    @error('pass')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror

                    <label for="mobile">monitor mobile:</label>
                    <input type="text" id="mobile" name="mobile" value="{{$deliveries->mobile}}">
                    @error('pass')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror

                    @if($deliveries->active == 1)
                        <input type="radio" id="active" name="active" value="1" checked>
                        <label for="active">active </label>

                        <input type="radio" id="active" name="active" value="0">
                        <label for="active"> not active </label>
                    @else
                        <input type="radio" id="active" name="active" value="1">
                        <label for="active">active </label>

                        <input type="radio" id="active" name="active" value="0" checked>
                        <label for="active"> not active </label>
                    @endif

                    @error('active')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror
                    <input type="hidden" name="type" value="deliver">

                    <select class="form-control" id="city" name="areaname" required>
                        @foreach($cities as $city)
                            <optgroup label="{{$city->title}}">
                                @foreach ($city->Areas as $area)
                                    <option value="{{$area->id}}">{{$area->title}}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>



                    <br><br>

                    <input type="submit" value="edit"></form>
                    <button> <a style="color:black; " href="{{ route('showdeliveries') }}">cancel</a></button>

            </div>
        </div>
    </div>
</div>

@include('panel.static.footer')

</body>

</html>
