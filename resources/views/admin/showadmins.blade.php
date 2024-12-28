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
    display: inline;">Admins</h3>
            <button class="butt" style="    margin-right: 60px;
    padding: 5px 20px 5px 20px;
    border-radius: 40%;
    "> <a href="{{route('showaddadmin')}}" style="    color: #3c5c6c;
     ">add admin</a></button>
        </div>

        <div class="content-body">
            @if (!$admins)
                <br>
                <h2>There are no cities yet</h2>
            @else
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>mobile</th>
                            <th>active</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($admins as $admin)
                            <tr>
                                <td style="width:100px;">{{$admin->name}}</td>
                                <td style="width:100px;">{{$admin->mobile}}</td>
                                @if ($admin->active == 1)
                                    <td style="width:100px; color:green;">active</td>
                                @else
                                <td style="width:100px;">not active</td>

                                @endif
                                <td style="width:100px;"><button> <a
                                            href="{{route('showeditadmin', ['id' => $admin->id])}}">edit</a></button></td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br><br><br>
            @endif
        </div>
    </div>
</div>

@include('panel.static.footer')

</body>

</html>