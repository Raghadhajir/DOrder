


<!-- BEGIN: Vendor JS-->
<script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js') }}"></script>
<script src="{{ asset('app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js') }}"></script>
<script src="{{ asset('app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/extensions/swiper.min.js') }}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('app-assets/js/scripts/configs/vertical-menu-dark.js') }}"></script>
<script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('app-assets/js/core/app.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/components.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/footer.js') }}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ asset('app-assets/js/scripts/pages/dashboard-ecommerce.js') }}"></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<!-- END: Page JS-->
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

 <!-- ajax for notification -->
 <script>
    $(document).ready(function() {
        console.log('Hello Raghad');

        $.ajax({
            url: "http://dorder.test:8080/api/notification/addcustomer",
            dataType: "json",
            success: function(data) {
                //console.table(data.data);
                $.each(data.data ,function(item){
                    let content = data.data[item].content;
                    let title = data.data[item].title;
                    let name = data.data[item].client_name;
                    let id = data.data[item].id;
                    let route = '/admin/detailscustomer?id='+id+'';


                    $(".resultcus").append('<div class="media-left pr-0 media" style="display: flex;"> <div class="avatar mr-1 m-0" style=" background-color: transparent;"><img src="'+image+'" alt="avatar" height="39" width="39"></div> <div class="media-body"> <h6 class="media-heading"><span class="text-bold-500">'+title+'</span> </h6> <p><a href="'+route+'">'+content+' '+name+'</a></p> <small class="notification-text"></small> </div> </div>  <hr style=" width: 100%; height: 2px;color: black;">');

                });

                //
            }
    });
    });
 </script>
 <!-- ajax for order -->
 <script>
    const image = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJUAAACUCAMAAACtIJvYAAAAZlBMVEX///8AAACBgYH4+PhLS0tlZWU1NTX8/PwEBATCwsLr6+vz8/Pv7+/FxcW6uroiIiLW1taZmZldXV16enpYWFivr68oKCh0dHSSkpJFRUXQ0NCHh4fg4OAvLy8TExOmpqYaGho+Pj5ZBhc4AAAEyElEQVR4nO1c25aqMAwtAyUKiMhVuej4/z95ikIvjgchFPChey11ltDMbpOmKUklxMDAwMDAwGA2oMXWJP4C7O8jBVkRF9l38QI/tlrE/lfxqhilHXtV5Ito1fmD1c7K662pSDjsrCd2h62pSNhbPfZbU5FgWI2HYTUe3zkHD3ysvoeVV545q3PpbcqlXVrsOqwuT9VJ75cqrO02ttmEVxBStzMnblfdHy4Ng9X5tKNQVpY0PjK6b6qyu3M9RMn1D5tXXJNoVU5eH7kM4RHZrGj7h+a96t7osVnHVQCxk4+6k5HYaxhXHX9WnjJidIVIsD5KjkDw+z22+BXfdhfaW48L0wJyyF9Ho4lP+8jrUEf7U9y83pIfllQikOgqD1RrNb23BMKdkxcqlscaXKPlaDFSrqK+5uSB4CR9gndqZFaWuyAtW9XN2Rv4V95ZmRSNvxipQuaUlkPrCbtSpvLthb0Qq5s87R5uaEgr3LF1I3ZbhlQkdz0bpvSkBZncZJFF0aaSndzGRE/slpuweYsuocNQst5w5IyCthXXe6adE4ArdDH+GQeQSjRzdXsHIJKJTJpO8sTNdNPypWkeTJENgeRMdDutUMgea1QdK7WpXlAu2fEnsvId3pbqJeWJCXggU/YIj32HmIZ6A2bhFlxEa5ez0qvChA/V9Hkk5u/OSnSSCrhpNDWCVd30nXJ07l0jvvkrEK2BFD2rq87FcM9VcEK1Py3iGzqpLKrE9TXiESyuV+8h4nCcd/Z5e53mHvdCr0gB3C5jjawuvdA7UsC9F3DRyIpHMSlSAF/bMU74PxCxFXYh48uoqy+WMawMK8PKsDKsDCvDyrAyrAwrw8qwMqwMK8PKsNIFP9fGKteXNBGPRX+QEsSTcR0PRtuMqZ31xRP4NK3ImF2zT6nhMaxIJFI41rVEyimluigazS7LskWO1pqRSrNjWcxtTq6XdQjkKo4dOkerJD0ZEsAPF0BAFWH4FC2QuyKJBuhaxDbToQBfhAOi0PUJTOalQ6WSmlfNe1DLtiqcFODZxg5zc9mZOlolTpzv8s6xz3R6Ck4Ba1ynliTRxcxntW7jmOmozrOzo1o/Ml1E4Iqe0aGapvEA4lEx+i4mgxk+27av2J+9SDxJwaMuopOKWhJj3iutadnA4RpA5L/qnLPSW4gqauERh3dExca1+tGJSizU01UoUsXLYXK6F6aV9eKQTC5CoJ+FzgadyspOPwudjXRqnGWvMVbx5Oivkkqcl8L0uCE6LsuI4RdRsnH7LHYmUBumKHGGwIXnLxdErflge/RRD7D/C6mI8EyUK0QcZAqGBCA5fWDM58KPEk4A+Xl+za5ucHhJ6OnlgtDt+qRIyo9GqBvqsv8aXb4yB2IDpFYviQUUuY2ZBXG+0joJAwIp1tji3KV3VzxPd5pD8nL3TU4S9qPS2pGz9wDA27eWvkSx3GiAJ4aF8bjQgl6Uw0HeBo5B2TC+A2q7N58V+GoMpgYYqb/VT1t4zftYh+mv2fDQbJm/HLDqRy1HPtvQAKai6M9JswfaA1Rb/nxEXbxYVPt3sf1vR4SOMPXHu6P/hMtUMEUFmSMeyP86WbD2eeK3vNirDs8JjWlyDrfXnQJYLL6cAZDeDQwMDAwMDObgH3EON1m4D+i2AAAAAElFTkSuQmCC";
    $(document).ready(function() {
        console.log('Hello Raghad222');

        $.ajax({
            url: "http://dorder.test:8080/api/notification/addorder",
            dataType: "json",
            success: function(data) {
                //console.table(data.data);
                $.each(data.data ,function(item){
                    let content = data.data[item].content;
                    let title = data.data[item].title;
                    let name = data.data[item].client_name;
                    let id = data.data[item].id;
                    let route = '/admin/openorder?id='+id+'';
                    console.log( data.data[item].title)


                    $(".resultord").append('<div class="media-left pr-0 media" style="display: flex;"> <div class="avatar mr-1 m-0" style=" background-color: transparent;"><img src="'+image+'" alt="avatar" height="39" width="39"></div> <div class="media-body"> <h6 class="media-heading"><span class="text-bold-500">'+title+'</span> </h6> <p><a href="'+route+'">'+content+' '+name+'</a></p> <small class="notification-text"></small> </div> </div>  <hr style=" width: 100%; height: 2px;color: black;">');

                });

                //
            }
    });
    });
 </script>

