@include('panel.static.header')
@include('panel.static.main')


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">

        </div>
        <style>
    .butt a:hover{
        font-weight: bold;
    }
</style>
        <h3 style="display:inline; ">Areas</h3>
        <button class="butt" style="    margin-right: 60px;
    padding: 5px 20px 5px 20px;
    border-radius: 40%;
    "> <a href="{{route('addarea')}}" style="    color: #3c5c6c;
     ">add area</a></button>
        <div class="content-body">

            <table class="table m-0">
                <thead>
                    <tr>
                        <th>area</th>
                        <th>city</th>
                        <th>monitors</th>
                        <th>deliveries</th>
                    </tr>
                </thead>
                <tbody>


                    @foreach ($areas as $area)
                        <tr>
                            <td style="width:100px;">{{$area->title}}</td>
                            <td style="width:100px;">{{$area->City->title}}</td>
                            <td style="width:100px;">{{count($area->Monitors)}}</td>
                            <td style="width:100px;">{{count($area->Deliveries)}}</td>
                            <td style="width:100px;"><button> <a
                                            href="{{route('showeditarea', ['id' => $area->id])}}">edit</a></button></td>

                            <td><button> <a href="{{route('deletearea', ['id' => $area->id])}}">hidden</a></button></td>

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