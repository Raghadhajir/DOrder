@include('panel.static.header')
@include('panel.static.main')


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        <style>
                .butt a:hover {
                    font-weight: bold;
                }
            </style>
            <h3 style="
    margin-bottom: 20px;
    display: inline;">Deliveries</h3>
            <button class="butt" style="    margin-right: 60px;
    padding: 5px 20px 5px 20px;
    border-radius: 40%;
    "> <a href="{{route('showadddelivery')}}" style="    color: #3c5c6c;
     ">add delivery man</a></button>
        </div>
        
        <div class="content-body">
           
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>mobile</th>
                            <th>active</th>
                            <th>area</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($deliveries as $delivery)
                            <tr>
                                <td style="width:100px;">{{$delivery->name}}</td>
                                <td style="width:100px;">{{$delivery->mobile}}</td>
                                @if ($delivery->active == 1)
                                    <td style="width:100px; color:green;">active</td>
                                @else
                                <td style="width:100px;">active</td>

                                @endif
                               
                                <td style="width:100px;">{{$delivery->Area->title}}</td>
                                <td style="width:100px;"><button> <a
                                            href="{{route('showeditdelivery', ['id' => $delivery->id])}}">edit</a></button></td>

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