@include('panel.static.header')
@include('panel.static.main')


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">

        </div>
        <div class="content-body">
            
            <h3 style="display:inline; ">deleted cities</h3>
            
            <table class="table m-0">
                    <thead>
                        <tr>
                            <th>city</th>                                                   
                         </tr>

                    </thead>

                    <tbody>

                        @foreach ($cities as $city)

                            <tr>
                                <td style="width:100px;">{{$city->title;}}</td>
                               
                                <td><button> <a href="{{route('restorecity', ['id' => $city->id])}}">restore</a></button></td>

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