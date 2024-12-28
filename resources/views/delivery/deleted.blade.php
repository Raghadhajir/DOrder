@include('panel.static.header')
@include('panel.static.main')


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">

        </div>
        <h2>Deliveries not active</h2>
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
                                            href="{{route('activatedeliver', ['id' => $delivery->id])}}">activate</a></button></td>

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