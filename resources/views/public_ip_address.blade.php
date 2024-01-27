@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                <!-- <form> -->
                    <div class="row">
                        <div class="control-group col-8" style="margin-left:10px">
                            <h2>Click the button to get IP Address and its details</h2>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="control-group col-8 text-center">
                            <button id="btn-submit" onclick="getIpAddressDetails()" class="btn btn-primary">
                                Get your system's IP Address
                            </button>&nbsp&nbsp&nbsp<b>OR</b>&nbsp&nbsp&nbsp
                            <input type="text" id="custom_ip_address" style="width:35%" placeholder="Enter IP Address for another system" />
                            <button id="btn-submit" onclick="getIpAddressDetails()" class="btn btn-primary">
                                Get IP Address
                            </button>
                        </div>
                    </div>
                    <table width="100%" cellpadding="0" cellspacing="0"
                           style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                        <tr style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                            <td class="content-block"
                                style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;"
                                valign="top">
                            </td>
                        </tr>
                        <tr style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                            <td class="content-block"
                                style="font-family: 'Roboto', sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;"
                                valign="top">
                                <div>
                                <p id="ip_address"><b>IP Address : </b></p>
                                <p id="ip_address_state"><b>IP Address State : </b></p>
                                <p id="ip_address_city"><b>IP Address City : </b></p>
                               </div>
                            </td>
                        </tr>
                    </table>
                <!-- </form> -->
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
        function getIpAddressDetails(){
            $.ajax({
                url: "/ip-address",
                type: "post",
                data: {'ip_address':$('#custom_ip_address').val()},
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(data) {
                    document.getElementById('ip_address').innerHTML = "<b>IP Address : </b>"+data.ip;
                    document.getElementById('ip_address_state').innerHTML = "<b>IP Address State: </b>"+data.regionName;
                    document.getElementById('ip_address_city').innerHTML = "<b>IP Address City: </b>"+data.cityName;
                }
                });
        };
    </script>
@endsection