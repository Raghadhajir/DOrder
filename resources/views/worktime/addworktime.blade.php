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

                input[type="text"] {
                    width: 100%;
                    margin-bottom: 15px;
                    margin-top: 10px;
                    box-sizing: border-box;
                    font-size: 2.2rem;
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
                <form method="post" action="{{route('showaddworktime')}}">
                    @csrf

                    <label for="day">اليوم :</label>
                    <input type="text" id="day" name="dateName"><br><br>
                    @error('dateName')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror
                    <label for="from">ساعة البدء :</label>
                    <input type="text" id="from" name="fromTime"><br><br>
                    @error('fromTime')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror
                    <label for="to">ساعة الانتهاء :</label>
                    <input type="text" id="to" name="toTime"><br><br>
                    @error('toTime')
                        <p style="color: red"> * {{$message}}</p>
                    @enderror
                    <input type="submit" value="add">
            </div>
        </div>
    </div>
</div>

@include('panel.static.footer')

</body>

</html>