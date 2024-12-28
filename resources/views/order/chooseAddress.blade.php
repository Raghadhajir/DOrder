@include('panel.static.header')
@include('panel.static.main')

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>

        <div class="content-body" >
            <h3 style="margin-top: 60px;">ADD NEW ORDER :</h3>

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

                <form method="post"  enctype="multipart/form-data">
                    @csrf

                    <label for="area">choose an address for this user:</label>
                    <select class="form-control" id="area" name="area_id" >
                        @foreach($addresses as $address)
                                    <option value="{{$address->id}}">{{$address->address}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">done</button>
            </div>
        </div>
    </div>
    </div>


    @include('panel.static.footer')
    </body>



    </html>
