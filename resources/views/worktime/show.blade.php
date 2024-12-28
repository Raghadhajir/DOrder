@include('panel.static.header')
@include('panel.static.main')


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">

        </div>
        <h2>Working Time</h2>
        <div class="content-body">


            <table class="table m-0">
                <thead>
                    <tr>
                        <th>اليوم</th>
                        <th>ساعة البدء</th>
                        <th>ساعة الانتهاء</th>



                    </tr>
                </thead>

                <tbody>

                    @foreach ($times as $time)

                        <tr>
                            <td style="width:100px;">{{$time->dateName}}</td>
                            <td style="width:100px;">{{$time->fromTime}}</td>
                            <td style="width:100px;">{{$time->toTime}}</td>
                            <td><button> <a href="{{route('showeditworktime', ['id' => $time->id])}}">edit</a></button></td>
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