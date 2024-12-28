@include('panel.static.header')
@include('panel.static.main')


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">

        </div>
        <div class="content-body">
            @if (!$packages)
                <br>
                <h2>There are no cities yet</h2>
            @else
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>title</th>
                            <th>image</th>
                            <th>count order</th>
                            <th>price</th>
                            <th>order price</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($packages as $package)
                            <tr>
                                <td style="width:100px;">{{$package->title}}</td>
                                <td style="width:100px;"><img src={{$package->image}} width='100px' height='100px'></td> "
                                <td style="width:100px;">{{$package->count_of_order}}</td>
                                <td style="width:100px;">{{$package->package_price}}</td>
                                <td style="width:100px;">{{$package->order_price}}</td>

                                <td style="width:100px;"><button> <a
                                            href="{{route('showeditpackage', ['id' => $package->id])}}">edit</a></button></td>
                                <td><button> <a href="{{route('deletepackage', ['id' => $package->id])}}">delete</a></button>
                                </td>

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