[[!msGetOrder@EmailOrderRows?id=`[[+id]]`]]
[[!pdoGetOrder?id=`[[+id]]`]]

<style>
  .order-table {
    margin:0px;padding:0px;
    width:100%;
    box-shadow: 10px 10px 5px #888888;
    border:1px solid #6d6f71;

    -moz-border-radius-bottomleft:0px;
    -webkit-border-bottom-left-radius:0px;
    border-bottom-left-radius:0px;

    -moz-border-radius-bottomright:0px;
    -webkit-border-bottom-right-radius:0px;
    border-bottom-right-radius:0px;

    -moz-border-radius-topright:0px;
    -webkit-border-top-right-radius:0px;
    border-top-right-radius:0px;

    -moz-border-radius-topleft:0px;
    -webkit-border-top-left-radius:0px;
    border-top-left-radius:0px;
  }.order-table table{
     border-collapse: collapse;
     border-spacing: 0;
     width:100%;
     height:100%;
     margin:0px;padding:0px;
   }.order-table tr:last-child td:last-child {
      -moz-border-radius-bottomright:0px;
      -webkit-border-bottom-right-radius:0px;
      border-bottom-right-radius:0px;
    }
  .order-table table tr:first-child td:first-child {
    -moz-border-radius-topleft:0px;
    -webkit-border-top-left-radius:0px;
    border-top-left-radius:0px;
  }
  .order-table table tr:first-child td:last-child {
    -moz-border-radius-topright:0px;
    -webkit-border-top-right-radius:0px;
    border-top-right-radius:0px;
  }.order-table tr:last-child td:first-child{
     -moz-border-radius-bottomleft:0px;
     -webkit-border-bottom-left-radius:0px;
     border-bottom-left-radius:0px;
   }.order-table tr:hover td{

    }
  .order-table tr:nth-child(odd){ background-color:#ffffff; }
  .order-table tr:nth-child(even)    { background-color:#ffffff; }.order-table td{
                                                                    vertical-align:middle;


                                                                    border:1px solid #6d6f71;
                                                                    border-width:0px 1px 1px 0px;
                                                                    text-align:left;
                                                                    padding:8px;
                                                                    font-size:16px;
                                                                    font-family:Trebuchet MS;
                                                                    font-weight:bold;
                                                                    color:#000000;
                                                                  }.order-table tr:last-child td{
                                                                     border-width:0px 1px 0px 0px;
                                                                   }.order-table tr td:last-child{
                                                                      border-width:0px 0px 1px 0px;
                                                                    }.order-table tr:last-child td:last-child{
                                                                       border-width:0px 0px 0px 0px;
                                                                     }
  .order-table tr:first-child th{
    background:-o-linear-gradient(bottom, #b8be56 5%, #c9d13c 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #b8be56), color-stop(1, #c9d13c) );
    background:-moz-linear-gradient( center top, #b8be56 5%, #c9d13c 100% );
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#b8be56", endColorstr="#c9d13c");	background: -o-linear-gradient(top,#b8be56,c9d13c);

    background-color:#b8be56;
    border:0px solid #6d6f71;
    text-align:center;
    border-width:0px 0px 1px 1px;
    font-size:20px;
    font-family:Trebuchet MS;
    font-weight:bold;
    color:#000000;
  }
  .order-table tr:first-child:hover th{
    background:-o-linear-gradient(bottom, #b8be56 5%, #c9d13c 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #b8be56), color-stop(1, #c9d13c) );
    background:-moz-linear-gradient( center top, #b8be56 5%, #c9d13c 100% );
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#b8be56", endColorstr="#c9d13c");	background: -o-linear-gradient(top,#b8be56,c9d13c);

    background-color:#b8be56;
  }
  .order-table tr td{
    text-align:center;
  }
  .order-table tr:first-child td:first-child{
    border-width:0px 0px 1px 0px;
  }
  .order-table tr:first-child td:last-child{
    border-width:0px 0px 1px 1px;
  }
  .big{font-size:130%;}
</style>

<h3>Заказ #[[+num]] обработан менеджером</h3>

<table class="table table-striped order-table">
  <tr class="header">
    <th class="image span2 col-md-2">&nbsp;</th>
    <th class="title span4 col-md-4">[[%ms2_cart_title]]</th>
    <th class="count span2 col-md-2">[[%ms2_cart_count]]</th>
    <th class="price span1 col-md-1">[[%ms2_cart_cost]]</th>
  </tr>
  [[+goods]]
  <tr class="footer">
    <th class="total" colspan="2">[[%ms2_cart_total]]:</th>
    <th class="total_count"><span class="ms2_total_count">[[+cart_count]]</span> [[%ms2_frontend_count_unit]]</th>
    <th class="total_cost"><span class="ms2_total_cost">[[+cart_cost]]</span>  руб.</th>
  </tr>
</table>

<h4>[[%ms2_frontend_order_cost]]: [[+cart_cost]]  руб. - [[+order.discount:money]]  руб. (скидка [[+order.discount_perc]]%) [[+delivery_cost:ne=``:then=`+ [[+delivery_cost]]  руб. (доставка)`]] = <big>[[+cost]]</big>  руб.</h4>

[[+payment_link]]
