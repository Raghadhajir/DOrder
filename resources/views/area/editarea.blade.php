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
                <form method="post" action="{{route('showeditarea')}}" style="display:inline;">
                    @csrf

                    <label for="cname">area name:</label>
                    <input type="text" id="cname" name="areaname" value="{{$area->title}}">
                    @error('areaname')
                        <p style="color: red"> * {{$message}}</p>
                        <br>
                    @enderror

                    city name:
                    <select name="cityname">
                        @foreach ($cities as $city)

                            <option value="{{$city->id}}">
                                {{$city->title}}
                            </option>
                        @endforeach
                    </select>
                    <br><br>
                    <input type="hidden" name="id" value="{{$area->id}}">

                    <input type="submit" value="edit">
                </form>
                <button> <a style="color:black; " href="{{ route('showareas') }}">cancel</a></button>

            </div>
        </div>
    </div>
</div>

@include('panel.static.footer')

</body>

</html>
