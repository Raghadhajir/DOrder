@include('panel.static.header')
@include('panel.static.main')

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>

        <div class="content-body">
            <h3 style="margin-top: 60px;">ADD NEW ORDER :</h3>
            @if($errors->has('error'))
                <div class="alert alert-danger">
                    {{ $errors->first('error') }}
                </div>
            @endif
            <style>
                body {}

                .container {
                    font-family: Arial, sans-serif;
                    margin-top: 0px;
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

                <form method="post" action="{{route('showaddorder')}}" enctype="multipart/form-data">
                    @csrf

                    @isset($name)
                        <label for="name">user name:</label>
                        <input type="text" id="name" name="name" placeholder="name" value="{{$name}}">
                        @error('name')
                            <p style="color: red"> * {{$message}}</p>
                        @enderror
                    @else
                        <label for="name">user name:</label>
                        <input type="text" id="name" name="name" placeholder="name">
                        @error('name')
                            <p style="color: red"> * {{$message}}</p>
                        @enderror
                    @endisset

                    @isset($email)
                        <label for="email">the email:</label>
                        <input type="email" id="email" name="email" placeholder="email" value="{{$email}}">
                        @error('order')
                            <p style="color: red"> * {{$message}}</p>
                        @enderror
                    @else
                        <label for="email">the email:</label>
                        <input type="email" id="email" name="email" placeholder="email">
                        @error('order')
                            <p style="color: red"> * {{$message}}</p>
                        @enderror
                    @endisset
                    <label for="order">the order:</label>
                    <input type="text" id="order" name="order" placeholder="order">
                    @error('order')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror

                    <label for="addresses">choose an address :</label>
                    <select id="addresses" name="addresses" required>

                    </select>
                    <label for="time">scheduled time:</label>
                    <input type="text" id="time" name="time" placeholder="time">
                    @error('time')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror


                    <button type="submit" class="btn btn-primary">add</button>
            </div>
        </div>
    </div>
</div>
<!-- ajax for address where im adding order -->
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

<script>
    $(document).ready(function () {
        $('#addresses').click(function () {
            console.log('helooooo');
            var name = $('#name').val();
            console.log(name);
            $('#email').keyup(function () {

                var email = $('#email').val();
                console.log(email);
            })

            $.ajax({
                url: '{{route('AddAddress')}}',
                dataType: "json",
                data: {
                    name: $('#name').val(),
                    email: $('#email').val(),
                },
                success: function (data) {
                    $("#addresses").empty();
                    $.each(data.data, function (item) {
                        let address = data.data[item].address;
                        let id = data.data[item].id;
                        console.log(id);


                        $("#addresses").append(' <option value=' + id + '>' + address + '</option>');

                    });

                }
            });

        })

    });

</script>
@include('panel.static.footer')
</body>



</html>