<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('6ac42a63370bcc500419', {
        cluster: 'us2'
    });

    var channel = pusher.subscribe('customer');
    channel.bind('add-customer', function (data) {
        console.log('Hello');
        //alert();
        var raghad = $('#raghad').val();
        var datas = JSON.stringify(data);
        var text = '<li class="scrollable-container media-list ps ps__rtl"> <a class="d-flex justify-content-between" href="#"> <div class="media d-flex align-items-center"> <div class="media-left pr-0"> <div class="avatar mr-1 m-0"> <img src="https://i.imgur.com/RLRHOCX.gif" alt="avatar" height="39" width="39"> </div> </div> <div class="media-body"> <h6 class="media-heading"> <span class="text-bold-500">Customer</span> </h6> <p><a  href="#" >Text</a></p> <small class="notification-text">' + datas.message + '</small> </div> </div> </a> </li>';

        console.log(text);
        var sound = "https://soundcamp.org/sounds/382/[ring]-(4)_eOv.wav";
        const audio = new Audio(sound);
        audio.play();
        var resp = audio.play();

        if (resp !== undefined) {
            resp.then(_ => {
                // autoplay starts!
            }).catch(error => {
                //show error
            });
        }//
        $('#raghad').append(text);
    });
</script>
</body>
<!-- END: Body-->

</html>
