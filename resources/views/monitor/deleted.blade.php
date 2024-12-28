@include('panel.static.header')
@include('panel.static.main')

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">

        </div>
        <div class="content-body">
           
                <h2>monitors not active</h2>
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

                        @foreach ($monitors as $monitor)
                            <tr>
                                <td style="width:100px;">{{$monitor->name}}</td>
                                <td style="width:100px;">{{$monitor->mobile}}</td>
                                @if ($monitor->active == 1)
                                    <td style="width:100px; color:green;">active</td>
                                @else
                                <td style="width:100px;">not active</td>

                                @endif
                                <td style="width:100px;">{{$monitor->area?->title}}</td>

                                <td style="width:100px;"><button> <a
                                            href="{{route('activemonitor', ['id' => $monitor->id])}}">activat</a></button></td>

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