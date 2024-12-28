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
        <h3 style="display:inline; ">cities</h3>
        <button class="butt" style="    margin-right: 60px;
    padding: 5px 20px 5px 20px;
    border-radius: 40%;
    "> <a href="{{route('addcity')}}" style="    color: #3c5c6c;
     ">add city</a></button>
        <div class="content-body">
            
            
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>city</th> 
                            <th>areas served</th>                                                  
                         </tr>

                    </thead>

                    <tbody>

                        @foreach ($cities as $city)

                            <tr>
                                <td style="width:100px;">{{$city->title;}}</td>
                                <td style="width:100px;">{{count($city->Areas)}}</td>
                                <td style="width:100px;"><button> <a
                                            href="{{route('showeditcity', ['id' => $city->id])}}">edit</a></button></td>

                                <td><button> <a href="{{route('deletecity', ['id' => $city->id])}}">hidden</a></button></td>

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