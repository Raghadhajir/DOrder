@include('panel.static.header')
@include('panel.static.main')


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        <h3>deleted areas</h3>

        </div>
        <div class="content-body">

            <table class="table m-0">
                <thead>
                    <tr>
                        <th>area</th>
                        <th>city</th>
                    </tr>
                </thead>
                <tbody>


                    @foreach ($areas as $area)
                        <tr>
                            <td style="width:100px;">{{$area->title}}</td>
                            <td style="width:100px;">{{$area->City->title}}</td>
                            <td><button> <a href="{{route('restorearea', ['id' => $area->id])}}">restore</a></button></td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br><br><br>

        </div>
    </div>
</div>

@include('panel.static.footer')

</body>

</html>