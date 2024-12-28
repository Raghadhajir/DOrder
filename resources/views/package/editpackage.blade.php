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
                <form method="post" action="{{route('showeditpackage')}}" enctype="multipart/form-data" style="display:inline">
                    @csrf
                    <input type="hidden" name="id" value="{{$package->id}}">

                    <label for="title">package title:</label>
                    <input type="text" id="title" name="title" value="{{$package->title}}">
                    @error('title')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror

                    <label for="img">package image:</label>
                    <input type="file" id="img" name="img">
                    @error('img')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror

                    <label for="price">price :</label>
                    <input type="text" id="price" name="price" value="{{$package->package_price}}">
                    @error('price')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror

                    <label for="count">count order :</label>
                    <input type="text" id="count" name="count" value="{{$package->count_of_order}}">
                    @error('count')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror
                    <br><br>

                    <input type="submit" value="edit"></form>
                    <button> <a style="color:black; " href="{{ route('showpackage') }}">cancel</a></button>

            </div>
        </div>
    </div>
</div>

@include('panel.static.footer')

</body>

</html>
