<?php $data = get_emails_option_data();?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<div marginheight="0" marginwidth="0">
  <div style="background-color:white;margin:0;width:100%" dir="ltr">
    <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
      <tbody>
        <tr>
          <td valign="top" align="left">
            <div></div>
              <table cellspacing="0" cellpadding="0" border="0" style="background-color:white;border:0px solid #dcdcdc;border-radius:3px!important">
                <tbody>
                  <tr>
                    <td valign="top" align="center">
                      <table width="600" cellspacing="0" cellpadding="0" border="0" style="vertical-align:middle;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif">
                        <tbody>
                          <tr>
                            <td style="    padding-left: 20px;font-size: 15px;">
                              <h3>{!! $data['processed_order']['email_heading'] !!}</h3>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top" align="center">
                      <table cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                          <tr>
                            <td valign="top" style="background-color:white;">                                              
                              <table width="100%" cellspacing="0" cellpadding="20" border="0">
                                <tbody>
                                  <tr>
                                    <td valign="top" style="padding:48px">
                                      <div style="color:#737373;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:14px;line-height:150%;text-align:left">
                                          <p>{!! trans('admin.processed_order_msg', ['order_number' => '#'.$_order_id]) !!}</p>
                                         
                                        <h2 style="color:#3c8dbc;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:16px 0 8px;text-align:left">{!! trans('email.order') !!} #{!! $_order_id !!} ({!! $_order_date !!})</h2>
                                        <table cellspacing="0" cellpadding="6" border="none" style="width:100%;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;color:#737373;border:none;">
                                          <thead>
                                            <tr style="background:#f5f5f5;">

                                              <th style="text-align:left;color:#737373;border:0px solid #e4e4e4;padding:12px" scope="col">{!! trans('email.product') !!}</th>
                                              <th style="text-align:left;color:#737373;border:0px solid #e4e4e4;padding:12px" scope="col">{!! trans('email.quantity') !!}</th>
                                              <th style="text-align:left;color:#737373;border:0px solid #e4e4e4;padding:12px" scope="col">{!! trans('email.price') !!}</th>
                                              <th style="text-align:left;color:#737373;border:0px solid #e4e4e4;padding:12px" scope="col">{!! trans('email.total') !!}</th>
                                            </tr>
                                          </thead>
                                            <tbody>
                                              <?php $subTotal = 0;?>
                                              @foreach($_order_items as $items)
                                                <?php $subTotal += $items->quantity * $items->price; ?>
                                                <tr>
                                                  <td style="text-align:left;vertical-align:middle;border:0px solid #eee;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word;color:#737373;padding:12px"> {!! $items->name !!}<br><small></small>
                                                  </td>
                                                  <td style="text-align:left;vertical-align:middle;border:0px solid #eee;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;color:#737373;padding:12px">{!! $items->quantity !!}</td>
                                                  <td style="text-align:left;vertical-align:middle;border:0px solid #eee;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;color:#737373;padding:12px">{!! price_html( get_product_price_html_by_filter($items->price) ) !!}</td>
                                                  <td style="text-align:left;vertical-align:middle;border:0px solid #eee;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;color:#737373;padding:12px"><span> {!! price_html( get_product_price_html_by_filter($items->quantity * $items->price) ) !!} </span></td>
                                                </tr>
                                              @endforeach
                                            </tbody>
                                            <tfoot>
                                              <tr>
                                                <th style="text-align:left;border-top-width:4px;color:#737373;border:0px solid #e4e4e4;padding:12px" colspan="3" scope="row">{!! trans('email.subtotal') !!}:</th>
                                                <td style="text-align:left;border-top-width:4px;color:#737373;border:0px solid #e4e4e4;padding:12px"><span>{!! price_html( get_product_price_html_by_filter($subTotal) ) !!}</span></td>
                                              </tr>
                                              <tr>
                                                <th style="text-align:left;border-top-width:4px;color:#737373;border:0px solid #e4e4e4;padding:12px" colspan="3" scope="row">{!! trans('email.shipping_cost') !!}:</th>
                                                @if($_order_shipping_cost && $_order_shipping_cost == 0)
                                                   <td style="text-align:left;border-top-width:4px;color:#737373;border:0px solid #e4e4e4;padding:12px"><span><span>{!! trans('email.free') !!}</span></span></td>
                                                @else
                                                  <td style="text-align:left;border-top-width:4px;color:#737373;border:0px solid #e4e4e4;padding:12px"><span>{!! price_html( get_product_price_html_by_filter($_order_shipping_cost) ) !!}</span></td>
                                                @endif
                                              </tr>
                                              <tr>
                                                <th style="text-align:left;border-top-width:4px;color:#737373;border:0px solid #e4e4e4;padding:12px" colspan="3" scope="row">{!! trans('email.tax') !!}:</th>
                                                <td style="text-align:left;border-top-width:4px;color:#737373;border:0px solid #e4e4e4;padding:12px"><span>{!! price_html( get_product_price_html_by_filter($_order_tax) ) !!}</span></td>
                                              </tr>

                                              <tr>
                                                <th style="text-align:left;color:#737373;border:0px solid #e4e4e4;padding:12px" colspan="3" scope="row">{!! trans('email.payment_method') !!}:</th>
                                                <td style="text-align:left;color:#737373;border:0px solid #e4e4e4;padding:12px">{!! get_payment_method_title($_payment_method) !!}</td>
                                              </tr>

                                              <tr>
                                                <th style="text-align:left;color:#737373;border:0px solid #e4e4e4;padding:12px" colspan="3" scope="row">{!! trans('email.total') !!}:</th>
                                                <td style="text-align:left;color:#737373;border:0px solid #e4e4e4;padding:12px"><span>{!! price_html( get_product_price_html_by_filter($_order_total) ) !!}</span></td>
                                              </tr>
                                            </tfoot>
                                        </table>
                                        <h2 style="color:#3c8dbc;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:16px 0 8px;text-align:left">{!! trans('email.customer_details') !!}</h2>
                                        <ul>
                                          <li>
                                          <strong>{!! trans('email.email') !!}:</strong> <span style="color:#505050;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif"><a target="_blank" href="mailto:{{ $_mail_to }}">{!! $_mail_to !!}</a></span>
                                          </li>
                                           <li>
                                          <strong>{!! trans('email.tel') !!}:</strong> <span style="color:#505050;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif">{!! $_billing_phone !!}</span>
                                          </li>

                                        </ul>

                                        <table cellspacing="0" cellpadding="0" border="0" style="width:100%;vertical-align:top">
                                          <tbody>
                                            <tr>
                                              <td width="50%" valign="top">
                                                <h3 style="color:#3c8dbc;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:16px;font-weight:bold;line-height:130%;margin:16px 0 8px;text-align:left">{!! trans('email.billing_address') !!}</h3>
                                                <p style="color:#505050;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;margin:0 0 16px">{!! $_billing_first_name .' '. $_billing_last_name !!} <br> {!! $_billing_address_1 !!}<br> {!! $_billing_city !!} <br> {!! $_billing_postcode !!} <br> {!! get_country_by_code($_billing_country) !!}</p>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top" align="center">
                      <table width="600" cellspacing="0" cellpadding="10" border="0">
                        <tbody>
                          <tr>
                            <td valign="top" style="padding:0">
                              <table width="100%" cellspacing="0" cellpadding="10" border="0">
                                <tbody>
                                  <tr>
                                    <td valign="middle" style="padding:0 48px 48px 48px;border:0;color:#99b1c7;font-family:Arial;font-size:12px;line-height:125%;text-align:center" colspan="2">
                                      <p>{!! trans('email.powered_by') !!} {!! $_site_title !!}</p>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>