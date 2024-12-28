@include('panel.static.header')
@include('panel.static.main')

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>

        <div class="content-body">
            <h3 style="margin-top: 60px;">ADD NEW CUSTOMER :</h3>

            <style>
                body {}

                .container {
                    font-family: Arial, sans-serif;
                    margin-top: 30px;
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

                input[type="submit"] {
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

                <form method="post" action="{{route('showaddcustomer')}}" enctype="multipart/form-data">
                    @csrf

                    <label for="name">customer name:</label>
                    <input type="text" id="name" name="name" placeholder="name">
                    @error('name')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror

                    <label for="email">customer email:</label>
                    <input type="email" id="email" name="email" placeholder="email">
                    @error('email')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror

                    <label for="pass">password :</label>
                    <input type="text" id="pass" name="pass" placeholder="password">
                    @error('pass')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror

                    <label for="mobile">customer mobile:</label>
                    <input type="text" id="mobile" name="mobile" placeholder="mobile">
                    @error('moblie')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror

                    <label for="address">customer address:</label>
                    <input type="text" id="address" name="address" placeholder="address">
                    @error('address')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror

                    <label for="img">your profile image:</label>
                    <input type="file" id="img" name="img" placeholder="image">
                    @error('img')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror

                    <label for="package">choose a backage :</label>
                    <select name="package_id" id="package">
                        <option value="{{null}}">{{0}}</option>

                        @foreach ($packages as $package)

                            <option value="{{$package->id}}">{{$package->title}}</option>

                        @endforeach
                    </select>
                    @error('package_id')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror

                    <label for="supscripe">supscription fees:</label>
                    <input type="text" id="supscripe" name="supscripe" placeholder="supscription fees">
                    @error('supscripe')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror

                    <input type="hidden" name="type" value="user">
                    <!-- <input type="hidden" name="active" value=0> -->


                    <label for="area">choose an area:</label>
                    <select class="form-control" id="area" name="area_id">
                        @foreach($cities as $city)
                            <optgroup label="{{$city->title}}">
                                @foreach ($city->Areas as $area)
                                    <option value="{{$area->id}}">{{$area->title}}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    @error('area_id')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror
                    <br><br>


                    <button type="submit" class="btn btn-primary">add</button>
            </div>
        </div>
    </div>


    @include('panel.static.footer')

    </body>


    </html>
