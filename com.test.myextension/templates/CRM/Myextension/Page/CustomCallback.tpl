
<!-- Loading resources from url using CiviCRM provided tags -->
{crmStyle ext=com.test.myextension file=resources/css/style.css}


{crmScript ext=com.test.myextension file=resources/js/d3.js}
{crmScript ext=com.test.myextension file=resources/js/chart.js weight = 10}


<!-- Beginnng of Content Area -->
<div id="date-selector">
    <table>
        <tr><th>Select Date to Filter Results</th></tr>
        <tr>
            <td>
                <label for="start-date">Start Date</label> 
                <input type="text" id="start-date"/>
            </td>

            <td>
                <label for="end-date">End Date</label> 
                <input type="text" id="end-date" />
            </td>
            <td>
                <a id="button" href="#" class="button">Submit</a>
            </td>
        </tr>
    </table>   
</div>


<h3>Total Contribution amount of Type "Member Dues": <span id="total">{$total}</span></h3>

<div id="chart"></div>

<!-- End of Content Area -->

<!--- Onpage Javascript --->
{literal}
    <script>

        CRM.$(function ($) {

            // Use of API through Javascript
            CRM.api3('Contribution', 'get', {
                "sequential": 1,
                "return": "receive_date,net_amount",
                "contact_id": {/literal}{$cid}{literal}
            }).done(function (result) {
                jsonObject = result.values;
                $("#chart").html(createChart(jsonObject));
            });


            // Using Datepicker
            $('#start-date').datepicker({dateFormat: 'yy-mm-dd'});
            $('#end-date').datepicker({dateFormat: 'yy-mm-dd'});

            $("#button").click(function (e) {

                // stop default function on click
                e.preventDefault();

                // Get date from input fields
                var startDate = $('#start-date').val();
                var endDate = $('#end-date').val();

                // Form a url with dynamic parameters and make an ajax request
                var url = CRM.url("civicrm/get-contri?cid={/literal}{$cid}{literal}&start-date=" + startDate + "&end-date=" + endDate);

                $.ajax(
                        {
                            url: url, success: function (result) {
                                jsonObject = JSON.parse(result);

                                $("#total").html(sumArrayIndex(jsonObject));

                                $("#chart").html("");
                                $("#chart").html(createChart(jsonObject));
                            }
                        });
            });
        });


        // Helper Function
        function sumArrayIndex(jsonObject) {
            totalAmount = 0;

            for (var i = 0; i <= jsonObject.length - 1; i++) {
                totalAmount += parseInt(jsonObject[i].net_amount);
            }

            return totalAmount;
        }
    </script>
{/literal}
